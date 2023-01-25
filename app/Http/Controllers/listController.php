<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
                                'jurusan.NAMA_JURUSAN',)
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
                $typeTable == 'Revisi Minor')
        {
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
                                'jurusan.NAMA_JURUSAN',)
                    ->Where(function($query) use ($typeTable) {
                        $query->where('artikel_detail.STATUS_ARTIKEL','=',$typeTable)
                                ->where('revisi_detail.STATUS_ARTIKEL_BARU','=','-');
                    })
                    ->orderByDesc('artikel.ID_ARTIKEL')
                    ->orderByDesc('artikel_detail.ID_DETAILARTIKEL')
                    ->get();
        }
        else if (str_contains($typeTable,'MyArticle'))
        {
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
                                'artikel_detail.TANGGAL_UPLOAD',
                                'artikel_detail.STATUS_ARTIKEL',
                                'revisi_detail.STATUS_ARTIKEL_BARU')
                    ->where('penulis.ID_PENULIS','=',substr($typeTable,10))
                    ->Where(function($query) {
                        $query->where('revisi_detail.STATUS_ARTIKEL_BARU','=','-')
                                ->orWhere('revisi_detail.STATUS_ARTIKEL_BARU','=','Layak Publish');
                    })
                    ->orderByDesc('artikel.ID_ARTIKEL')
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
        else if ($typeTable == 'Penulis') { $Array = DB::table('penulis')->select('NAMA_PENULIS')->get(); }
        else if ($typeTable == 'Prodi') { $Array = DB::table('jurusan')->select('NAMA_JURUSAN')->get(); }
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
                    if ($index != 0 && $tableArray[($index - 1)]['JUDUL_ARTIKEL'] != $Judul[$key])  {
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
                            $finalizeAdd = true;
                        }
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
        $Array = array_unique($Array);
        $Array = array_combine(range(0,count($Array)-1),array_values($Array));
        return $Array;
    }
    function CountRevisied (array $TableArray) {
        $count = 0;
        $jdl = '';
        foreach ($TableArray as $key => $value) {
            if ($TableArray[$key]['STATUS_REVISI'] == 0 && $TableArray[$key]['JUDUL_ARTIKEL'] != $jdl) {
                $count = $count + 1;
                $jdl = $TableArray[$key]['JUDUL_ARTIKEL'];
            }
        }
        return $count;
    }

    function taskbarList () {
        $draft = $this->CountRevisied(json_decode($this->getTable('Draft'),true));
        $rmayor = $this->CountRevisied(json_decode($this->getTable('Revisi Mayor'),true));
        $rminor = $this->CountRevisied(json_decode($this->getTable('Revisi Minor'),true));

        $listJumlah = ['Draft' => $draft,'Revisi Mayor' => $rmayor,'Revisi Minor' => $rminor,];
        // print_r($listJumlah);
        return $listJumlah;
    }
}
