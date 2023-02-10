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
            $akun = DB::table('users')->get();
            $idArtikel = array();
            foreach ($akun as $index => $data) { array_push($idArtikel,1); }

            for ($i=0; $i < 50; $i++) {
                $idAkun = rand(0,count($akun)-1);
                DB::table('artikel')-> INSERT ([
                    'id_artikel' => $akun[$idAkun]->id."-".(date('m')+date("d")+date("B")).$idArtikel[$idAkun],
                    'id_akun' => $akun[$idAkun]->id,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                
                $idArtikel[$idAkun] = $idArtikel[$idAkun] + 1;
            }

        // Add Artikel_Detail Data
            $artikel = DB::table('artikel')->get();
            $status = array('Draft','Revisi Mayor','Revisi Minor','Layak Publish');
            $idArtikelDetail = array();
            foreach ($artikel as $index=>$data) { array_push($idArtikelDetail,1); }

            foreach ($artikel as $index => $data) {
                for ($i=0; $i < 4; $i++) { 
                    $randomStatus = rand(1,count($status)-2);
                    if ($i == 0) { $randomStatus = 0; }
                    DB::table('artikel_detail')-> INSERT ([
                        'id_artikel_detail' => substr(md5($data->id_artikel),0,4)."-".$idArtikelDetail[$index],
                        'id_artikel' => $data->id_artikel,
                        'judul_artikel' => "Judul Artikel ".$data->id_artikel."-".$idArtikelDetail[$index],
                        'status_artikel' => $status[$randomStatus]
                    ]);
                    $idArtikelDetail[$index] = $idArtikelDetail[$index] + 1;
                    if ($randomStatus == 3) { $i = 4; }
                    if ($i != 3 && $randomStatus != 3) { if ((bool)random_int(0, 1)) { $i = 4; } }
                    if ($i == 3 && $randomStatus != 3) { if ((bool)random_int(0, 1)) { $i = 0; } }
                }
            }

        // Add Artikel_Detail_Penulis Data
            $penulis = DB::table('penulis')->get();
            foreach (DB::table('artikel_detail')->get() as $index => $data) {
                $batas = rand(1,4);
                for ($i=0; $i < $batas; $i++) { 
                    DB::table('artikel_detail_penulis') -> INSERT ([
                        'id_list_penulis' => 'PNL'.$data->id_artikel_detail."-".$i,
                        'id_penulis' => $penulis[rand(0,count($penulis)-1)]->id_penulis,
                        'id_artikel_detail' => $data->id_artikel_detail
                    ]);
                }
            }
    }
}
