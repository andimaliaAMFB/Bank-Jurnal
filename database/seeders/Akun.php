<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class Akun extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kota = DB::table('kota')->select('ID_KOTA')->limit(1)->value('ID_KOTA');
        $provinsi = DB::table('provinsi')->select('ID_PROVINSI')->limit(1)->value('ID_PROVINSI');
        
        for ($i=1; $i <= 5; $i++) { 
            $baseId = strval(date("m").(date("d")+date("B")))."-".(($i*2) - 1);
            DB::table('akun')-> INSERT (['ID_AKUN' => $baseId, 'USERNAME' => 'Admin-'.$i, 'PASSWORD' => substr(md5('admin-'.$i),0,12),
                'NAMA' => 'Super Admin '.$i, 'STATUS_PENGGUNA' => 'Admin','NO_TELEPON' => '', 'EMAIL' => '', 
                'TANGGAL_LAHIR' => date("Y-m-d"), 'ID_KOTA' => $kota, 'ID_PROVINSI' => $provinsi,'ALAMAT' => '', 'KODE_POS' => '']);
            $baseId = strval(date("m").(date("d")+date("B")))."-".($i*2);
            DB::table('akun')-> INSERT (['ID_AKUN' => $baseId, 'USERNAME' => 'Penulis-'.$i, 'PASSWORD' => substr(md5('penulis-'.$i),0,12),
                'NAMA' => 'Penulis '.$i, 'STATUS_PENGGUNA' => 'Penulis', 'NO_TELEPON' => '', 'EMAIL' => '', 
                'TANGGAL_LAHIR' => date("Y-m-d"), 'ID_KOTA' => $kota, 'ID_PROVINSI' => $provinsi,'ALAMAT' => '', 'KODE_POS' => '']);
        }

        $akun = DB::table('akun')->get();
        $jurusan = DB::table('jurusan')->get();

        foreach ($akun as $index=>$column) {
            if ($akun[$index]->STATUS_PENGGUNA != 'Admin') {
                DB::table('penulis')-> INSERT (['ID_PENULIS' => "PNL".substr(md5($akun[$index]->ID_AKUN),0,4), 'ID_AKUN' => $akun[$index]->ID_AKUN,
                    'ID_JURUSAN' => $jurusan[rand(0,count($jurusan)-1)]->ID_JURUSAN, 'NAMA_PENULIS' => $akun[$index]->NAMA]);
            }
        }
    }
}
