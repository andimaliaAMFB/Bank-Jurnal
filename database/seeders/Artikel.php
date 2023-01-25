<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class Artikel extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Artikel Data
        $akun = DB::table('akun')->get();
        $idArtikel = array();
        foreach ($akun as $index=>$data) { array_push($idArtikel,1); }

        for ($i=0; $i < 25; $i++) {
            $idAkun = rand(0,count($akun)-1);
            DB::table('artikel')-> INSERT ([
                'ID_ARTIKEL' => $akun[$idAkun]->ID_AKUN."-".(date('m')+date("d")+date("B")).$idArtikel[$idAkun],
                'ID_AKUN' => $akun[$idAkun]->ID_AKUN]);
            
            $idArtikel[$idAkun] = $idArtikel[$idAkun] + 1;
        }

        // Add Artikel_Detail Data
        $artikel = DB::table('artikel')->get();
        $status = array('Draft','Revisi Mayor','Revisi Minor','Layak Publish');
        $idArtikelDetail = array();
        foreach ($artikel as $index=>$data) { array_push($idArtikelDetail,1); }

        foreach ($artikel as $index=>$data) {
            for ($i=0; $i < 4; $i++) { 
                $randomStatus = rand(1,count($status)-1);
                if ($i == 0) { $randomStatus = 0; }
                DB::table('artikel_detail')-> INSERT ([
                    'ID_DETAILARTIKEL' => substr(md5($artikel[$index]->ID_ARTIKEL),0,4)."-".$idArtikelDetail[$index],
                    'ID_ARTIKEL' => $artikel[$index]->ID_ARTIKEL,
                    'JUDUL_ARTIKEL' => "Judul Artikel ".$artikel[$index]->ID_ARTIKEL."-".$idArtikelDetail[$index],
                    'TANGGAL_UPLOAD' => date("Y-m-d"), 'STATUS_ARTIKEL' => $status[$randomStatus]
                ]);
                $idArtikelDetail[$index] = $idArtikelDetail[$index] + 1;
                if ($randomStatus == 3) { $i = 4; }
                if ($i != 3 && $randomStatus != 3) { if ((bool)random_int(0, 1)) { $i = 4; } }
                if ($i == 3 && $randomStatus != 3) { if ((bool)random_int(0, 1)) { $i = 0; } }
            }
        }

        // Add Artikel_Detail_Penulis Data
        $detailArtikel = DB::table('artikel_detail')->get();
        $penulis = DB::table('penulis')->get();
        foreach ($detailArtikel as $index=>$data) {
            $batas = rand(1,4);
            for ($i=0; $i < $batas; $i++) { 
                DB::table('artikel_detail_penulis') -> INSERT ([
                    'ID_LIST_PENULIS' => 'PNL'.$detailArtikel[$index]->ID_DETAILARTIKEL."-".$i,
                    'ID_DETAILARTIKEL' => $detailArtikel[$index]->ID_DETAILARTIKEL,
                    'ID_PENULIS' => $penulis[rand(0,count($penulis)-1)]->ID_PENULIS
                ]);
            }
        }
    }
}
