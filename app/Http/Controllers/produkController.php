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
            $jurusanPenulis = null;
            if ($value->id_jurusan) {
                $jurusanPenulis = jurusan::where('id_jurusan','=',$value->id_jurusan)->first()->nama_jurusan;
            }
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
    public function programJurusan() {
        $title = "Program Studi";
        $taskbarValue = (new listController)->taskbarList ();
        $finalSearch = (new listController)->SearchBarList ();

        $tableProdi = json_decode((new listController)->getTable('Prodi'),true);
        
        return view('Jurusan',compact('title','tableProdi','taskbarValue','finalSearch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function prodiUpdate(Request $request, $id) {
        foreach ($request->all() as $key => $value) {
            $jurusan = null;
            if (str_contains($key,"imageup_")) { $jurusan = jurusan::where('id_jurusan','=',substr($key,8))->first(); }
            elseif ($key != "_token" && $key != "_method") {
                $jurusan = jurusan::where('id_jurusan','=',$key)->first();
            }
            
            if ($jurusan) { //update prodi
                jurusan::where('id_jurusan','=',$key)
                    ->update([ 'nama_jurusan' => $value ]);
                if ($request->hasFile('imageup_'.$jurusan->id_jurusan)) {
                    $img_ext =  $request->file('imageup_'.$jurusan->id_jurusan)->getClientOriginalExtension();
                    $img = $jurusan->id_jurusan.".".$img_ext;
                    $request->file('imageup_'.$jurusan->id_jurusan)->storeAs('public/jurusan-image/',$img);

                    jurusan::where('id_jurusan','=',$key)
                        ->update([ 'lambang_jurusan' => $img ]);
                }
            }
        }
        
        return redirect()
            ->route('prodi')
            ->with(['success' => 'Berhasil Update Program Studi']);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function prodiDelete($id) {
        //nullified jurusan penulis dengan jurusan ini
        penulis::where('id_jurusan','=',$id)->update(['id_jurusan' => null ]);

        $nama_jurusan = jurusan::where('id_jurusan','=',$id)->first()->nama_jurusan;
        jurusan::where('id_jurusan','=',$id)->delete();

        return redirect()
            ->route('prodi')
            ->with(['success' => 'Berhasil Hapus Program Studi ['.$nama_jurusan.']']);
    }
}