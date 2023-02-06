<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use App\Models\artikel;
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
        
        $tableProdi = json_decode((new listController)->getTable('Prodi'),true);
        $tablePenulis = json_decode((new listController)->getTable('Penulis'),true);

        $arrayAkun = (new listController)->getAkun();
        return view('upload',compact('arrayAkun','title','tablePenulis','tableProdi','taskbarValue'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Recreate($id_article) {
        $title = "Upload Revisi Artikel ".$id_article;
        $taskbarValue = (new listController)->taskbarList ();
        
        $tableProdi = json_decode((new listController)->getTable('Prodi'),true);
        $tablePenulis = json_decode((new listController)->getTable('Penulis'),true);

        $arrayAkun = (new listController)->getAkun();
        $artikelDetail = json_decode((new listController)->getTable('Judul-'.$id_article),true);
        $all = json_decode((new listController)->getTable('All'),true);
        $field = [];
        $i = 1;
        foreach($all as $key => $value)
        {
            if ($all[$key]['ID_DETAILARTIKEL'] == $artikelDetail[0]['ID_DETAILARTIKEL'])
            {
                $field[] = ['pnl-'.($i) => $all[$key]['NAMA_PENULIS']];
                $field[] = ['prodi-'.($i) => $all[$key]['NAMA_JURUSAN']];
                $i += 1;
            }
        }
        $Count_pj = $i-1;
        return view('upload',compact('arrayAkun','title','tablePenulis','tableProdi','taskbarValue','field','Count_pj','id_article'));
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
            // echo $Count_penulis_jurusan."<br>";
            // dd($penulis_jurusan);
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
            // echo "<br>has File (1/0): ".($request->hasFile('file'))."<br>";
            if ($request->hasFile('file')) {
                echo $request->file('file')->getClientOriginalName()."<br>";
                echo $request->file('file')->getClientOriginalExtension()."<br>";
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
        
        //initial [ID_AKUN], [ID_ARTIKEL], [ID_ARTIKEL_DETAIL]
            $id_akun = (new listController)->getAkun()[0]['ID_AKUN'];
            $id_artikel = $id_akun."-".(date('m')+date("d")+date("B"));
            $id_artikel_detail = substr(md5($id_artikel),0,4)."-1";
        //

        //store Artikel
            $file_ext =  $request->file('file')->getClientOriginalExtension();
            $file = $id_artikel_detail.".".$file_ext;
            $path = $request->file('file')->storeAs('public/article/'.$id_akun.'/'.$id_artikel,$file);
            // dd($path);
        //

        $this->insertArtikel ($id_akun, $id_artikel, $id_artikel_detail, $request->jdl);
        
        $countPnl = 0;
        foreach ($penulis_jurusan as $key => $value){
            echo "<br>Penulis-".$countPnl;
            $dataPenulis = json_decode((new listController)->getTable('PNL-'.$key),true);
            $id_jurusan = $this->insertProdi ($value);
            $id_penulis = $this->insertPenulis ($id_jurusan,$key);
            
            if($id_jurusan && $dataPenulis) {
                echo "<br>Ini Penulis dan Prodi yang sudah terdaftar di DB<br>";
                $id_penulis = $dataPenulis[0]['ID_PENULIS'];
                if($dataPenulis[0]['ID_JURUSAN'] == $id_jurusan) {
                    echo "<br>Ini Penulis yang sudah terdaftar sesuai dengan jurusannya<br>";
                }
                else {
                    echo "<br>Ini Penulis yang sudah terdaftar TAPI TIDAK sesuai dengan jurusannya<br>";
                }
            }
            $this->insertArtikelPenulis ($id_artikel_detail, $id_penulis, $i);
            
            $countPnl += 1;
        }
        return redirect()
            ->route('article.create')
            ->with(['success' => 'Berhasil Upload Artikel Baru']);
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
            // echo $Count_penulis_jurusan."<br>";
            // dd($penulis_jurusan);
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
            // echo "<br>has File (1/0): ".($request->hasFile('file'))."<br>";
            if ($request->hasFile('file')) {
                echo $request->file('file')->getClientOriginalName()."<br>";
                echo $request->file('file')->getClientOriginalExtension()."<br>";
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
        
        //initial [ID_AKUN], [ID_ARTIKEL], [ID_ARTIKEL_DETAIL]
            $id_akun = (new listController)->getAkun()[0]['ID_AKUN'];
            $artikelDetail = json_decode((new listController)->getTable('Judul-'.$id_article),true);
            $id_artikel_detail = substr($artikelDetail[0]['ID_DETAILARTIKEL'],0,5);
            $id_artikel_detail_last = intval(substr($artikelDetail[0]['ID_DETAILARTIKEL'],5)) + 1;
            $id_artikel = $artikelDetail[0]['ID_ARTIKEL'];
            $id_artikel_detail = $id_artikel_detail.$id_artikel_detail_last;
        //

        //store Artikel
            $file_ext =  $request->file('file')->getClientOriginalExtension();
            $file = $id_artikel_detail.".".$file_ext;
            $path = $request->file('file')->storeAs('public/article/'.$id_akun.'/'.$id_artikel,$file);
            // dd($path);
        //

        $this->insertArtikel ($id_akun, $id_artikel, $id_artikel_detail, $request->jdl);
        
        $countPnl = 0;
        foreach ($penulis_jurusan as $key => $value){
            echo "<br>Penulis-".$countPnl;
            $dataPenulis = json_decode((new listController)->getTable('PNL-'.$key),true);
            $id_jurusan = $this->insertProdi ($value);
            $id_penulis = $this->insertPenulis ($id_jurusan,$key);
            
            if($id_jurusan && $dataPenulis) {
                echo "<br>Ini Penulis dan Prodi yang sudah terdaftar di DB<br>";
                $id_penulis = $dataPenulis[0]['ID_PENULIS'];
                if($dataPenulis[0]['ID_JURUSAN'] == $id_jurusan) {
                    echo "<br>Ini Penulis yang sudah terdaftar sesuai dengan jurusannya<br>";
                }
                else {
                    echo "<br>Ini Penulis yang sudah terdaftar TAPI TIDAK sesuai dengan jurusannya<br>";
                }
            }
            $this->insertArtikelPenulis ($id_artikel_detail, $id_penulis, $i);
            
            $countPnl += 1;
        }
        return redirect()
            ->route('myarticle')
            ->with(['success' => 'Berhasil Upload Revisi Artikel Baru']);
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
        
        $id_artikelDetail = json_decode((new listController)->getTable('Judul-'.$id),true)[0]['ID_DETAILARTIKEL'];
        $tableArray = json_decode((new listController)->getTable('Article-'.$id_artikelDetail),true);


        $judul =  (new listController)->UniqueList($tableArray,'JUDUL');
        $penulis = (new listController)->UniqueList($tableArray,'PENULIS');

        $final = (new listController)->TabletoList($tableArray,$judul,'up-ri-sta');

        $arrayAkun = (new listController)->getAkun();

        // print_r($tableArray);
        return view('lihatArticle',compact('arrayAkun','final','judul','penulis','taskbarValue'));
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
        $tableArray;
        $loop = false;
        
        $AlltableArray = json_decode((new listController)->getTable('All'),true);
        $a = 0;
        while ($a <= 1) {
            // echo $id."<br>";
            $tableArray = json_decode((new listController)->getTable('Penulis-'.$id),true);
            if (empty($tableArray) && $a == 0) {
                $id = json_decode((new listController)->getTable('PNL-'.substr($id,1)),true);
                $pp = json_decode((new listController)->getTable('Akun-'.$id[0]['ID_AKUN']),true)[0]['FOTO_PROFIL'];
                $id = $id[0]['ID_PENULIS'];
            }
            $a += 1;
        }
        $tableProdi = json_decode((new listController)->getTable('Prodi'),true);

        $namaPenulis;
        if (!empty($tableArray)) {
            $judul =  (new listController)->UniqueList($tableArray,'JUDUL');
            $penulis = (new listController)->UniqueList($tableArray,'PENULIS');
            $final = (new listController)->TabletoList($tableArray,$judul,'up-ri-sta');
            $namaPenulis = $final[0][2];
        }
        else {
            $judul =  [];
            $penulis = [];
            $tableArray = json_decode((new listController)->getTable('PNL-'.$id),true);
            $final[0] = array('NAMA_PENULIS' => $tableArray[0]['NAMA_PENULIS']);
            $namaPenulis = $final[0]['NAMA_PENULIS'];
        }

        $arrayAkun = (new listController)->getAkun();

        // echo "hh".$pp;
        // print_r($final);
        // echo "<br>";
        // print_r($arrayAkun);
        if (!empty($arrayAkun) && $arrayAkun[0]['STATUS_AKUN'] == 'Penulis') {
            if ($arrayAkun[0]['NAMA'] != $namaPenulis) {
                // echo 'to article by penulis';
                return view('myarticle',compact('arrayAkun','namaPenulis','judul','penulis','tableProdi','final','pp','taskbarValue','tableArray','AlltableArray'));
            }
            else {
                // echo 'to my article';
                return redirect()->route('myarticle');
            }
        }
        else {
            // echo 'to article by penulis';
            return view('myarticle',compact('arrayAkun','namaPenulis','judul','penulis','tableProdi','final','pp','taskbarValue','tableArray','AlltableArray'));
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
    public function destroy($id) {
        //
    }

    function insertArtikel ($id_akun, $id_artikel, $id_artikel_detail, $judul) {
        // dd(artikel::where('ID_ARTIKEL', '=', $id_artikel)->doesntExist(),artikel::where('ID_ARTIKEL', '=', $id_artikel)->get());
        if(artikel::where('ID_ARTIKEL', '=', $id_artikel)->doesntExist()) {
            DB::table('artikel')-> INSERT ([
                    'ID_ARTIKEL' => $id_artikel, 'ID_AKUN' => $id_akun]);
        }

        DB::table('artikel_detail')-> INSERT ([
                'ID_DETAILARTIKEL' => $id_artikel_detail,
                'ID_ARTIKEL' => $id_artikel,
                'JUDUL_ARTIKEL' => $judul,
                'TANGGAL_UPLOAD' => date("Y-m-d"),
                'STATUS_ARTIKEL' => 'Draft'
            ]);
    }

    function insertProdi ($value) {
        $dataJurusan = json_decode((new listController)->getTable('Prodi-'.$value),true);
        $id_jurusan = '';
        if(!$dataJurusan) {
            $lastIdProdi = count(json_decode((new listController)->getTable('Prodi'),true)) + 1;
            DB::table('jurusan')-> INSERT (['ID_JURUSAN' => 'Jurusan-'.$lastIdProdi, 'NAMA_JURUSAN' => $value]);
            $id_jurusan = 'Jurusan-'.$lastIdProdi;
        }
        else { $id_jurusan = $dataJurusan[0]['ID_JURUSAN']; }
        return $id_jurusan;
    }

    function insertPenulis ($id_jurusan,$key) {
        $id_penulis = $key;
        $dataPenulis = json_decode((new listController)->getTable('PNL-'.$key),true);
        if(!$dataPenulis) {
            $lastIdPenulis = strval(date("m").(date("d")+date("B")))."-1";
            $id_penulis = "PNL".substr(md5($lastIdPenulis),0,4);
            DB::table('penulis')-> INSERT ([
                'ID_PENULIS' => $id_penulis,
                'ID_AKUN' => null,
                'ID_JURUSAN' => $id_jurusan,
                'NAMA_PENULIS' => $key
            ]);
            echo "<br>Create new Penulis Tanpa Akun<br>";
        }
        return $id_penulis;
    }

    function insertArtikelPenulis ($id_artikel_detail, $id_penulis, $i){
        DB::table('artikel_detail_penulis') -> INSERT ([
                    'ID_LIST_PENULIS' => 'PNL'.$id_artikel_detail."-".$i,
                    'ID_DETAILARTIKEL' => $id_artikel_detail,
                    'ID_PENULIS' => $id_penulis
                ]);
    }
}
