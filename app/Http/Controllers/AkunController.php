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
            'required' => 'Data ini Wajib Diisi !'
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
            'required' => 'Data ini Wajib Diisi !',
            'min' => 'Password Telalu Pendek',
            'required_with' => 'Masuki Ulang Password Kedua',
            'same' => 'Kedua Password Tidak Sama'
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
            
        
        return redirect()->route('loginShow');
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
    public function show($id) {
        //
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
    public function update(Request $request, $id) {
        //
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
