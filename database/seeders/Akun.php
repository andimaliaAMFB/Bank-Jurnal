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
        $kota = DB::table('kota')->first()->id_kota;
        $provinsi = DB::table('provinsi')->first()->id_provinsi;
        
        for ($i=1; $i <= 5; $i++) { 
            //INSERT Admin
                $baseId = strval(date("m").(date("d")+date("B")))."-".(($i*2) - 1);
                DB::table('users')->INSERT([
                    'id' => $baseId,
                    'username' => 'Admin-'.$i,
                    'password' => bcrypt('admin-'.$i),
                    'status' => 'Admin',
                    'nama_lengkap' => 'Super Admin '.$i,
                    'no_telepon' => '',
                    'email' => 'Admin-'.$i.'@example.com',
                    'tanggal_lahir' => date("Y-m-d"),
                    'id_kota' => $kota,
                    'id_provinsi' => $provinsi,
                    'alamat' => '',
                    'kode_pos' => '',
                    'created_at' => date("Y-m-d H:i:s")
                ]);
            
            //INSERT PENULIS
                $baseId = strval(date("m").(date("d")+date("B")))."-".($i*2);
                DB::table('users')->INSERT([
                    'id' => $baseId,
                    'username' => 'Penulis-'.$i,
                    'password' => bcrypt('penulis-'.$i),
                    'status' => 'Penulis',
                    'nama_lengkap' => 'Penulis '.$i,
                    'no_telepon' => '',
                    'email' => 'Penulis-'.$i.'@example.com',
                    'tanggal_lahir' => date("Y-m-d"),
                    'id_kota' => $kota,
                    'id_provinsi' => $provinsi,
                    'alamat' => '',
                    'kode_pos' => '',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
        }

        $jurusan = DB::table('jurusan')->get();

        foreach (DB::table('users')->get() as $key => $value) {
            if ($value->status != 'Admin') {
                DB::table('penulis')-> INSERT ([
                    'id_penulis' => "PNL".substr(md5($value->id),0,4),
                    'id_akun' => $value->id,
                    'id_jurusan' => $jurusan[rand(0,count($jurusan)-1)]->id_jurusan,
                    'nama_penulis' => $value->nama_lengkap
                ]);
            }
        }
    }
}
