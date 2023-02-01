<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class Revisi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Revisi
        $detailArtikel = DB::table('artikel_detail')->get();
        $akun = DB::table('akun')->where('STATUS_PENGGUNA','=','Admin')->get();
        foreach ($detailArtikel as $index=>$data) {
            $idAkun = rand(0,count($akun)-1);
            if ($detailArtikel[$index]->STATUS_ARTIKEL != 'Layak Publish') { 
                DB::table('revisi') -> INSERT ([
                    'ID_REVISI' => 'REV'.$detailArtikel[$index]->ID_DETAILARTIKEL,
                    'ID_DETAILARTIKEL' => $detailArtikel[$index]->ID_DETAILARTIKEL,
                    'ID_AKUN' => $akun[$idAkun]->ID_AKUN
                ]);
            }
        }

        // Add Revisi_Detail
        $status = array('Draft','Revisi Mayor','Revisi Minor','Layak Publish');
        $revisi = DB::table('revisi')->get();
        foreach ($revisi as $index=>$data) {
            $statusBefore = DB::table('artikel_detail')
                                ->where('ID_DETAILARTIKEL', '=', $revisi[$index]->ID_DETAILARTIKEL)
                                ->value('STATUS_ARTIKEL');
            
            
            if ($statusBefore != 'Layak Publish') {
                $statusAfter = DB::table('artikel_detail')
                                ->where('ID_DETAILARTIKEL', '=', 
                                            substr($revisi[$index]->ID_DETAILARTIKEL,0,5).
                                            (intval(
                                                substr(
                                                    $revisi[$index]->ID_DETAILARTIKEL,5)
                                                ) + 1
                                            ))
                                ->value('STATUS_ARTIKEL');
                $kondisiRevisi = true;
                if (!$statusAfter) {
                    $kondisiRevisi = rand(false,true);
                    if ($kondisiRevisi) {
                        $statusAfter = $status[rand(1,count($status)-1)];
                    }
                    else {
                        $statusAfter = "-";
                    }
                }
                DB::table('revisi_detail') -> INSERT ([
                    'ID_DETAILREVISI' => $revisi[$index]->ID_REVISI."_D",
                    'ID_REVISI' => $revisi[$index]->ID_REVISI,
                    'TANGGAL_REVISI' => date("Y-m-d"),
                    'STATUS_ARTIKEL_BARU' => $statusAfter,
                    'STATUS_REVISI' => $kondisiRevisi,
                    'REVISI' => "REVISI Admin Tentang "
                ]);
            }
        }
    }
}
