<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\akun;
use App\Models\penulis;
use DB;
use Session;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login() {
        $form = 'login';
        return view('login',compact('form'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function signup() {
        $form = 'signup';
        return view('login',compact('form'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginInput(Request $request) {
        $rule = [
            'username' => 'required',
            'pass' => 'required'
        ];

        $pesan = [
            'username.required' => 'Username Wajib Diisi !',
            'pass.required' => 'Password Wajib Diisi !'
        ];

        $this->validate($request,$rule,$pesan);

        $id_akun = DB::table('akun')->select('ID_AKUN','STATUS_PENGGUNA')->where('USERNAME','=',$request->username)->get();
        // print_r($id_akun);
        // echo $request->username." || ".$id_akun[0]->ID_AKUN."<br>";
        // echo "STATUS_PENGGUNA || ".$id_akun[0]->STATUS_PENGGUNA."<br>";

        $data = $request->session()->put('id_akun',$id_akun[0]->ID_AKUN);
        $data = $request->session()->put('status_akun',$id_akun[0]->STATUS_PENGGUNA);
        
        // echo $request->session()->get('id_akun');
        // echo $request->session()->get('status_akun');

        return redirect()->route('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signupInput(Request $request) {
        $rule = [
            'username' => 'required',
            'pass' => 'required|required_with:passS|same:passS|min:6',
            'email' => 'required',
            'passS' => 'same:pass|min:6',
        ];

        $pesan = [
            'username.required' => 'Username Wajib Diisi !',
            'pass.required' => 'Password Wajib Diisi !',
            'email.required' => 'Email Wajib Diisi !',
            'pass.min' => 'Password Telalu Pendek',
            'passS.min' => 'Password Kedua Telalu Pendek',
            'required_with' => 'Masuki Ulang Password Kedua',
            'same' => 'Kedua Password Tidak Sama dengan Password Pertama'
        ];

        $validated = $this->validate($request,$rule,$pesan);

        $kota = DB::table('kota')->select('ID_KOTA')->limit(1)->value('ID_KOTA');
        $provinsi = DB::table('provinsi')->select('ID_PROVINSI')->limit(1)->value('ID_PROVINSI');
        
        $id_akun = strval(date("m").(date("d")+date("B")));

        DB::table('akun')-> INSERT ([
            'ID_AKUN' => $id_akun,
            'USERNAME' => $request->username,
            'PASSWORD' => substr(md5($request->pass),0,12),
            'NAMA' => '',
            'STATUS_PENGGUNA' => 'Penulis',
            'NO_TELEPON' => "",
            'EMAIL' => $request->email,
            'TANGGAL_LAHIR' => date("Y-m-d"),
            'ID_KOTA' => $kota,
            'ID_PROVINSI' => $provinsi,
            'ALAMAT' => '',
            'KODE_POS' => ''
        ]);

        $jurusan = DB::table('jurusan')->select('ID_JURUSAN')->limit(1)->value('ID_JURUSAN');
        
        DB::table('penulis')-> INSERT ([
            'ID_PENULIS' => "PNL".substr(md5($id_akun),0,4), 
            'ID_AKUN' => $id_akun,
            'ID_JURUSAN' => $jurusan,
            'NAMA_PENULIS' => ''
        ]);
            
        
        return redirect()
            ->route('loginShow')
            ->with(['success' => 'Berhasil Signup Akun']);
    }

    public function logout() {
            // For Forget
        Session::forget('id_akun');
        Session::forget('status_akun');
            // For Forget
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProfile() {
        $taskbarValue = (new listController)->taskbarList ();

        $tableKota = json_decode((new listController)->getTable('Kota'),true);
        $tableProv = json_decode((new listController)->getTable('Prov'),true);
        $tableProdi = json_decode((new listController)->getTable('Prodi'),true);
        
        $arrayAkun = (new listController)->getAkun();

        // print_r($arrayAkun);
        return view('profile',compact('arrayAkun','tableProdi','tableKota','tableProv','taskbarValue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfie(Request $request, $id) {
        $tableAkun = json_decode((new listController)->getTable('Akun-'.$id),true);
        $kota = json_decode((new listController)->getTable('KOTA-'.$request->kota),true)[0]['ID_KOTA'];
        $provinsi = json_decode((new listController)->getTable('PROV-'.$request->prov),true)[0]['ID_PROVINSI'];

        $img_name = $request->username;
        $img_ext =  $request->file('imageup')->getClientOriginalExtension();
        $img = $img_name.".".$img_ext;
        $request->file('imageup')->storeAs('public/profile-image',$img);
        // echo $request->file('imageup')->storeAs('public/profile-image',$img)."<br>";
        
        // echo $img."<br>";
        // print_r($request->all());
        akun::where('ID_AKUN',$id)->update([
            'USERNAME' => $request->username,
            'NAMA' => $request->name,
            'NO_TELEPON' => $request->tlp,
            'EMAIL' => $request->email,
            'TANGGAL_LAHIR' => $request->tgl,
            'ID_KOTA' => $kota,
            'ID_PROVINSI' => $provinsi,
            'ALAMAT' => $request->alamat,
            'KODE_POS' => $request->pos,
            'FOTO_PROFIL' => $img
        ]);

        if ($tableAkun[0]['STATUS_PENGGUNA'] == 'Penulis') {
            $tablePenulis = json_decode((new listController)->getTable('PNL-'.$id),true);
            $jurusan = json_decode((new listController)->getTable('Prodi-'.$request->prodi),true)[0]['ID_JURUSAN'];
            $existID = penulis::where('NAMA_PENULIS','=',$request->name,'and')
            ->where('ID_PENULIS','!=',$tablePenulis[0]['ID_PENULIS'])
            ->whereNull('ID_AKUN')
            ->exists();

            // echo $existID;

            if ($existID) {
                # code...
                $currentPNL_ID = $tablePenulis[0]['ID_PENULIS'];

                penulis::where('ID_PENULIS','=',$tablePenulis[0]['ID_PENULIS'])->delete();
                penulis::where('NAMA_PENULIS','=',$request->name,'and')
                ->where('ID_PENULIS','!=',$tablePenulis[0]['ID_PENULIS'],'and')
                ->whereNull('ID_AKUN')
                ->update ([
                    'ID_PENULIS' => $tablePenulis[0]['ID_PENULIS'],
                    'ID_AKUN' => $id,
                    'NAMA_PENULIS' => $request->name,
                    'ID_JURUSAN' => $jurusan
                ]);
            }
            else {
                penulis::where('ID_AKUN',$id) -> update ([
                    'ID_JURUSAN' => $jurusan,
                    'NAMA_PENULIS' => $request->name
                ]);
            }
        }
        return redirect()
            ->route('profile')
            ->with(['success' => 'Berhasil Update Profile']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
