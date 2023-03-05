<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\artikel;
use App\Models\artikel_detail;
use App\Models\artikel_detail_penulis;
use App\Models\revisi;
use App\Models\penulis;
use App\Models\jurusan;
use App\Models\kota;
use App\Models\provinsi;
use DB;
use Session;

class listController extends Controller
{
    function getTable (string $typeTable) {
        if ($typeTable == 'Layak Publish'){
            $Array = DB::table('artikel_detail')
                    ->join('artikel','artikel_detail.id_artikel','=','artikel.id_artikel')
                    ->join('artikel_detail_penulis','artikel_detail_penulis.id_artikel_detail','=','artikel_detail.id_artikel_detail')
                    ->join('penulis','penulis.id_penulis', '=', 'artikel_detail_penulis.id_penulis')
                    ->join('jurusan','jurusan.id_jurusan', '=', 'penulis.id_jurusan')
                    ->join('revisi','revisi.id_artikel_detail','=','artikel_detail.id_artikel_detail')
                    ->Where(function($query) use ($typeTable) {
                        $query->where('artikel_detail.status_artikel','=',$typeTable)
                                ->orWhere('revisi.status_artikel_baru','=',$typeTable);
                    })
                    ->orderByDesc('artikel.id_artikel')
                    ->orderByDesc('artikel_detail.id_artikel_detail')
                    ->get();
        }
        else if ($typeTable == 'Draft' || 
                $typeTable == 'Revisi Mayor' || 
                $typeTable == 'Revisi Minor'){
            $Array = DB::table('artikel_detail')
                    ->join('artikel','artikel_detail.id_artikel','=','artikel.id_artikel')
                    ->join('artikel_detail_penulis','artikel_detail_penulis.id_artikel_detail','=','artikel_detail.id_artikel_detail')
                    ->join('penulis','penulis.id_penulis', '=', 'artikel_detail_penulis.id_penulis')
                    ->join('jurusan','jurusan.id_jurusan', '=', 'penulis.id_jurusan')
                    ->join('revisi','revisi.id_artikel_detail','=','artikel_detail.id_artikel_detail')
                    ->where('artikel_detail.status_artikel','=',$typeTable)
                    ->orderByDesc('artikel.id_artikel')
                    ->orderByDesc('artikel_detail.id_artikel_detail')
                    ->get();
        }
        else if (str_contains($typeTable,'MyArticle')){
            $Array = DB::table('artikel_detail')
                    ->join('artikel','artikel_detail.id_artikel','=','artikel.id_artikel')
                    ->join('artikel_detail_penulis','artikel_detail_penulis.id_artikel_detail','=','artikel_detail.id_artikel_detail')
                    ->join('penulis','penulis.id_penulis', '=', 'artikel_detail_penulis.id_penulis')
                    ->join('revisi','revisi.id_artikel_detail','=','artikel_detail.id_artikel_detail')
                    ->where('penulis.id_penulis','=',substr($typeTable,10))
                    ->orderByDesc('artikel.id_artikel')
                    ->orderByDesc('artikel_detail.id_artikel_detail')
                    ->get();
        }
        else if (str_contains($typeTable,'Article-')){
            $Array = DB::table('artikel_detail')
                    ->join('artikel','artikel_detail.id_artikel','=','artikel.id_artikel')
                    ->join('artikel_detail_penulis','artikel_detail_penulis.id_artikel_detail','=','artikel_detail.id_artikel_detail')
                    ->join('penulis','penulis.id_penulis', '=', 'artikel_detail_penulis.id_penulis')
                    ->join('jurusan','jurusan.id_jurusan', '=', 'penulis.id_jurusan')
                    ->join('revisi','revisi.id_artikel_detail','=','artikel_detail.id_artikel_detail')
                    ->where('artikel_detail.id_artikel_detail','=',substr($typeTable,8))
                    ->orderByDesc('artikel.id_artikel')
                    ->orderByDesc('artikel_detail.id_artikel_detail')
                    ->get();
        }
        else if (str_contains($typeTable,'Penulis-')){
            $Array = DB::table('artikel_detail')
                    ->join('artikel','artikel_detail.id_artikel','=','artikel.id_artikel')
                    ->join('artikel_detail_penulis','artikel_detail_penulis.id_artikel_detail','=','artikel_detail.id_artikel_detail')
                    ->join('penulis','penulis.id_penulis', '=', 'artikel_detail_penulis.id_penulis')
                    ->join('revisi','revisi.id_artikel_detail','=','artikel_detail.id_artikel_detail')
                    ->where('penulis.id_penulis','=',substr($typeTable,8))
                    ->where('revisi.status_artikel_BARU','=','Layak Publish')
                    ->orderByDesc('artikel.id_artikel')
                    ->orderByDesc('artikel_detail.id_artikel_detail')
                    ->get();
        }
        else if (str_contains($typeTable,'Judul-')){
            $Array = DB::table('artikel_detail')
                    ->join('artikel','artikel_detail.id_artikel','=','artikel.id_artikel')
                    ->join('revisi','revisi.id_artikel_detail','=','artikel_detail.id_artikel_detail')
                    ->where('artikel_detail.JUDUL_ARTIKEL','=',substr($typeTable,6))
                    ->orderByDesc('artikel.id_artikel')
                    ->orderByDesc('artikel_detail.id_artikel_detail')
                    ->get();
        }
        else if (str_contains($typeTable,'Akun-')) {
            $Array = DB::table('users')
                    ->where('id','=',substr($typeTable,5))
                    ->get();
        }
        else if (str_contains($typeTable,'PNL-')) {
            $Array = DB::table('users')
                    ->join('penulis','penulis.id_akun','=','users.id')
                    ->where('penulis.id_akun','=',substr($typeTable,4))
                    ->orWhere('penulis.id_penulis','=',substr($typeTable,4))
                    ->orWhere('penulis.nama_penulis','=',substr($typeTable,4))
                    ->get();
        }
        else if (str_contains($typeTable,'KOTA-')) {
            $Array = DB::table('kota')
                    ->where('ID_KOTA','=',substr($typeTable,5))
                    ->orWhere('nama_kota','=',substr($typeTable,5))
                    ->get();
        }
        else if (str_contains($typeTable,'PROV-')) {
            $Array = DB::table('provinsi')
                    ->where('ID_PROVINSI','=',substr($typeTable,5))
                    ->orWhere('nama_provinsi','=',substr($typeTable,5))
                    ->get();
        }
        else if (str_contains($typeTable,'Prodi-')) {
            $Array = DB::table('jurusan')
                    ->where('id_jurusan','=',substr($typeTable,6))
                    ->orWhere('nama_jurusan','=',substr($typeTable,6))
                    ->get();
        }
        else if ($typeTable == 'All') {
            $Array = DB::table('artikel_detail')
                    ->join('artikel','artikel_detail.id_artikel','=','artikel.id_artikel')
                    ->join('artikel_detail_penulis','artikel_detail_penulis.id_artikel_detail','=','artikel_detail.id_artikel_detail')
                    ->join('penulis','penulis.id_penulis', '=', 'artikel_detail_penulis.id_penulis')
                    ->join('jurusan','jurusan.id_jurusan', '=', 'penulis.id_jurusan')
                    ->join('revisi','revisi.id_artikel_detail','=','artikel_detail.id_artikel_detail')
                    ->orderByDesc('artikel_detail.id_artikel_detail')
                    ->get();
        }
        else if ($typeTable == 'Judul') {
            $TableArray = DB::table('artikel')
                    ->join('artikel_detail', 'artikel_detail.id_artikel_detail', '=', 'artikel.id_artikel' )
                    ->select('artikel.id_artikel', 'artikel_detail.id_artikel_detail','artikel_detail.JUDUL_ARTIKEL')
                    ->get();
            $Array = [];
            foreach ($TableArray as $key => $value) {
                $lastNumber = 1;
                if ($key < (count($TableArray)-1) && $TableArray[$key]->id_artikel == $TableArray[($key + 1)]->id_artikel) {
                    $lastNumber = $lastNumber + 1;
                }
                else {
                    $lastNumber = intval(substr($TableArray[$key]->id_artikel_detail,5));
                    array_push($Array,$TableArray[$key]->JUDUL_ARTIKEL);
                }
            }
        }
        else if ($typeTable == 'Penulis') { $Array = DB::table('penulis')->get(); }
        else if ($typeTable == 'Prodi') { $Array = DB::table('jurusan')->get(); }
        else if ($typeTable == 'Kota') { $Array = DB::table('kota')->get(); }
        else if ($typeTable == 'Prov') { $Array = DB::table('provinsi')->get(); }
        return $Array;
    }
    function TabletoList (array $tableArray,array $Judul, string $format) {
        $Final = array();
        foreach ($Judul as $key => $value) {
            $status = "";
            $tanggalUp = "";
            $tanggalRilis = "";
            $finalizeAdd = false;
            $listFinalize = "";
            $listPenulis = "";
            $listJurusan = "";
            foreach ($tableArray as $index => $data) {
                if ($tableArray[$index]['judul_artikel'] == $Judul[$key]) {
                    if (!str_contains($listPenulis,$tableArray[$index]['nama_penulis'])) {
                        $listPenulis = $listPenulis.$tableArray[$index]['nama_penulis'];
                    }
                    if (!str_contains($listJurusan,$tableArray[$index]['nama_jurusan'])) {
                        $listJurusan = $listJurusan.$tableArray[$index]['nama_jurusan'];
                    }
                    if ($index < count($tableArray)-1 && $tableArray[($index + 1)]['judul_artikel'] == $Judul[$key])  {
                        if (!str_contains($listPenulis,$tableArray[($index + 1)]['nama_penulis'])) {
                            $listPenulis = $listPenulis.", ";
                        }
                        if (!str_contains($listJurusan,$tableArray[($index + 1)]['nama_jurusan'])) {
                            $listJurusan = $listJurusan.", ";
                        }
                    }
                    if (!$finalizeAdd) {
                        if ($tableArray[$index]['status_revisi'] == '1') {
                            $listFinalize = 'Yes';
                        }
                        else if ($tableArray[$index]['status_revisi'] == '0') {$listFinalize = 'No';}
                        if ($format == 'up-ri-sta') {
                            if ($tableArray[$index]['TANGGAL_UPLOAD']) { $tanggalUp = $tableArray[$index]['TANGGAL_UPLOAD']; }
                            if ($tableArray[$index]['status_artikel_baru'] != '-') {
                                $tanggalRilis = '-';
                                if ($tableArray[$index]['status_artikel_baru'] == 'Layak Publish') {
                                    $tanggalRilis = $tableArray[$index]['TANGGAL_UPLOAD'];
                                }
                                $status = $tableArray[$index]['status_artikel_baru'];
                            }
                            else {  $status = $tableArray[$index]['status_artikel']; $tanggalRilis = '-'; }
                        }
                        $finalizeAdd = true;
                    }
                    if ($index < count($tableArray)-1 && $tableArray[($index + 1)]['judul_artikel'] != $Judul[$key])  {
                        if (!$finalizeAdd) {
                            if ($listFinalize.$tableArray[$index]['status_revisi'] == '1') {
                                $listFinalize = 'Yes';
                            }
                            else {$listFinalize = 'No';}
                            if ($format == 'up-ri-sta') {
                                if ($tableArray[$index]['TANGGAL_UPLOAD']) { $tanggalUp = $tableArray[$index]['TANGGAL_UPLOAD']; }
                                if ($tableArray[$index]['status_artikel_baru'] != '-') {
                                    $tanggalRilis = '-';
                                    if ($tableArray[$index]['status_artikel_baru'] == 'Layak Publish') {
                                        $tanggalRilis = $tableArray[$index]['TANGGAL_UPLOAD'];
                                    }
                                    $status = $tableArray[$index]['status_artikel_baru'];
                                }
                                else {  $status = $tableArray[$index]['status_artikel']; $tanggalRilis = '-'; }
                            }
                            $FinalizeAdd = true;
                        }
                    }
                }
            }
            if ($format == 'up-ri-sta') {
                $Final[]= [0 => $Judul[$key], 1 => $listFinalize, 
                            2 => $listPenulis, 3 => $listJurusan,
                            4 =>$tanggalUp, 5=> $tanggalRilis, 6=> $status];
            }
            else {
                $Final[]= [0 => $Judul[$key], 1 => $listFinalize, 
                            2 => $listPenulis, 3 => $listJurusan];
            }
        }
        // print_r($Final);
        return $Final;
    }
    function UniqueList (array $tableArray, string $ColumnTable) {
        $Array = array();
        foreach ($tableArray as $index => $data) {
            if (str_contains($ColumnTable,'JUDUL')) { $Array[] = $data['judul_artikel']; }
            else if (str_contains($ColumnTable,'STATUS')) { $Array[] = $data['status_revisi']; }
            else if (str_contains($ColumnTable,'PENULIS')) { $Array[] = $data['nama_penulis']; }
            else if (str_contains($ColumnTable,'JURUSAN')) { $Array[] = $data['nama_jurusan']; }
        }
        if (count($Array) != 0) {
            $Array = array_unique($Array);
            $Array = array_combine(range(0,count($Array)-1),array_values($Array));
        }
        return $Array;
    }
    function CountRevisied (array $TableArray, string $type) {
        $count = 0;
        $jdl = '';
        foreach ($TableArray as $key => $value) {
            if ($value[0] != $jdl) {
                $jdl = $value[0];
                if ($type == 'Admin' && $value[1] == "No") { $count = $count + 1; }
                else if ($type == 'Penulis' && $value[1] == "Yes" && $value[6] != 'Layak Publish') {
                    $count = $count + 1;
                }
            }
        }
        return $count;
    }
    function SliceTable (array $TableArray, array $AlltableArray, string $typeTable) {
        $array_at_key = array();
        foreach ($TableArray as $key => $value) {
            $currentID = intval(substr($TableArray[$key]['id_artikel_detail'],5));
            // echo $key."<br>";
            // print_r($TableArray[$key]);
            // echo "<br>";
            foreach ($AlltableArray as $keyAll => $valueAll) {
                if ($AlltableArray[$keyAll]['id_artikel'] == $TableArray[$key]['id_artikel']) {
                    $currentIDAll = intval(substr($AlltableArray[$keyAll]['id_artikel_detail'],5));
                    if ($currentID < $currentIDAll) {
                        $array_at_key[] = $key;
                    }
                }
            }
        }

        // echo "<br>===================================================<br>";
        // print_r($array_at_key);
        // echo "<br>";

        // echo "<br>===================================================<br>";
        $array_at_key = array_values(array_unique($array_at_key));
        // print_r($array_at_key);
        // echo "<br>";

        foreach ($array_at_key as $key => $value) {
            // echo $key.": ".$value."<br>";
            unset($TableArray[$value]);
        }

        // echo "<br>===================================================<br>";
        $TableArray = array_values($TableArray);
        $id_artikel = '';
        $count = 0;
        foreach ($TableArray as $key => $value) {
            if ($TableArray[$key]['judul_artikel'] != $id_artikel) {
                $id_artikel = $TableArray[$key]['judul_artikel'];
                // echo $key."<br>";
                // print_r($TableArray[$key]);
                // echo "<br>";
                $count += 1;
            }
        }
        // echo $count;
        return $TableArray;
    }
    function finalArray ($tableArray) {
        $final = [];
        $id_article_TA = '';
        foreach ($tableArray as $key => $value) {
            if($id_article_TA != $value['id_artikel']) {
                $id_article_TA = $value['id_artikel'];
                
                $datamodel = (artikel_detail::where('id_artikel', '=', $id_article_TA)
                            ->orderByDesc('id_artikel_detail')
                            ->first());
                
                if ($datamodel['id_artikel_detail'] == $value['id_artikel_detail']) {
                    $listPenulis = artikel_detail_penulis::where('id_artikel_detail','=',$value['id_artikel_detail'])
                                    ->get();
                    $list_of_penulis = [];
                    $list_of_prodi = [];
                    foreach($listPenulis as $index => $datapenulis) {
                        $detail_penulis = penulis::where('id_penulis','=',$datapenulis->id_penulis)->first();
                        if (!in_array($detail_penulis->nama_penulis,$list_of_penulis)) {
                            $list_of_penulis[] = $detail_penulis->nama_penulis;
                            $namajurusan = '[ N/a ]';
                            if (jurusan::where('id_jurusan','=',$detail_penulis->id_jurusan)->exists()) {
                                $namajurusan = jurusan::where('id_jurusan','=',$detail_penulis->id_jurusan)->value('nama_jurusan');
                            }
                            if(!in_array($namajurusan,$list_of_prodi)) { $list_of_prodi[] = $namajurusan; }
                        }
                    }
                    $list_of_penulis = implode(', ',$list_of_penulis);
                    $list_of_prodi = implode(', ',$list_of_prodi);
                    
                    $revisi = revisi::where('id_artikel_detail','=',$value['id_artikel_detail'])->first();
                    //insert revisi
                        $tanggalUp = '-';
                        if($revisi->status_artikel_baru == 'Layak Publish') { 
                            $tanggalUp = (string)$revisi->updated_at;
                        }
                        $finalize = 'No';
                        if($revisi->status_revisi == '1') { $finalize = 'Yes'; }
                        else { $finalize = 'No'; }
                        
                        $status = $revisi->status_artikel_baru;
                        if($revisi->status_artikel_baru == '-') { $status = $datamodel['status_artikel']; }
                    //

                    $final[] = [$datamodel['judul_artikel'],
                                $finalize,
                                $list_of_penulis,
                                $list_of_prodi,
                                $value['updated_at'],
                                $tanggalUp,
                                $status];
                }
            }
        }
        return $final;
    }
    function historyArray ($tableArray) {
        $history = [];
        
        $id_article_TA = '';
        foreach ($tableArray as $key => $value) {
            if($id_article_TA != $value['id_artikel']) {
                $id_article_TA = $value['id_artikel'];

                $datamodel = (artikel_detail::where('id_artikel', '=', $id_article_TA)
                            ->orderByDesc('id_artikel_detail')
                            ->first());
                
                // compare is this id_artikel_detail is the last one from $id_artikel
                if ($datamodel['id_artikel_detail'] == $value['id_artikel_detail']) {
                    $detailArtikel = (artikel_detail::where('id_artikel', '=', $id_article_TA)
                                        ->orderBy('id_artikel_detail')
                                        ->get());
                    $listTGL = [];
                    $CountHistory = 0;
                    $listPenulis = [];
                    $listStatus = [];
                    $listStatusBaru = [];
                    $listCatatanBaru = [];
                    $listJudul = [];
                    foreach($detailArtikel as $index => $AD){
                        $List_PNL = artikel_detail_penulis::where('id_artikel_detail','=',$AD->id_artikel_detail)->get();
                        $listPenulis_AD = [];
                        foreach($List_PNL as $noList => $valueList)
                        {
                            $NamaPenulis = penulis::where('id_penulis','=',$valueList['id_penulis'])->value('nama_penulis');
                            if (!in_array($NamaPenulis,$listPenulis_AD)) { $listPenulis_AD [] = $NamaPenulis; }
                        }
                        $CountHistory += 1;
                        $listPenulis [] = implode(', ',$listPenulis_AD);
                        
                        $RD = (revisi::where('id_artikel_detail', '=', $AD['id_artikel_detail'])
                                        ->first());
                        
                        $listTGL [] = date_format(date_create($value['updated_at']), "Y/m/d") ;
                        $listStatus [] = $AD['status_artikel'];
                        $listStatusBaru [] = $RD['status_artikel_baru'];
                        $listCatatanBaru [] = $RD['catatan_revisi'];
                        $listJudul [] = $AD['judul_artikel'];
                    }
                    $history[] = [$datamodel['judul_artikel'],
                                    $CountHistory,
                                    end($listPenulis),
                                    $listTGL,
                                    $listStatus,
                                    $listStatusBaru,
                                    $listCatatanBaru,
                                    $listJudul
                                ];
                }
            }
        }
        return $history;
    }


