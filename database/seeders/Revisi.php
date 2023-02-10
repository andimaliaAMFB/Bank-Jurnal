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
        $detailArtikel = DB::table('artikel_detail')
                        ->where('status_artikel','!=','Layak Publish')
                        ->orderBy('id_artikel')
                        ->orderBy('id_artikel_detail')
                        ->get();
        $users = DB::table('users')->where('status','=','Admin')->get();
        $status = array('Draft','Revisi Mayor','Revisi Minor','Layak Publish');
        
        
        foreach ($detailArtikel as $key => $value) {
            $idAkun = $users[rand(0,count($users)-1)]->id;
            if ($value->status_artikel != 'Layak Publish') {
                $catatanRevisi = "REVISI Admin Tentang ";
                if ($key < count($detailArtikel)-1 && $detailArtikel[$key+1]->id_artikel == $value->id_artikel) {
                    $statusAfter = $detailArtikel[$key+1]->status_artikel;
                    $kondisiRevisi = true;
                }
                else {
                    $kondisiRevisi = rand(false,true);
                    if ($kondisiRevisi) {
                        $statusAfter = $status[rand(1,count($status)-1)];
                    }
                    else {
                        $statusAfter = "-";
                        $catatanRevisi = '';
                        $idAkun = null;
                    }
                }
            }
            else {
                $kondisiRevisi = false;
                $statusAfter = "-";
                $catatanRevisi = '';
                $idAkun = null;
            }
            DB::table('revisi')->INSERT ([
                'id_revisi' => 'REV'.$value->id_artikel_detail,
                'id_artikel_detail' => $value->id_artikel_detail,
                'id_akun' => $idAkun,
                'status_artikel_baru' => $statusAfter,
                'status_revisi' => $kondisiRevisi,
                'catatan_revisi' => $catatanRevisi,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
