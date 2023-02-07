<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\artikel;
use App\Models\artikel_detail;
use App\Models\artikel_detail_penulis;
use App\Models\revisi;
use App\Models\revisi_detail;
use App\Models\penulis;
use App\Models\jurusan;
use DB;
use Session;

class listController extends Controller
{
    function getTable (string $typeTable) {
        if ($typeTable == 'Layak Publish'){
            $Array = DB::table('artikel_detail')
                    ->join('artikel','artikel_detail.ID_ARTIKEL','=','artikel.ID_ARTIKEL')
                    ->join('artikel_detail_penulis','artikel_detail_penulis.ID_DETAILARTIKEL','=','artikel_detail.ID_DETAILARTIKEL')
                    ->join('penulis','penulis.ID_PENULIS', '=', 'artikel_detail_penulis.ID_PENULIS')
                    ->join('jurusan','jurusan.ID_JURUSAN', '=', 'penulis.ID_JURUSAN')
                    ->join('revisi','revisi.ID_DETAILARTIKEL','=','artikel_detail.ID_DETAILARTIKEL')
                    ->join('revisi_detail','revisi_detail.ID_REVISI', '=', 'revisi.ID_REVISI')
                    ->select('artikel_detail.JUDUL_ARTIKEL',
                                'revisi_detail.STATUS_REVISI',
                                'penulis.NAMA_PENULIS',
                                'jurusan.NAMA_JURUSAN',
                                'artikel.ID_ARTIKEL',
                                'artikel_detail.ID_DETAILARTIKEL')
                    ->Where(function($query) use ($typeTable) {
                        $query->where('artikel_detail.STATUS_ARTIKEL','=',$typeTable)
                                ->orWhere('revisi_detail.STATUS_ARTIKEL_BARU','=',$typeTable);
                    })
                    ->orderByDesc('artikel.ID_ARTIKEL')
                    ->orderByDesc('artikel_detail.ID_DETAILARTIKEL')
                    ->get();
        }
        else if ($typeTable == 'Draft' || 
                $typeTable == 'Revisi Mayor' || 
                $typeTable == 'Revisi Minor'){
            $Array = DB::table('artikel_detail')
                    ->join('artikel','artikel_detail.ID_ARTIKEL','=','artikel.ID_ARTIKEL')
                    ->join('artikel_detail_penulis','artikel_detail_penulis.ID_DETAILARTIKEL','=','artikel_detail.ID_DETAILARTIKEL')
                    ->join('penulis','penulis.ID_PENULIS', '=', 'artikel_detail_penulis.ID_PENULIS')
                    ->join('jurusan','jurusan.ID_JURUSAN', '=', 'penulis.ID_JURUSAN')
                    ->join('revisi','revisi.ID_DETAILARTIKEL','=','artikel_detail.ID_DETAILARTIKEL')
                    ->join('revisi_detail','revisi_detail.ID_REVISI', '=', 'revisi.ID_REVISI')
                    ->select('artikel.ID_ARTIKEL',
                            'artikel_detail.ID_DETAILARTIKEL',
                            'artikel_detail.JUDUL_ARTIKEL',
                            'revisi_detail.STATUS_REVISI',
                            'penulis.NAMA_PENULIS',
                            'jurusan.NAMA_JURUSAN')
                    ->where('artikel_detail.STATUS_ARTIKEL','=',$typeTable)
                    ->orderByDesc('artikel.ID_ARTIKEL')
                    ->orderByDesc('artikel_detail.ID_DETAILARTIKEL')
                    ->get();
        }
        else if (str_contains($typeTable,'MyArticle')){
            $Array = DB::table('artikel_detail')
                    ->join('artikel','artikel_detail.ID_ARTIKEL','=','artikel.ID_ARTIKEL')
                    ->join('artikel_detail_penulis','artikel_detail_penulis.ID_DETAILARTIKEL','=','artikel_detail.ID_DETAILARTIKEL')
                    ->join('penulis','penulis.ID_PENULIS', '=', 'artikel_detail_penulis.ID_PENULIS')
                    ->join('jurusan','jurusan.ID_JURUSAN', '=', 'penulis.ID_JURUSAN')
                    ->join('revisi','revisi.ID_DETAILARTIKEL','=','artikel_detail.ID_DETAILARTIKEL')
                    ->join('revisi_detail','revisi_detail.ID_REVISI', '=', 'revisi.ID_REVISI')
                    ->select('artikel.ID_ARTIKEL',
                            'artikel_detail.ID_DETAILARTIKEL',
                            'artikel_detail.JUDUL_ARTIKEL',
                            'revisi_detail.STATUS_REVISI',
                            'penulis.NAMA_PENULIS',
                            'jurusan.NAMA_JURUSAN',
                            'artikel_detail.TANGGAL_UPLOAD',
                            'artikel_detail.STATUS_ARTIKEL',
                            'revisi_detail.STATUS_ARTIKEL_BARU')
                    ->where('penulis.ID_PENULIS','=',substr($typeTable,10))
                    ->orderByDesc('artikel.ID_ARTIKEL')
                    ->orderByDesc('artikel_detail.ID_DETAILARTIKEL')
                    ->get();
        }
        else if (str_contains($typeTable,'Article-')){
            $Array = DB::table('artikel_detail')
                    ->join('artikel','artikel_detail.ID_ARTIKEL','=','artikel.ID_ARTIKEL')
                    ->join('artikel_detail_penulis','artikel_detail_penulis.ID_DETAILARTIKEL','=','artikel_detail.ID_DETAILARTIKEL')
                    ->join('penulis','penulis.ID_PENULIS', '=', 'artikel_detail_penulis.ID_PENULIS')
                    ->join('jurusan','jurusan.ID_JURUSAN', '=', 'penulis.ID_JURUSAN')
                    ->join('revisi','revisi.ID_DETAILARTIKEL','=','artikel_detail.ID_DETAILARTIKEL')
                    ->join('revisi_detail','revisi_detail.ID_REVISI', '=', 'revisi.ID_REVISI')
                    ->select('artikel.ID_ARTIKEL',
                            'artikel_detail.JUDUL_ARTIKEL',
                            'revisi_detail.STATUS_REVISI',
                            'penulis.NAMA_PENULIS',
                            'jurusan.NAMA_JURUSAN',
                            'artikel_detail.TANGGAL_UPLOAD',
                            'artikel_detail.STATUS_ARTIKEL',
                            'revisi_detail.STATUS_ARTIKEL_BARU')
                    ->where('artikel_detail.ID_DETAILARTIKEL','=',substr($typeTable,8))
                    ->orderByDesc('artikel.ID_ARTIKEL')
                    ->orderByDesc('artikel_detail.ID_DETAILARTIKEL')
                    ->get();
        }
        else if (str_contains($typeTable,'Penulis-')){
            $Array = DB::table('artikel_detail')
                    ->join('artikel','artikel_detail.ID_ARTIKEL','=','artikel.ID_ARTIKEL')
                    ->join('artikel_detail_penulis','artikel_detail_penulis.ID_DETAILARTIKEL','=','artikel_detail.ID_DETAILARTIKEL')
                    ->join('penulis','penulis.ID_PENULIS', '=', 'artikel_detail_penulis.ID_PENULIS')
                    ->join('jurusan','jurusan.ID_JURUSAN', '=', 'penulis.ID_JURUSAN')
                    ->join('revisi','revisi.ID_DETAILARTIKEL','=','artikel_detail.ID_DETAILARTIKEL')
                    ->join('revisi_detail','revisi_detail.ID_REVISI', '=', 'revisi.ID_REVISI')
                    ->select('artikel.ID_ARTIKEL',
                            'artikel_detail.JUDUL_ARTIKEL',
                            'revisi_detail.STATUS_REVISI',
                            'penulis.NAMA_PENULIS',
                            'jurusan.NAMA_JURUSAN',
                            'artikel_detail.TANGGAL_UPLOAD',
                            'artikel_detail.STATUS_ARTIKEL',
                            'revisi_detail.STATUS_ARTIKEL_BARU',
                            'artikel_detail.ID_DETAILARTIKEL')
                    ->where('penulis.ID_PENULIS','=',substr($typeTable,8))
                    ->where('revisi_detail.STATUS_ARTIKEL_BARU','=','Layak Publish')
                    ->orderByDesc('artikel.ID_ARTIKEL')
                    ->orderByDesc('artikel_detail.ID_DETAILARTIKEL')
                    ->get();
        }
        else if (str_contains($typeTable,'Judul-')){
            $Array = DB::table('artikel_detail')
                    ->join('artikel','artikel_detail.ID_ARTIKEL','=','artikel.ID_ARTIKEL')
                    ->join('revisi','revisi.ID_DETAILARTIKEL','=','artikel_detail.ID_DETAILARTIKEL')
                    ->join('revisi_detail','revisi_detail.ID_REVISI', '=', 'revisi.ID_REVISI')
                    ->select('artikel.ID_ARTIKEL',
                            'artikel_detail.ID_DETAILARTIKEL',
                            'artikel_detail.JUDUL_ARTIKEL',
                            'revisi.ID_REVISI',
                            'revisi_detail.ID_DETAILREVISI',
                            'artikel_detail.STATUS_ARTIKEL',
                            'revisi_detail.STATUS_ARTIKEL_BARU',
                            'revisi_detail.REVISI')
                    ->where('artikel_detail.JUDUL_ARTIKEL','=',substr($typeTable,6))
                    ->orderByDesc('artikel.ID_ARTIKEL')
                    ->orderByDesc('artikel_detail.ID_DETAILARTIKEL')
                    ->get();
        }
        else if (str_contains($typeTable,'Akun-')) {
            $Array = DB::table('akun')
                    ->where('ID_AKUN','=',substr($typeTable,5))
                    ->get();
        }
        else if (str_contains($typeTable,'PNL-')) {
            $Array = DB::table('akun')
                    ->join('penulis','penulis.ID_AKUN','=','akun.ID_AKUN')
                    ->where('penulis.ID_AKUN','=',substr($typeTable,4))
                    ->orWhere('penulis.ID_PENULIS','=',substr($typeTable,4))
                    ->orWhere('penulis.NAMA_PENULIS','=',substr($typeTable,4))
                    ->get();
        }
        else if (str_contains($typeTable,'KOTA-')) {
            $Array = DB::table('kota')
                    ->where('ID_KOTA','=',substr($typeTable,5))
                    ->orWhere('NAMA_KOTA','=',substr($typeTable,5))
                    ->get();
        }
        else if (str_contains($typeTable,'PROV-')) {
            $Array = DB::table('provinsi')
                    ->where('ID_PROVINSI','=',substr($typeTable,5))
                    ->orWhere('NAMA_PROVINSI','=',substr($typeTable,5))
                    ->get();
        }
        else if (str_contains($typeTable,'Prodi-')) {
            $Array = DB::table('jurusan')
                    ->where('ID_JURUSAN','=',substr($typeTable,6))
                    ->orWhere('NAMA_JURUSAN','=',substr($typeTable,6))
                    ->get();
        }
        else if ($typeTable == 'All') {
            $Array = DB::table('artikel_detail')
                    ->join('artikel','artikel_detail.ID_ARTIKEL','=','artikel.ID_ARTIKEL')
                    ->join('artikel_detail_penulis','artikel_detail_penulis.ID_DETAILARTIKEL','=','artikel_detail.ID_DETAILARTIKEL')
                    ->join('penulis','penulis.ID_PENULIS', '=', 'artikel_detail_penulis.ID_PENULIS')
                    ->join('jurusan','jurusan.ID_JURUSAN', '=', 'penulis.ID_JURUSAN')
                    ->join('revisi','revisi.ID_DETAILARTIKEL','=','artikel_detail.ID_DETAILARTIKEL')
                    ->join('revisi_detail','revisi_detail.ID_REVISI', '=', 'revisi.ID_REVISI')
                    ->select('artikel.ID_ARTIKEL',
                            'artikel_detail.ID_DETAILARTIKEL',
                            'artikel_detail.JUDUL_ARTIKEL',
                            'revisi_detail.STATUS_REVISI',
                            'penulis.NAMA_PENULIS',
                            'jurusan.NAMA_JURUSAN',
                            'artikel_detail.TANGGAL_UPLOAD',
                            'artikel_detail.STATUS_ARTIKEL',
                            'revisi_detail.STATUS_ARTIKEL_BARU',
                            'revisi_detail.REVISI')
                    ->orderByDesc('artikel_detail.ID_DETAILARTIKEL')
                    ->get();
        }
        else if ($typeTable == 'Judul') {
            $TableArray = DB::table('artikel')
                    ->join('artikel_detail', 'artikel_detail.ID_DETAILARTIKEL', '=', 'artikel.ID_ARTIKEL' )
                    ->select('artikel.ID_ARTIKEL', 'artikel_detail.ID_DETAILARTIKEL','artikel_detail.JUDUL_ARTIKEL')
                    ->get();
            $Array = [];
            foreach ($TableArray as $key => $value) {
                $lastNumber = 1;
                if ($key < (count($TableArray)-1) && $TableArray[$key]->ID_ARTIKEL == $TableArray[($key + 1)]->ID_ARTIKEL) {
                    $lastNumber = $lastNumber + 1;
                }
                else {
                    $lastNumber = intval(substr($TableArray[$key]->ID_DETAILARTIKEL,5));
                    array_push($Array,$TableArray[$key]->JUDUL_ARTIKEL);
                }
            }
        }
        else if ($typeTable == 'Penulis') { $Array = DB::table('penulis')->get(); }
        else if ($typeTable == 'Prodi') { $Array = DB::table('jurusan')->get(); }
        else if ($typeTable == 'Kota') { $Array = DB::table('kota')->get(); }
        else if ($typeTable == 'Prov') { $Array = DB::table('provinsi')->get(); }
        return $Array;
    }
    function TabletoList (array $tableArray,array $Judul, string $format) {
        $Final = array();
        foreach ($Judul as $key => $value) {
            $status = "";
            $tanggalUp = "";
            $tanggalRilis = "";
            $finalizeAdd = false;
            $listFinalize = "";
            $listPenulis = "";
            $listJurusan = "";
            foreach ($tableArray as $index => $data) {
                if ($tableArray[$index]['JUDUL_ARTIKEL'] == $Judul[$key]) {
                    if (!str_contains($listPenulis,$tableArray[$index]['NAMA_PENULIS'])) {
                        $listPenulis = $listPenulis.$tableArray[$index]['NAMA_PENULIS'];
                    }
                    if (!str_contains($listJurusan,$tableArray[$index]['NAMA_JURUSAN'])) {
                        $listJurusan = $listJurusan.$tableArray[$index]['NAMA_JURUSAN'];
                    }
                    if ($index < count($tableArray)-1 && $tableArray[($index + 1)]['JUDUL_ARTIKEL'] == $Judul[$key])  {
                        if (!str_contains($listPenulis,$tableArray[($index + 1)]['NAMA_PENULIS'])) {
                            $listPenulis = $listPenulis.", ";
                        }
                        if (!str_contains($listJurusan,$tableArray[($index + 1)]['NAMA_JURUSAN'])) {
                            $listJurusan = $listJurusan.", ";
                        }
                    }
                    if (!$finalizeAdd) {
                        if ($tableArray[$index]['STATUS_REVISI'] == '1') {
                            $listFinalize = 'Yes';
                        }
                        else if ($tableArray[$index]['STATUS_REVISI'] == '0') {$listFinalize = 'No';}
                        if ($format == 'up-ri-sta') {
                            if ($tableArray[$index]['TANGGAL_UPLOAD']) { $tanggalUp = $tableArray[$index]['TANGGAL_UPLOAD']; }
                            if ($tableArray[$index]['STATUS_ARTIKEL_BARU'] != '-') {
                                $tanggalRilis = '-';
                                if ($tableArray[$index]['STATUS_ARTIKEL_BARU'] == 'Layak Publish') {
                                    $tanggalRilis = $tableArray[$index]['TANGGAL_UPLOAD'];
                                }
                                $status = $tableArray[$index]['STATUS_ARTIKEL_BARU'];
                            }
                            else {  $status = $tableArray[$index]['STATUS_ARTIKEL']; $tanggalRilis = '-'; }
                        }
                        $finalizeAdd = true;
                    }
                    if ($index < count($tableArray)-1 && $tableArray[($index + 1)]['JUDUL_ARTIKEL'] != $Judul[$key])  {
                        if (!$finalizeAdd) {
                            if ($listFinalize.$tableArray[$index]['STATUS_REVISI'] == '1') {
                                $listFinalize = 'Yes';
                            }
                            else {$listFinalize = 'No';}
                            if ($format == 'up-ri-sta') {
                                if ($tableArray[$index]['TANGGAL_UPLOAD']) { $tanggalUp = $tableArray[$index]['TANGGAL_UPLOAD']; }
                                if ($tableArray[$index]['STATUS_ARTIKEL_BARU'] != '-') {
                                    $tanggalRilis = '-';
                                    if ($tableArray[$index]['STATUS_ARTIKEL_BARU'] == 'Layak Publish') {
                                        $tanggalRilis = $tableArray[$index]['TANGGAL_UPLOAD'];
                                    }
                                    $status = $tableArray[$index]['STATUS_ARTIKEL_BARU'];
                                }
                                else {  $status = $tableArray[$index]['STATUS_ARTIKEL']; $tanggalRilis = '-'; }
                            }
                            $FinalizeAdd = true;
                        }
                    }
                }
            }
            if ($format == 'up-ri-sta') {
                $Final[]= [0 => $Judul[$key], 1 => $listFinalize, 
                            2 => $listPenulis, 3 => $listJurusan,
                            4 =>$tanggalUp, 5=> $tanggalRilis, 6=> $status];
            }
            else {
                $Final[]= [0 => $Judul[$key], 1 => $listFinalize, 
                            2 => $listPenulis, 3 => $listJurusan];
            }
        }
        // print_r($Final);
        return $Final;
    }
    function UniqueList (array $tableArray, string $ColumnTable) {
        $Array = array();
        foreach ($tableArray as $index => $data) {
            if (str_contains($ColumnTable,'JUDUL')) { $Array[] = $tableArray[$index]['JUDUL_ARTIKEL']; }
            else if (str_contains($ColumnTable,'STATUS')) { $Array[] = $tableArray[$index]['STATUS_REVISI']; }
            else if (str_contains($ColumnTable,'PENULIS')) { $Array[] = $tableArray[$index]['NAMA_PENULIS']; }
            else if (str_contains($ColumnTable,'JURUSAN')) { $Array[] = $tableArray[$index]['NAMA_JURUSAN']; }
        }
        // printf(count($Array).", ".count(array_values($Array)));
        if (count($Array) != 0) {
            $Array = array_unique($Array);
            $Array = array_combine(range(0,count($Array)-1),array_values($Array));
        }
        return $Array;
    }
    function CountRevisied (array $TableArray, string $type) {
        $count = 0;
        $jdl = '';
        foreach ($TableArray as $key => $value) {
            if ($value[0] != $jdl) {
                $jdl = $value[0];
                if ($type == 'Admin' && $value[1] == "No") { $count = $count + 1; }
                else if ($type == 'Penulis' && $value[1] == "Yes" && $value[6] != 'Layak Publish') {
                    $count = $count + 1;
                }
            }
        }
        return $count;
    }
    function SliceTable (array $TableArray, array $AlltableArray, string $typeTable) {
        $array_at_key = array();
        foreach ($TableArray as $key => $value) {
            $currentID = intval(substr($TableArray[$key]['ID_DETAILARTIKEL'],5));
            // echo $key."<br>";
            // print_r($TableArray[$key]);
            // echo "<br>";
            foreach ($AlltableArray as $keyAll => $valueAll) {
                if ($AlltableArray[$keyAll]['ID_ARTIKEL'] == $TableArray[$key]['ID_ARTIKEL']) {
                    $currentIDAll = intval(substr($AlltableArray[$keyAll]['ID_DETAILARTIKEL'],5));
                    if ($currentID < $currentIDAll) {
                        $array_at_key[] = $key;
                    }
                }
            }
        }

        // echo "<br>===================================================<br>";
        // print_r($array_at_key);
        // echo "<br>";

        // echo "<br>===================================================<br>";
        $array_at_key = array_values(array_unique($array_at_key));
        // print_r($array_at_key);
        // echo "<br>";

        foreach ($array_at_key as $key => $value) {
            // echo $key.": ".$value."<br>";
            unset($TableArray[$value]);
        }

        // echo "<br>===================================================<br>";
        $TableArray = array_values($TableArray);
        $id_artikel = '';
        $count = 0;
        foreach ($TableArray as $key => $value) {
            if ($TableArray[$key]['JUDUL_ARTIKEL'] != $id_artikel) {
                $id_artikel = $TableArray[$key]['JUDUL_ARTIKEL'];
                // echo $key."<br>";
                // print_r($TableArray[$key]);
                // echo "<br>";
                $count += 1;
            }
        }
        // echo $count;
        return $TableArray;
    }
    function finalArray ($tableArray) {
        $final = [];
        
        $id_article_TA = '';
        foreach ($tableArray as $key => $value) {
            if($id_article_TA != $value['ID_ARTIKEL'])
            {
                $id_article_TA = $value['ID_ARTIKEL'];
                
                $datamodel = (artikel_detail::where('ID_ARTIKEL', '=', $id_article_TA)
                            ->orderByDesc('ID_DETAILARTIKEL')
                            ->first());
                
                if ($datamodel['ID_DETAILARTIKEL'] == $value['ID_DETAILARTIKEL']) {
                    $listPenulis = artikel_detail_penulis::where('ID_DETAILARTIKEL','=',$value['ID_DETAILARTIKEL'])
                                    ->get();
                    $list_of_penulis = [];
                    $list_of_prodi = [];
                    foreach($listPenulis as $index => $datapenulis) {
                        $detail_penulis = penulis::where('ID_PENULIS','=',$datapenulis['ID_PENULIS'])->get();
                        if (!in_array($detail_penulis[0]['NAMA_PENULIS'],$list_of_penulis)) {
                            $list_of_penulis[] = $detail_penulis[0]['NAMA_PENULIS'];
                            $list_of_prodi[] = jurusan::where('ID_JURUSAN','=',$detail_penulis[0]['ID_JURUSAN'])->value('NAMA_JURUSAN');
                        }
                    }
                    $stringList_of_penulis = '';
                    $stringList_of_prodi = '';
                    foreach($list_of_penulis as $index => $datapenulis){
                        $stringList_of_penulis = $stringList_of_penulis.$datapenulis;
                        $stringList_of_prodi = $stringList_of_prodi.$list_of_prodi[$index];
                        if ($index < count($list_of_penulis)-1){
                            $stringList_of_penulis = $stringList_of_penulis.', ';
                            $stringList_of_prodi = $stringList_of_prodi.', ';
                        }
                    }
                    
                    $revisi = revisi::where('ID_DETAILARTIKEL','=',$value['ID_DETAILARTIKEL'])->value('ID_REVISI');
                    $detail_revisi = revisi_detail::where('ID_REVISI','=',$revisi)->get();
                    $tanggalUp = '-';
                    $finalize = 'No';
                    $status = $detail_revisi[0]['STATUS_ARTIKEL_BARU'];
                    if($detail_revisi[0]['STATUS_ARTIKEL_BARU'] == 'Layak Publish') { $tanggalUp = $detail_revisi[0]['TANGGAL_REVISI']; }
                    if($detail_revisi[0]['STATUS_ARTIKEL_BARU'] == '-') { $status = $datamodel['STATUS_ARTIKEL']; }
                    if($detail_revisi[0]['STATUS_REVISI'] == '1') { $finalize = 'Yes'; }
                    else { $finalize = 'No'; }

                    $final[] = [$datamodel['JUDUL_ARTIKEL'],
                                $finalize,
                                $stringList_of_penulis,
                                $stringList_of_prodi,
                                $datamodel['TANGGAL_UPLOAD'],
                                $tanggalUp,
                                $status];
                }
            }
        }
        // dd($tableArray, $final);
        return $final;
    }
    function historyArray ($tableArray) {
        $history = [];
        
        $id_article_TA = '';
        foreach ($tableArray as $key => $value) {
            if($id_article_TA != $value['ID_ARTIKEL'])
            {
                $id_article_TA = $value['ID_ARTIKEL'];

                $datamodel = (artikel_detail::where('ID_ARTIKEL', '=', $id_article_TA)
                            ->orderByDesc('ID_DETAILARTIKEL')
                            ->first());
                
                // compare is this ID_DETAILARTIKEL is the last one from $ID_ARTIKEL
                if ($datamodel['ID_DETAILARTIKEL'] == $value['ID_DETAILARTIKEL']) {
                    $detailArtikel = (artikel_detail::where('ID_ARTIKEL', '=', $id_article_TA)
                                        ->orderBy('ID_DETAILARTIKEL')
                                        ->get());
                    $listTGL = [];
                    $CountHistory = 0;
                    $listPenulis = [];
                    $listStatus = [];
                    $listStatusBaru = [];
                    $listCatatanBaru = [];
                    $listJudul = [];
                    foreach($detailArtikel as $index => $AD){
                        $List_PNL = artikel_detail_penulis::where('ID_DETAILARTIKEL','=',$AD['ID_DETAILARTIKEL'])->get();
                        $listPenulis_AD = [];
                        foreach($List_PNL as $noList => $valueList)
                        {
                            $NamaPenulis = penulis::where('ID_PENULIS','=',$valueList['ID_PENULIS'])->value('NAMA_PENULIS');
                            if (!in_array($NamaPenulis,$listPenulis_AD)) { $listPenulis_AD [] = $NamaPenulis; }
                        }
                        $CountHistory += 1;
                        $listPenulis [] = implode(', ',$listPenulis_AD);
                        
                        $idRevisi = (revisi::where('ID_DETAILARTIKEL', '=', $AD['ID_DETAILARTIKEL'])
                                        ->value('ID_REVISI'));
                        $RD = (revisi_detail::where('ID_REVISI', '=', $idRevisi)
                                        ->orderBy('ID_REVISI')
                                        ->first());
                        
                        $listTGL [] = $AD['TANGGAL_UPLOAD'];
                        $listStatus [] = $AD['STATUS_ARTIKEL'];
                        $listStatusBaru [] = $RD['STATUS_ARTIKEL_BARU'];
                        $listCatatanBaru [] = $RD['REVISI'];
                        $listJudul [] = $AD['JUDUL_ARTIKEL'];
                    }
                    $history[] = [$datamodel['JUDUL_ARTIKEL'],
                                    $CountHistory,
                                    end($listPenulis),
                                    $listTGL,
                                    $listStatus,
                                    $listStatusBaru,
                                    $listCatatanBaru,
                                    $listJudul];
                }
            }
        }
        return $history;
    }


