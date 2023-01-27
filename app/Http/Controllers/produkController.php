<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\listController;
use DB;
use Session;

class produkController extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        $taskbarValue = (new listController)->taskbarList ();
        $tableArray = json_decode((new listController)->getTable('Layak Publish'),true);
        $tableProdi = json_decode((new listController)->getTable('Prodi'),true);

        $judul =  (new listController)->UniqueList($tableArray,'JUDUL');
        $penulis = (new listController)->UniqueList($tableArray,'PENULIS');

        $final = (new listController)->TabletoList($tableArray,$judul,'title-pnl-prodi');

        $arrayAkun = (new listController)->getAkun();
        return view('index',compact('arrayAkun','title','judul','penulis','tableProdi','final','taskbarValue'));
    }
    public function login()
    {
        return view('login');
    }
    public function login_cek(Request $request)
    {
        echo $request->user;
        return redirect()->route('dashboard');
    }
    public function login_store(Request $request)
    {
        return view('login');
    }
    public function profile($id_akun)
    {
        return view('profile',compact('id_akun'));
    }
    public function myarticle($id_akun)
    {
        $title = "My Article";
        $idPenulis = DB::table('penulis')->where('ID_AKUN','=',$id_akun)->value('ID_PENULIS');
        $namaPenulis = DB::table('penulis')->where('ID_AKUN','=',$id_akun)->value('NAMA_PENULIS');

        $taskbarValue = (new listController)->taskbarList ();

        $tableArray = json_decode((new listController)->getTable('MyArticle-'.$idPenulis),true);
        $tableProdi = json_decode((new listController)->getTable('Prodi'),true);

        // print_r($tableArray);

        $judul =  (new listController)->UniqueList($tableArray,'JUDUL');
        $penulis = (new listController)->UniqueList($tableArray,'PENULIS');

        $final = (new listController)->TabletoList($tableArray,$judul,'up-ri-sta');
        
        // echo "<br>============================<br>";
        // print_r($tableArray);
    
        return view('myarticle',compact('title','judul','penulis','tableProdi','final','taskbarValue','namaPenulis'));
    }
    public function article($id_article)
    {
        return view('lihatArticle',compact('id_article'));
    }
}