    function taskbarList () {
        $draft = json_decode($this->getTable('Draft'),true);
        $rmayor = json_decode($this->getTable('Revisi Mayor'),true);
        $rminor = json_decode($this->getTable('Revisi Minor'),true);
        
        $list_draft = $this->CountRevisied(($this->finalArray($draft)),'Admin');
        $list_rmayor = $this->CountRevisied(($this->finalArray($rmayor)),'Admin');
        $list_rminor = $this->CountRevisied(($this->finalArray($rminor)),'Admin');

        $listJumlah = ['Draft' => $list_draft,
        'Revisi Mayor' => $list_rmayor,
        'Revisi Minor' => $list_rminor,];

        $arrayAkun = Auth::user();
        $myArticle;
        if ($arrayAkun && Auth::user()->status == "Penulis") {
            $idPenulis = json_decode($this->getTable ('PNL-'.Auth::user()->nama_lengkap),true)[0]['id_penulis'];
            $myArticle = json_decode($this->getTable('MyArticle-'.$idPenulis),true);
            $list_myArticle = null;
            if($myArticle) { $list_myArticle = $this->CountRevisied(($this->finalArray($myArticle)),'Penulis'); }
            
            $listJumlah = ['Draft' => $list_draft,
                            'Revisi Mayor' => $list_rmayor,
                            'Revisi Minor' => $list_rminor,
                            'My Article' => $list_myArticle];
        }
        return $listJumlah;
    }
    function getAkun () {
        $arrayID = [];
        if (Auth::check()) {
            $kota = kota::where('id_kota','=',Auth::user()->id_kota)->first();
            $provinsi = provinsi::where('id_provinsi','=',Auth::user()->id_provinsi)->first();
            if (Auth::user()->status == "Penulis") {
                $penulis = penulis::where('id_akun','=',Auth::user()->id)->first();
                $nama_prodi = null;
                if (jurusan::where('id_jurusan','=',$penulis->id_jurusan)->exists()) {
                    $nama_prodi = jurusan::where('id_jurusan','=',$penulis->id_jurusan)->first()->nama_jurusan;
                }
                $prodi = jurusan::where('id_jurusan','=',$penulis->id_jurusan)->first();
                $arrayID[] = ['id' => Auth::user()->id,
                                'status' => Auth::user()->status,
                                'username' => Auth::user()->username,
                                'id_penulis' => $penulis->id_penulis,
                                'nama_lengkap' => $penulis->nama_penulis,
                                'nama_jurusan' => $nama_prodi,
                                'no_telepon' => Auth::user()->no_telepon,
                                'email' => Auth::user()->email,
                                'tanggal_lahir' => Auth::user()->tanggal_lahir,
                                'nama_kota' => $kota->nama_kota,
                                'nama_provinsi' => $provinsi->nama_provinsi,
                                'alamat' => Auth::user()->alamat,
                                'kode_pos' => Auth::user()->kode_pos,
                                'foto_profil' => Auth::user()->foto_profil];
            }
            else {
                $arrayID[] = ['id' => Auth::user()->id,
                                'status' => Auth::user()->status,
                                'username' => Auth::user()->username,
                                'nama_lengkap' => Auth::user()->nama_lengkap,
                                'no_telepon' => Auth::user()->no_telepon,
                                'email' => Auth::user()->email,
                                'tanggal_lahir' => Auth::user()->tanggal_lahir,
                                'nama_kota' => $kota->nama_kota,
                                'nama_provinsi' => $provinsi->nama_provinsi,
                                'alamat' => Auth::user()->alamat,
                                'kode_pos' => Auth::user()->kode_pos,
                                'foto_profil' => Auth::user()->foto_profil];
            }
        }
        return $arrayID;
    }
    function SearchBarList () {
        $table = json_decode($this->getTable('Layak Publish'),true);
        $finalSearch = $this->finalArray ($table);

        // dd($table,$finalSearch);
        return $finalSearch;
    }
}
