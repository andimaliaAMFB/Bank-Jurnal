<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DummyData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    function Lokasi()
    {
        $namaProvinsi = array("Aceh","Bali","Bangka Belitung","Banten","Bengkulu","Daerah Istimewa Yogyakarta","Gorontalo",
                    "Jakarta","Jambi","Jawa Barat","Jawa Tengah","Jawa Timur","Kalimantan Barat","Kalimantan Selatan","Kalimantan Tengah","Kalimantan Timur","Kalimantan Utara",
                    "Kepulauan Riau","Lampung","Maluku Utara","Maluku","Nusa Tenggara Barat","Nusa Tenggara Timur","Papua Barat Daya","Papua","Riau",
                    "Sulawesi Selatan","Sulawesi Tengah","Sulawesi Tenggara","Sulawesi Utara","Sumatra Barat","Sumatra Selatan","Sumatra Utara");
        $provinsi;
        for ($i=0; $i < count($namaProvinsi); $i++) { 
            $provinsi["P-".($i+1)] = $namaProvinsi[$i];
        }
        foreach ($provinsi as $id => $nama) {
            DB::table('provinsi')-> INSERT (['ID_PROVINSI' => $id, 'NAMA_PROVINSI' => $nama]);
        }
        $namaKota = array('Banda Aceh','Langsa','Lhokseumawe','Sabang','Subulussalam','Denpasar','Pangkalpinang','Cilegon','Serang','Tangerang Selatan',
                    'Tangerang','Bengkulu','Yogyakarta','Gorontalo','Kota Administrasi Jakarta Barat','Kota Administrasi Jakarta Pusat','Kota Administrasi Jakarta Selatan',
                    'Kota Administrasi Jakarta Timur','Kota Administrasi Jakarta Utara','Sungai Penuh','Jambi','Bandung','Bekasi','Bogor','Cimahi','Cirebon','Depok',
                    'Sukabumi','Tasikmalaya','Banjar','Magelang','Pekalongan','Salatiga','Semarang','Surakarta','Tegal','Batu','Blitar','Kediri','Madiun','Malang',
                    'Mojokerto','Pasuruan','Probolinggo','Surabaya','Pontianak','Singkawang','Banjarbaru','Banjarmasin','Palangka Raya','Balikpapan','Bontang','Samarinda',
                    'Nusantara','Tarakan','Batam','Tanjungpinang','Bandar Lampung','Metro','Ternate','Tidore Kepulauan','Ambon','Tual','Bima','Mataram','Kupang',
                    'Sorong','Jayapura','Dumai','Pekanbaru','Makassar','Palopo','Parepare','Palu','Baubau','Kendari','Bitung','Kotamobagu','Manado','Tomohon',
                    'Bukittinggi','Padang','Padang Panjang','Pariaman','Payakumbuh','Sawahlunto','Solok','Lubuklinggau','Pagar Alam','Palembang','Prabumulih',
                    'Binjai','Gunungsitoli','Medan','Padangsidimpuan','Pematangsiantar','Sibolga','Tanjungbalai','Tebing Tinggi');
        
        
        $kota;
        for ($i=0; $i < count($namaKota); $i++) { 
            $kota["K-".($i+1)] = $namaKota[$i];
        }
        foreach ($kota as $id => $nama) {
            DB::table('kota')-> INSERT (array(['ID_KOTA' => $id, 'NAMA_KOTA' => $nama]));
        }
    }

    function Jurusan()
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
        $prodi;
        for ($i=0; $i < count($namaProdi); $i++) { 
            $prodi["Jurusan-".($i+1)] = $namaProdi[$i];
        }
        foreach ($prodi as $id => $nama) {
            DB::table('jurusan')-> INSERT (['ID_JURUSAN' => $id, 'NAMA_JURUSAN' => $nama]);
        }
    }

    function Akun()
    {
        
    }
    
    function Penulis()
    {

    }

    function Artikel()
    {

    }
    
    function ArtikelDetail()
    {
        
    }
    
    function ArtikelPenulis()
    {
        
    }

    function Revisi()
    {
        
    }
    
    function RevisiDetail()
    {
        
    }

    public function run()
    {
        Lokasi();
        Jurusan();
        Akun();
        Penulis();
        Artikel();
        ArtikelDetail();
        ArtikelPenulis();
        Revisi();
        RevisiDetail();
    }
}