    function taskbarList () {
        $draft = json_decode($this->getTable('Draft'),true);
        $rmayor = json_decode($this->getTable('Revisi Mayor'),true);
        $rminor = json_decode($this->getTable('Revisi Minor'),true);
        
        $list_draft = $this->CountRevisied(($this->finalArray($draft)),'Admin');
        $list_rmayor = $this->CountRevisied(($this->finalArray($rmayor)),'Admin');
        $list_rminor = $this->CountRevisied(($this->finalArray($rminor)),'Admin');
        // dd($list_draft, ($this->finalArray($draft)));

        $listJumlah = ['Draft' => $list_draft,
        'Revisi Mayor' => $list_rmayor,
        'Revisi Minor' => $list_rminor,];

        $arrayAkun = $this->getAkun();
        $myArticle;
        if ($arrayAkun && $arrayAkun[0]['STATUS_AKUN'] == 'Penulis') {
            $idPenulis = json_decode($this->getTable ('PNL-'.$arrayAkun[0]['NAMA']),true)[0]['ID_PENULIS'];
            $myArticle = json_decode($this->getTable('MyArticle-'.$idPenulis),true);
            $list_myArticle = null;
            if($myArticle) { $list_myArticle = $this->CountRevisied(($this->finalArray($myArticle)),'Penulis'); }
            
            $listJumlah = ['Draft' => $list_draft,
                            'Revisi Mayor' => $list_rmayor,
                            'Revisi Minor' => $list_rminor,
                            'My Article' => $list_myArticle];
        }
        // print_r($listJumlah);
        return $listJumlah;
    }
    function getAkun () {
        $arrayID = [];
        if (Session::get('id_akun')) {
            $akun = json_decode($this->getTable('Akun-'.Session::get('id_akun')),true);
            $penulis = json_decode($this->getTable('PNL-'.Session::get('id_akun')),true);
            $kota = json_decode($this->getTable('KOTA-'.$akun[0]['ID_KOTA']),true);
            $prov = json_decode($this->getTable('PROV-'.$akun[0]['ID_PROVINSI']),true);

            // print_r($penulis);
            // echo "<br>".$akun[0]['ID_KOTA']."<br>";
            // print_r($kota);
            // echo "<br>".$akun[0]['ID_PROVINSI']."<br>";
            // print_r($prov);
            if (!empty($penulis) && Session::get('status_akun') != "Admin") {
                $prodi = json_decode($this->getTable('Prodi-'.$penulis[0]['ID_JURUSAN']),true);
                $arrayID[] = ['ID_AKUN' => Session::get('id_akun'),
                                'STATUS_AKUN' => Session::get('status_akun'),
                                'USERNAME' => $akun[0]['USERNAME'],
                                'ID_PENULIS' => $penulis[0]['ID_PENULIS'],
                                'NAMA' => $penulis[0]['NAMA_PENULIS'],
                                'NAMA_JURUSAN' => $prodi[0]['NAMA_JURUSAN'],
                                'NO_TELEPON' => $akun[0]['NO_TELEPON'],
                                'EMAIL' => $akun[0]['EMAIL'],
                                'TANGGAL_LAHIR' => $akun[0]['TANGGAL_LAHIR'],
                                'NAMA_KOTA' => $kota[0]['NAMA_KOTA'],
                                'NAMA_PROVINSI' => $prov[0]['NAMA_PROVINSI'],
                                'ALAMAT' => $akun[0]['ALAMAT'],
                                'KODE_POS' => $akun[0]['KODE_POS'],
                                'FOTO_PROFIL' => $akun[0]['FOTO_PROFIL']];
            }
            else {
                $arrayID[] = ['ID_AKUN' => Session::get('id_akun'),
                                'STATUS_AKUN' => Session::get('status_akun'),
                                'USERNAME' => $akun[0]['USERNAME'],
                                'NAMA' => $akun[0]['NAMA'],
                                'NO_TELEPON' => $akun[0]['NO_TELEPON'],
                                'EMAIL' => $akun[0]['EMAIL'],
                                'TANGGAL_LAHIR' => $akun[0]['TANGGAL_LAHIR'],
                                'NAMA_KOTA' => $kota[0]['NAMA_KOTA'],
                                'NAMA_PROVINSI' => $prov[0]['NAMA_PROVINSI'],
                                'ALAMAT' => $akun[0]['ALAMAT'],
                                'KODE_POS' => $akun[0]['KODE_POS'],
                                'FOTO_PROFIL' => $akun[0]['FOTO_PROFIL']];
            }
        }

        return $arrayID;
    }
    function SearchBarList () {
        $table = json_decode($this->getTable('Layak Publish'),true);
        $finalSearch = $this->finalArray ($table);

        // dd($table,$finalSearch);
        return $finalSearch;
    }
}
