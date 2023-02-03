<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $field = array();
        $penulis_jurusan = [];
        $penulis = '';
        foreach ($request->all() as $key => $value) {
            echo $key.": ".$value."<br>";
            if ($key != '_token') {
                $field[] = $key;
                if (str_contains($key,'pnl')) { $penulis = $value; }
                else if (str_contains($key,'prodi')) { $penulis_jurusan += [$penulis => $value]; }
            }
        }
        print_r($penulis_jurusan);

        $rule = array();
        foreach ($field as $key => $value) { $rule += [$value => 'required']; }

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

        $validator = Validator::make($request->all(), $rule, $pesan);

        if ($validator->fails()) {
            // return redirect()
            //     ->route('article.create')
            //     ->withErrors($validator)
            //     ->withInput();
        }
        
        $id_akun = (new listController)->getAkun()[0]['ID_AKUN'];
        $id_artikel = $id_akun."-".(date('m')+date("d")+date("B")).$id_akun;
        $id_artikel_detail = substr(md5($id_artikel),0,4)."-1";

        // DB::table('artikel')-> INSERT ([
        //     'ID_ARTIKEL' => $id_artikel,
        //         'ID_AKUN' => $id_akun
        // ]);
        // DB::table('artikel_detail')-> INSERT ([
        //     'ID_DETAILARTIKEL' => $id_artikel_detail,
        //     'ID_ARTIKEL' => $id_artikel,
        //     'JUDUL_ARTIKEL' => $request->jdl,
        //     'TANGGAL_UPLOAD' => date("Y-m-d"),
        //     'STATUS_ARTIKEL' => 'Draft'
        // ]);
        $countPnl = 0;
        foreach ($penulis_jurusan as $key => $value)
        {
            echo "<br>Penulis-".$countPnl;
            $dataPenulis = json_decode((new listController)->getTable('PNL-'.$key),true);
            $dataJurusan = json_decode((new listController)->getTable('Prodi-'.$value),true);
            // print_r($dataPenulis);
            // print_r($dataJurusan);
            // $id_jurusan = '';
            if(!$dataJurusan) {
            //     $lastIdProdi = json_decode((new listController)->getTable('Prodi'),true).count();
            //     DB::table('jurusan')-> INSERT (['ID_JURUSAN' => 'Jurusan-'.$lastIdProdi, 'NAMA_JURUSAN' => $value]);
            //     $id_jurusan = 'Jurusan-'.$lastIdProdi;
                echo "<br>Create new Prodi<br>";
            }
            // else { $id_jurusan = $dataJurusan[0]['ID_JURUSAN']; }
            // $id_penulis = '';
            if(!$dataPenulis) {
            //     $lastIdPenulis = strval(date("m").(date("d")+date("B")))."-1";
            //     DB::table('penulis')-> INSERT ([
            //         'ID_PENULIS' => "PNL".substr(md5($lastIdPenulis),0,4),
            //         'ID_AKUN' => null,
            //         'ID_JURUSAN' => $id_jurusan,
            //         'NAMA_PENULIS' => $key
            //     ]);
            //     $id_penulis = $lastIdPenulis;
                echo "<br>Create new Penulis Tanpa Akun<br>";
            }
            if($id_jurusan && $dataPenulis) {
                echo "<br>Ini Penulis dan Prodi yang sudah terdaftar di DB<br>";
            //     $id_penulis = $dataPenulis[0]['ID_PENULIS'];
                if($dataPenulis[0]['ID_JURUSAN'] == $id_jurusan) {
                    echo "<br>Ini Penulis yang sudah terdaftar sesuai dengan jurusannya<br>";
                }
                else {
                    echo "<br>Ini Penulis yang sudah terdaftar TAPI TIDAK sesuai dengan jurusannya<br>";
                }
            }
            // DB::table('artikel_detail_penulis') -> INSERT ([
            //     'ID_LIST_PENULIS' => 'PNL'.$id_artikel_detail."-".$i,
            //     'ID_DETAILARTIKEL' => $id_artikel_detail,
            //     'ID_PENULIS' => $id_penulis
            // ]);
            $countPnl += 1;
        }

        // return redirect()
        //     ->route('article.create')
        //     ->with(['success' => 'Berhasil Upload Artikel Baru']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Restore(Request $request) {
        //
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

        if (!empty($tableArray)) {
            $judul =  (new listController)->UniqueList($tableArray,'JUDUL');
            $penulis = (new listController)->UniqueList($tableArray,'PENULIS');
            $final = (new listController)->TabletoList($tableArray,$judul,'up-ri-sta');
        }
        else {
            $judul =  [];
            $penulis = [];
            $tableArray = json_decode((new listController)->getTable('PNL-'.$id),true);
            $final[0] = array('NAMA_PENULIS' => $tableArray[0]['NAMA_PENULIS']);
        }

        $arrayAkun = (new listController)->getAkun();

        // echo "hh".$pp;
        // print_r($final);
        // echo "<br>";
        // print_r($arrayAkun);
        if (!empty($arrayAkun) && $arrayAkun[0]['STATUS_AKUN'] == 'Penulis') {
            if ($arrayAkun[0]['NAMA'] != $final[0]['NAMA_PENULIS'] || $arrayAkun[0]['NAMA'] != $final[0][2]) {
                // echo 'to article by penulis';
                return view('myarticle',compact('arrayAkun','judul','penulis','tableProdi','final','pp','taskbarValue','tableArray','AlltableArray'));
            }
            else {
                // echo 'to my article';
                return redirect()->route('myarticle');
            }
        }
        else {
            // echo 'to article by penulis';
            return view('myarticle',compact('arrayAkun','judul','penulis','tableProdi','final','pp','taskbarValue','tableArray','AlltableArray'));
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
}
