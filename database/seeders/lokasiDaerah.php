<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class lokasiDaerah extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $namaProvinsi = array('Aceh','Bali','Bangka Belitung','Banten','Bengkulu','Daerah Istimewa Yogyakarta','Gorontalo',
                    'Jakarta','Jambi','Jawa Barat','Jawa Tengah','Jawa Timur','Kalimantan Barat','Kalimantan Selatan','Kalimantan Tengah','Kalimantan Timur','Kalimantan Utara',
                    'Kepulauan Riau','Lampung','Maluku Utara','Maluku','Nusa Tenggara Barat','Nusa Tenggara Timur','Papua Barat Daya','Papua','Riau',
                    'Sulawesi Selatan','Sulawesi Tengah','Sulawesi Tenggara','Sulawesi Utara','Sumatra Barat','Sumatra Selatan','Sumatra Utara');
        
        foreach ($namaProvinsi as $id => $nama) {
            DB::table('provinsi')-> INSERT([
                'id_provinsi' => "P-".($id+1),
                'nama_provinsi' => $nama
            ]);
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
        
        
        foreach ($namaKota as $id => $nama) {
            DB::table('kota')-> INSERT([
                'id_kota' => "K-".($id+1),
                'nama_kota' => $nama
            ]);
        }

    }
}
