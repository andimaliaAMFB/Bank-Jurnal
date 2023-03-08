<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use App\Notifications\DeleteNotif;

use App\Models\User;
use App\Models\penulis;
use App\Models\jurusan;
use App\Models\artikel;
use App\Models\artikel_detail;
use App\Models\artikel_detail_penulis;
use DB;
use Session;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $title = "Upload Artikel";
        $taskbarValue = (new listController)->taskbarList ();
        $finalSearch = (new listController)->SearchBarList ();
        
        $tableProdi = json_decode((new listController)->getTable('Prodi'),true);
        $tablePenulis = json_decode((new listController)->getTable('Penulis'),true);

        $arrayAkun = (new listController)->getAkun();
        $field = null;
        $Count_pj = null;
        $id_article = null;
        return view('upload',compact('arrayAkun','title','tablePenulis','tableProdi','taskbarValue','finalSearch','field','Count_pj','id_article'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Recreate($id_article) {
        $title = "Upload Revisi Artikel ".$id_article;
        $taskbarValue = (new listController)->taskbarList ();
        $finalSearch = (new listController)->SearchBarList ();
        
        $tableProdi = json_decode((new listController)->getTable('Prodi'),true);
        $tablePenulis = json_decode((new listController)->getTable('Penulis'),true);

        $arrayAkun = (new listController)->getAkun();
        $artikelDetail = json_decode((new listController)->getTable('Judul-'.$id_article),true);
        $all = json_decode((new listController)->getTable('All'),true);
        $field = [];
        $i = 1;
        foreach($all as $key => $value)
        {
            if ($all[$key]['id_artikel_detail'] == $artikelDetail[0]['id_artikel_detail'])
            {
                $field[] = ['pnl-'.($i) => $all[$key]['nama_penulis']];
                $field[] = ['prodi-'.($i) => $all[$key]['nama_jurusan']];
                $i += 1;
            }
        }
        $Count_pj = $i-1;
        return view('upload',compact('arrayAkun','title','tablePenulis','tableProdi','taskbarValue','finalSearch','field','Count_pj','id_article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //validator Input, Rule, Message
            $field = array();
            $penulis_jurusan = [];
            $Count_penulis_jurusan = 0;
            $input = [];
            $penulis = '';
            foreach ($request->all() as $key => $value) {
                echo $key.": ".$value."<br>";
                if ($key != '_token') {
                    $field[] = $key;
                    $input[] = [$key => $value];
                    if (str_contains($key,'pnl')) { $penulis = $value; $Count_penulis_jurusan += 1;}
                    else if (str_contains($key,'prodi')) { $penulis_jurusan += [$penulis => $value]; }
                }
            }
            if($field) {
                $rule = array();
                foreach ($field as $key => $value) {
                    if ($value == 'file') {
                        $rule += [$value => 'required|mimes:pdf,docx|max:10000'];
                    }
                    else { $rule += [$value => 'required']; }
                }
                // echo "<br>";
                // dd($rule);

                $pesan = [];
                foreach ($rule as $key => $value) {
                    $txt = '';
                    if (str_contains($key,'pnl')) { $txt = $txt.'Nama Penulis-'; }
                    else if (str_contains($key,'prodi')) { $txt = $txt.'Nama Program Studi-'; }
                    else if (str_contains($key,'jdl')) { $txt = $txt.'Judul Artikel'; }
                    // echo $key.": ".$value."<br>";
                    for ($i=1; $i <= 4; $i++) { 
                        if (str_contains($key,$i)) { $txt = $txt.$i; }
                    }
                    $txt = $txt.' Wajib Diisi !';
                    $pesan += [$key.'.required' => $txt];
                }
                if ($rule['file']) {
                    $pesan += ['file.mimes' => 'File Artikel Harus Berupa Doc/Docx/PDF)'];
                    $pesan += ['file.max' => 'File Artikel Terlalu Berat (MAX: 10MB)'];
                }
                // echo "<br>";
                // dd($pesan);
            }
        //

        $validator = Validator::make($request->all(), $rule, $pesan);
        $validator->validated();

        //if ada form input yang tidak diisi
        if ($validator->fails()) {
            return redirect()
                ->route('article.create')
                ->withErrors($validator)
                ->withInput()
                ->with('Count_penulis_jurusan', $Count_penulis_jurusan)
                ->with('field', $input);
        }

        array_pop($input);
        //check kesesuaian jurusan dengan penulis
        foreach ($penulis_jurusan as $key => $value) {
            if (penulis::where('nama_penulis','=',$key)->exists()) {
                $jurusan_asli = penulis::where('nama_penulis','=',$key)->first()->id_jurusan;
                $id_jurusan = $this->insertProdi ($value);
                if ($jurusan_asli == $id_jurusan) {
                    echo "<br>Ini Penulis yang sudah terdaftar sesuai dengan jurusannya<br>";
                }
                else {
                    $nama_jurusan = jurusan::where('id_jurusan','=',$jurusan_asli)->first()->nama_jurusan;
                    echo "<br>Ini Penulis yang sudah terdaftar TAPI TIDAK sesuai dengan jurusannya<br>";
                    return redirect()
                        ->route('article.create')
                        ->with([
                            'error' => 'Program Studi Penulis '.$key.' TIDAK SESUAI dengan Jurusan Di Database (Seharusnya '.$nama_jurusan.')',
                            'Count_penulis_jurusan' => $Count_penulis_jurusan,
                            'field' => $input
                            ]);
                }
            }
        }

        if ($request->hasFile('file')) {
            //initial [id_akun], [id_artikel], [id_artikel_DETAIL]
                $id_akun = Auth::User()->id;
                $id_artikel = $id_akun."-".(date('m')+date("d")+date("B"));
                $id_artikel_detail = substr(md5($id_artikel),0,4)."-1";
            //
            
            //check if judul exist
                $errorString = null;
                if(artikel_detail::where('judul_artikel','=',$request->jdl)->exists()) {
                    return redirect()
                        ->route('article.create')
                        ->with('error','Gagal Upload Artikel Dikarenakan Judul Artikel Sudah Ada');
                }
            //

            //store Artikel
                $file_ext =  $request->file('file')->getClientOriginalExtension();
                $file = $id_artikel_detail.".".$file_ext;
                $path = $request->file('file')->storeAs('public/article/'.$id_akun.'/'.$id_artikel,$file);
            //
    
            $this->insertArtikel ($id_akun, $id_artikel, $id_artikel_detail, $request->jdl,$file);
            $this->revisi ($id_artikel_detail);
            
            $countPnl = 0;
            foreach ($penulis_jurusan as $key => $value){
                echo "<br>Penulis-".$countPnl;
                $dataPenulis = json_decode((new listController)->getTable('PNL-'.$key),true);
                $id_jurusan = $this->insertProdi ($value);
                $id_penulis = $this->insertPenulis ($id_jurusan,$key);
    
                $this->insertArtikelPenulis ($id_artikel_detail, $id_penulis, $countPnl);
                
                $countPnl += 1;
            }
            return redirect()
                ->route('article.create')
                ->with(['success' => 'Berhasil Upload Artikel Baru']);

        }
        else {
            return redirect()
                ->route('article.create')
                ->with(['error' => 'File Dokumen Belum di Upload',
                    'Count_penulis_jurusan' => $Count_penulis_jurusan,
                    'field' => $input
                ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Restore(Request $request, $id_article) {
        //validator Input, Rule, Message
            $field = array();
            $penulis_jurusan = [];
            $Count_penulis_jurusan = 0;
            $input = [];
            $penulis = '';
            foreach ($request->all() as $key => $value) {
                echo $key.": ".$value."<br>";
                if ($key != '_token') {
                    $field[] = $key;
                    $input[] = [$key => $value];
                    if (str_contains($key,'pnl')) { $penulis = $value; $Count_penulis_jurusan += 1;}
                    else if (str_contains($key,'prodi')) { $penulis_jurusan += [$penulis => $value]; }
                }
            }
            
            if($field) {
                $rule = array();
                foreach ($field as $key => $value) {
                    if ($value == 'file') {
                        $rule += [$value => 'required|mimes:pdf,docx|max:10000'];
                    }
                    else { $rule += [$value => 'required']; }
                }
                // echo "<br>";
                // dd($rule);

                $pesan = [];
                foreach ($rule as $key => $value) {
                    $txt = '';
                    if (str_contains($key,'pnl')) { $txt = $txt.'Nama Penulis-'; }
                    else if (str_contains($key,'prodi')) { $txt = $txt.'Nama Program Studi-'; }
                    else if (str_contains($key,'jdl')) { $txt = $txt.'Judul Artikel'; }
                    // echo $key.": ".$value."<br>";
                    for ($i=1; $i <= 4; $i++) { 
                        if (str_contains($key,$i)) { $txt = $txt.$i; }
                    }
                    $txt = $txt.' Wajib Diisi !';
                    $pesan += [$key.'.required' => $txt];
                }
                if ($rule['file']) {
                    $pesan += ['file.mimes' => 'File Artikel Harus Berupa Doc/Docx/PDF)'];
                    $pesan += ['file.max' => 'File Artikel Terlalu Berat (MAX: 10MB)'];
                }
                // echo "<br>";
                // dd($pesan);
            }
            
        //

        $validator = Validator::make($request->all(), $rule, $pesan);
        $validator->validated();

        //if ada form input yang tidak diisi
        if ($validator->fails()) {
            return redirect()
                ->route('article.create')
                ->withErrors($validator)
                ->withInput()
                ->with('Count_penulis_jurusan', $Count_penulis_jurusan)
                ->with('field', $input);
        }
        
        array_pop($input);
        //check kesesuaian jurusan dengan penulis
        foreach ($penulis_jurusan as $key => $value) {
            if (penulis::where('nama_penulis','=',$key)->exists()) {
                $jurusan_asli = penulis::where('nama_penulis','=',$key)->first()->id_jurusan;
                $id_jurusan = $this->insertProdi ($value);
                if ($jurusan_asli == $id_jurusan) {
                    echo "<br>Ini Penulis yang sudah terdaftar sesuai dengan jurusannya<br>";
                }
                else {
                    $nama_jurusan = jurusan::where('id_jurusan','=',$jurusan_asli)->first()->nama_jurusan;
                    echo "<br>Ini Penulis yang sudah terdaftar TAPI TIDAK sesuai dengan jurusannya<br>";
                    return redirect()
                        ->back()
                        ->with([
                            'error' => 'Program Studi Penulis '.$key.' TIDAK SESUAI dengan Jurusan Di Database (Seharusnya '.$nama_jurusan.')',
                            'Count_penulis_jurusan' => $Count_penulis_jurusan,
                            'field' => $input
                            ]);
                }
            }
        }

        if ($request->hasFile('file')) {
            //initial [id_akun], [id_artikel], [id_artikel_DETAIL]
                $id_akun = (new listController)->getAkun()[0]['id'];
                $artikelDetail = json_decode((new listController)->getTable('Judul-'.$id_article),true);
                $id_artikel_detail = substr($artikelDetail[0]['id_artikel_detail'],0,5);
                $id_artikel_detail_last = intval(substr($artikelDetail[0]['id_artikel_detail'],5)) + 1;
                $id_artikel = $artikelDetail[0]['id_artikel'];
                $id_AkunAwal = artikel::where('id_artikel','=',$id_artikel)->value('id_akun');
                $id_artikel_detail = $id_artikel_detail.$id_artikel_detail_last;
            //

            //check if judul exist
                if(artikel_detail::where('judul_artikel','=',$request->jdl)
                    ->where('id_artikel','<>',$id_artikel)
                    ->exists()) {
                    return redirect()
                        ->back()
                        ->with(['error' => 'Gagal Upload Artikel Dikarenakan Judul Artikel Sudah Ada',
                        'Count_penulis_jurusan' => $Count_penulis_jurusan,
                        'field' => $input]);
                }
            //

            //store Artikel
                $file_ext =  $request->file('file')->getClientOriginalExtension();
                $file = $id_artikel_detail.".".$file_ext;
                $path = $request->file('file')->storeAs('public/article/'.$id_AkunAwal.'/'.$id_artikel,$file);
            //
    
            $this->insertArtikel ($id_akun, $id_artikel, $id_artikel_detail, $request->jdl,$file);
            $this->revisi ($id_artikel_detail);
            
            $countPnl = 0;
            foreach ($penulis_jurusan as $key => $value){
                echo "<br>Penulis-".$countPnl;
                $dataPenulis = json_decode((new listController)->getTable('PNL-'.$key),true);
                $id_jurusan = $this->insertProdi ($value);
                $id_penulis = $this->insertPenulis ($id_jurusan,$key);
    
                $this->insertArtikelPenulis ($id_artikel_detail, $id_penulis, $countPnl);
                
                $countPnl += 1;
            }
            return redirect()
                ->route('myarticle')
                ->with(['success' => 'Berhasil Upload Revisi Artikel Baru']);

        }
        else {
            return redirect()
                ->back()
                ->with(['error' => 'File Dokumen Belum di Upload',
                'Count_penulis_jurusan' => $Count_penulis_jurusan,
                'field' => $input
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        // echo substr('Article-'.$id,8);
        $taskbarValue = (new listController)->taskbarList ();
        $finalSearch = (new listController)->SearchBarList ();
        
        $id_artikelDetail = json_decode((new listController)->getTable('Judul-'.$id),true)[0]['id_artikel_detail'];
        $tableArray = json_decode((new listController)->getTable('Article-'.$id_artikelDetail),true);
        $id_AkunAwal = artikel::where('id_artikel','=',$tableArray[0]['id_artikel'])->value('id_akun');
        $id_file = artikel_detail::where('id_artikel_detail','=',$id_artikelDetail)->value('file_artikel');
        if(!$id_file) {
            $id_file = $id_artikelDetail.'.pdf';
        }
        $pathArtikel = $id_AkunAwal.'/'.$tableArray[0]['id_artikel'].'/'.$id_file;

        $final = (new listController)->finalArray($tableArray);
        $judul =  array_column($final, 0);
        $penulis = [];
        foreach(array_column($final, 2) as $list_penulis) {
            $array_penulis = explode(", ",$list_penulis);
            foreach($array_penulis as $nama_penulis) {
                if(!in_array($nama_penulis,$penulis)) { $penulis[] = $nama_penulis; }
            }
        }
        $history = (new listController)->historyArray ($tableArray);

        $arrayAkun = (new listController)->getAkun();
        //read notification
            foreach (Auth::user()->unreadNotifications as $notification) {
                if (Auth::user()->id == $notification->data['to'] && 
                    str_contains($notification->data['message'], $judul[0]))
                {
                    $notification->markAsRead();
                }
            }
        //
        
        return view('lihatArticle',compact('arrayAkun','final','judul','penulis','taskbarValue','finalSearch','pathArtikel','history'));
    }

    public function showUpdate(Request $request, $id) {
        dd($request->all());
    }

    public function myarticle() {
        $title = "My Article";

        $taskbarValue = (new listController)->taskbarList ();
        $finalSearch = (new listController)->SearchBarList ();
        $arrayAkun = (new listController)->getAkun();
        // print_r($arrayAkun);

        $AlltableArray = json_decode((new listController)->getTable('All'),true);
        $tableArray = json_decode((new listController)->getTable('MyArticle-'.$arrayAkun[0]['id_penulis']),true);
        $tableProdi = json_decode((new listController)->getTable('Prodi'),true);

        $final = (new listController)->finalArray($tableArray);
        $judul =  array_column($final, 0);
        $penulis = [];
        foreach(array_column($final, 2) as $list_penulis) {
            $array_penulis = explode(", ",$list_penulis);
            foreach($array_penulis as $nama_penulis) {
                if(!in_array($nama_penulis,$penulis)) { $penulis[] = $nama_penulis; }
            }
        }
        $history = (new listController)->historyArray ($tableArray);

        $namaPenulis = $arrayAkun[0]['nama_lengkap'];

        return view('myarticle',compact('arrayAkun','namaPenulis','title','judul','penulis','tableProdi','final','taskbarValue','finalSearch','history'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showbyPenulis($id) {
        // echo substr('Penulis-'.$id,9);
        $taskbarValue = (new listController)->taskbarList ();
        $finalSearch = (new listController)->SearchBarList ();
        $tableArray;
        
        $AlltableArray = json_decode((new listController)->getTable('All'),true);
        $dataPenulis = json_decode((new listController)->getTable('PNL-'.substr($id,1)),true);
        $tableArray = json_decode((new listController)->getTable('Penulis-'.$dataPenulis[0]['id_penulis']),true);
        
        
        $pp = json_decode((new listController)->getTable('Akun-'.$dataPenulis[0]['id']),true)[0]['foto_profil'];
    
        $tableProdi = json_decode((new listController)->getTable('Prodi'),true);

        $namaPenulis = $dataPenulis[0]['nama_penulis'];
        if (!empty($tableArray)) {
            $final = (new listController)->finalArray($tableArray);
            $history = (new listController)->historyArray ($tableArray);
            $judul =  array_column($final, 0);
            $penulis = [];
            foreach(array_column($final, 2) as $list_penulis) {
                $array_penulis = explode(", ",$list_penulis);
                foreach($array_penulis as $nama_penulis) {
                    if(!in_array($nama_penulis,$penulis)) { $penulis[] = $nama_penulis; }
                }
            }
        }
        else {
            $judul =  [];
            $penulis = [];
            $tableArray = $dataPenulis;
            $final[0] = array('nama_penulis' => $tableArray[0]['nama_penulis']);
            $history = [];
        }

        $arrayAkun = (new listController)->getAkun();
        if (!empty($arrayAkun) && $arrayAkun[0]['status'] == 'Penulis' && $arrayAkun[0]['nama_lengkap'] == $namaPenulis) {
            return redirect()->route('myarticle');
        }
        else {
            // echo 'to article by penulis';
            return view('myarticle',compact('arrayAkun','namaPenulis','judul','penulis','tableProdi','final','pp','taskbarValue','finalSearch','history'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function myarticleDelete($id) {
        $id_artikelDetail = json_decode((new listController)->getTable('Judul-'.$id),true);
        
        //kirim notifikasi deleted artikel kepenulis lainnya
            $lastArtikelUp = artikel_detail::where('id_artikel','=',$id_artikelDetail[0]['id_artikel'])
                            ->orderby('id_artikel_detail', 'desc')
                            ->first();
            $listPenulisLast = artikel_detail_penulis::where('id_artikel_detail','=',$lastArtikelUp->id_artikel_detail)->get();
            $Akun = [];
            $id_akun;
            foreach($listPenulisLast as $key => $value) {
                $idAkun = penulis::where('id_penulis','=',$value->id_penulis)->first()->id_akun;
                if(!in_array($idAkun,$Akun) && $idAkun) { $Akun[] = $idAkun; }
            }
            foreach ($Akun as $value) { //kirim notifikasi deleted artikel kepenulis lainnya
                if ($value != Auth()->user()->id) {
                    $message = [
                        'to' => $value,
                        'judul_artikel' => $id,
                        'subject' => 'Artikel Telah Dihapus',
                        'message' => 'Artikel ['.$id.'] Telah Dihapus oleh Penulis '.Auth()->user()->nama_lengkap
                    ];
                    User::where('id','=',$value)->first()->notify(new DeleteNotif($message));
                }
            }
        //
        
        artikel::where('id_artikel','=',$id_artikelDetail[0]['id_artikel'])->delete();
        
        return redirect()
        ->route('myarticle')
        ->with(['success' => 'Berhasil Hapus Artikel ['.$id.']']);
    }

    function insertArtikel ($id_akun, $id_artikel, $id_artikel_detail, $judul, $file) {
        if(artikel::where('id_artikel', '=', $id_artikel)->doesntExist()) {
            DB::table('artikel')-> INSERT ([
                    'id_artikel' => $id_artikel,
                    'id_akun' => $id_akun,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
        }
        else {
            artikel::where('id_artikel', '=', $id_artikel)
                ->update ([ 'updated_at' => date("Y-m-d H:i:s") ]);
        }

        DB::table('artikel_detail')-> INSERT ([
                'id_artikel_detail' => $id_artikel_detail,
                'id_artikel' => $id_artikel,
                'judul_artikel' => $judul,
                'status_artikel' => 'Draft',
                'file_artikel' => $file
            ]);
    }

    function insertProdi ($value) {
        $dataJurusan = json_decode((new listController)->getTable('Prodi-'.$value),true);
        $id_jurusan = '';
        if(!$dataJurusan) {
            $lastIdProdi = count(json_decode((new listController)->getTable('Prodi'),true)) + 1;
            DB::table('jurusan')-> INSERT (['id_jurusan' => 'Jurusan-'.$lastIdProdi, 'nama_jurusan' => $value]);
            $id_jurusan = 'Jurusan-'.$lastIdProdi;
        }
        else { $id_jurusan = $dataJurusan[0]['id_jurusan']; }
        return $id_jurusan;
    }

    function insertPenulis ($id_jurusan,$key) {
        $id_penulis = $key;
        $dataPenulis = json_decode((new listController)->getTable('PNL-'.$key),true);
        if(!$dataPenulis && penulis::where('nama_penulis','=',$key)->doesntExist()) {
            $lastIdPenulis = strval(date("m").(date("d")+date("B")))."-1";
            $id_penulis = "PNL".substr(md5($lastIdPenulis),0,4);
            DB::table('penulis')-> INSERT ([
                'id_penulis' => $id_penulis,
                'id_akun' => null,
                'id_jurusan' => $id_jurusan,
                'nama_penulis' => $key
            ]);
            echo "<br>Create new Penulis Tanpa Akun<br>";
        }
        else {
            $id_penulis = penulis::where('nama_penulis','=',$key)->first()->id_penulis;
        }
        return $id_penulis;
    }

    function insertArtikelPenulis ($id_artikel_detail, $id_penulis, $i){
        DB::table('artikel_detail_penulis') -> INSERT ([
                    'id_list_penulis' => 'PNL'.$id_artikel_detail."-".$i,
                    'id_artikel_detail' => $id_artikel_detail,
                    'id_penulis' => $id_penulis
                ]);
    }

    function revisi ($id_artikel_detail) {
        $id_revisi = 'REV'.$id_artikel_detail;
        DB::table('revisi') -> INSERT ([
            'id_revisi' => $id_revisi,
            'id_artikel_detail' => $id_artikel_detail,
            'id_akun' => null,
            'status_artikel_baru' => '-',
            'status_revisi' => 0,
            'catatan_revisi' => '-',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
