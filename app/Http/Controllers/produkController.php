<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\listController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RevisionNotif;

use DB;
use Session;
use App\Models\User;
use App\Models\penulis;
use App\Models\jurusan;

class produkController extends Controller
{
    public function index() {
        $title = "Dashboard";
        $taskbarValue = (new listController)->taskbarList ();
        $finalSearch = (new listController)->SearchBarList ();

        $tableArray = json_decode((new listController)->getTable('Layak Publish'),true);
        $tableProdi = json_decode((new listController)->getTable('Prodi'),true);
        $tablePenulis = [];
        foreach(penulis::orderBy('nama_penulis')->get() as $key => $value){
            $jurusanPenulis = jurusan::where('id_jurusan','=',$value->id_jurusan)->first()->nama_jurusan;
            if($value->id_akun) {
                $user = User::where('id','=',$value->id_akun)->first();
                $tablePenulis[] = [ 'nama_penulis' => $value->nama_penulis,
                                    'id_akun' => $value->id_akun,
                                    'foto_profil' => $user->foto_profil,
                                    'nama_jurusan' => $jurusanPenulis 
                                ];
            }
            else {
                $tablePenulis[] = [ 'nama_penulis' => $value->nama_penulis,
                                    'id_akun' => null,
                                    'foto_profil' => null,
                                    'nama_jurusan' => $jurusanPenulis
                                ];
            }
        }

        $final = (new listController)->finalArray($tableArray);
        $judul =  array_column($final, 0);
        $penulis = [];
        foreach(array_column($final, 2) as $list_penulis) {
            $array_penulis = explode(", ",$list_penulis);
            foreach($array_penulis as $nama_penulis) {
                if(!in_array($nama_penulis,$penulis)) { $penulis[] = $nama_penulis; }
            }
        }

        return view('index',compact('title','judul','penulis','tablePenulis','tableProdi','final','taskbarValue','finalSearch'));
    }
}