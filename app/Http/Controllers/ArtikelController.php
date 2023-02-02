<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
