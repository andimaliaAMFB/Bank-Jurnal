<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class jurusan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $namaProdi = array('Ilmu al-Qur’an dan Tafsir/Tafsir Hadits','Aqidah dan Filsafat Islam','Studi Agama-Agama',
                        'Tasawuf Psikoterapi','Ilmu Hadits','Manajemen Pendidikan Islam','Pendidikan Agama Islam ',
                        'Pendidikan Bahasa Arab','Pendidikan Bahasa Inggris','Pendidikan Matematika','Pendidikan Biologi',
                        'Pendidikan Kimia','Pendidikan Fisika','Pendidikan Guru Madrasah Ibtidaiyah','Pendidikan Islam Anak Usia Dini',
                        'Hukum Keluarga','Hukum Ekonomi Syariah','Hukum Tata Negara','Perbandingan Madzhab','Ilmu Hukum',
                        'Hukum Pidana Islam','Ilmu Komunikasi','Komunikasi Penyiaran Islam','Bimbingan dan Konseling Islam',
                        'Manajemen Dakwah','Pengembangan Masyarakat Islam','Sejarah Peradaban Islam','Bahasa dan Sastra Arab',
                        'Sastra Inggris','Psikologi','Matematika','Biologi','Fisika','Kimia','Teknik Informatika',
                        'Agroteknologi','Teknik Elektro','Administrasi Publik','Sosiologi','Ilmu Politik','Akutansi Syariah',
                        'Ekonomi Syariah','Manajemen','Manajemen Keuangan Syaria');
        
        foreach ($namaProdi as $id => $nama) {
            DB::table('jurusan')-> INSERT ([
                'id_jurusan' => "Jurusan-".($id+1),
                'nama_jurusan' => $nama,
                'lambang_jurusan' => null
            ]);
        }
    }
}
