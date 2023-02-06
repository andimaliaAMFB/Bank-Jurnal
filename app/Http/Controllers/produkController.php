<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\listController;
use App\Models\artikel;
use App\Models\artikel_detail;
use App\Models\artikel_detail_penulis;
use App\Models\revisi;
use App\Models\revisi_detail;
use App\Models\penulis;
use App\Models\jurusan;
use DB;
use Session;

class produkController extends Controller
{
    public function index() {
        $title = "Dashboard";
        $taskbarValue = (new listController)->taskbarList ();
        $tableArray = json_decode((new listController)->getTable('Layak Publish'),true);
        $tableProdi = json_decode((new listController)->getTable('Prodi'),true);
        $tablePenulis = json_decode((new listController)->getTable('Penulis'),true);

        $judul =  (new listController)->UniqueList($tableArray,'JUDUL');
        $penulis = (new listController)->UniqueList($tableArray,'PENULIS');

        $final = (new listController)->TabletoList($tableArray,$judul,'title-pnl-prodi');

        $arrayAkun = (new listController)->getAkun();
        // print_r($final);
        return view('index',compact('arrayAkun','title','judul','penulis','tablePenulis','tableProdi','final','taskbarValue'));
    }
    public function profile($id_akun)
    {
        return view('profile',compact('id_akun'));
    }
    public function myarticle() {
        $title = "My Article";

        $taskbarValue = (new listController)->taskbarList ();
        $arrayAkun = (new listController)->getAkun();
        // print_r($arrayAkun);

        $AlltableArray = json_decode((new listController)->getTable('All'),true);
        $tableArray = json_decode((new listController)->getTable('MyArticle-'.$arrayAkun[0]['ID_PENULIS']),true);
        $tableProdi = json_decode((new listController)->getTable('Prodi'),true);

        // print_r($tableArray);

        $judul =  (new listController)->UniqueList($tableArray,'JUDUL');
        $penulis = json_decode((new listController)->getTable('Penulis'),true);
        
        $final = [];
        
        $id_article_TA = '';
        foreach ($tableArray as $key => $value) {
            if($id_article_TA != $value['ID_ARTIKEL'])
            {
                $id_article_TA = $value['ID_ARTIKEL'];

                $id_articleDetail_TA = $value['ID_DETAILARTIKEL'];
                $datamodel = (artikel_detail::where('ID_ARTIKEL', '=', $id_article_TA)
                            ->orderByDesc('ID_DETAILARTIKEL')
                            ->first());
                
                if ($datamodel['ID_DETAILARTIKEL'] == $value['ID_DETAILARTIKEL']) {
                    $listPenulis = artikel_detail_penulis::where('ID_DETAILARTIKEL','=',$value['ID_DETAILARTIKEL'])
                                    ->get();
                    $list_of_penulis = [];
                    $list_of_prodi = [];
                    foreach($listPenulis as $index => $datapenulis) {
                        $detail_penulis = penulis::where('ID_PENULIS','=',$datapenulis['ID_PENULIS'])->get();
                        if (!in_array($detail_penulis[0]['NAMA_PENULIS'],$list_of_penulis)) {
                            $list_of_penulis[] = $detail_penulis[0]['NAMA_PENULIS'];
                            $list_of_prodi[] = jurusan::where('ID_JURUSAN','=',$detail_penulis[0]['ID_JURUSAN'])->value('NAMA_JURUSAN');
                        }
                    }
                    $stringList_of_penulis = '';
                    $stringList_of_prodi = '';
                    foreach($list_of_penulis as $index => $datapenulis){
                        $stringList_of_penulis = $stringList_of_penulis.$datapenulis;
                        $stringList_of_prodi = $stringList_of_prodi.$list_of_prodi[$index];
                        if ($index < count($list_of_penulis)-1){
                            $stringList_of_penulis = $stringList_of_penulis.', ';
                            $stringList_of_prodi = $stringList_of_prodi.', ';
                        }
                    }
                    
                    $revisi = revisi::where('ID_DETAILARTIKEL','=',$value['ID_DETAILARTIKEL'])->value('ID_REVISI');
                    $detail_revisi = revisi_detail::where('ID_REVISI','=',$revisi)->get();
                    $tanggalUp = '-';
                    $finalize = 'No';
                    $status = $detail_revisi[0]['STATUS_ARTIKEL_BARU'];
                    if($detail_revisi[0]['STATUS_ARTIKEL_BARU'] == 'Layak Publish') { $tanggalUp = $detail_revisi[0]['TANGGAL_REVISI']; }
                    if($detail_revisi[0]['STATUS_ARTIKEL_BARU'] == '-') { $status = $datamodel['STATUS_ARTIKEL']; }
                    if($detail_revisi[0]['STATUS_REVISI'] == '1') { $finalize = 'Yes'; }
                    else { $finalize = 'No'; }

                    $final[] = [$datamodel['JUDUL_ARTIKEL'],$finalize,$stringList_of_penulis, $stringList_of_prodi,$datamodel['TANGGAL_UPLOAD'],$tanggalUp,$status];
                }
            }
        }
        // echo "<br>============================<br>";
        // dd($final, $penulis);

        $namaPenulis = $arrayAkun[0]['NAMA'];

        return view('myarticle',compact('arrayAkun','namaPenulis','title','judul','penulis','tableProdi','final','taskbarValue','tableArray','AlltableArray'));
    }
    public function article($id_article)
    {
        return view('lihatArticle',compact('id_article'));
    }
}