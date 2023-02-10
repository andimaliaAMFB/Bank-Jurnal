<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
        //validation data
            $rule = [
                'username' => 'required',
                'pass' => 'required'
            ];

            $pesan = [
                'username.required' => 'Username Wajib Diisi !',
                'pass.required' => 'Password Wajib Diisi !'
            ];

        
        $validator = Validator::make($request->all(), $rule, $pesan);
        $validator->validated();

        //if ada form input yang tidak diisi
        if ($validator->fails()) {
            return redirect()
                ->route('loginShow')
                ->withErrors($validator)
                ->withInput();
        }

        //check if username and password exist
            $errorString = null;
            // if(User::where('username','=',$request->username)->exists())
            // {
            //     $dataAkun = User::where('username','=',$request->username)->first();
            //     $username = $dataAkun['username'];
            //     $password = $dataAkun['password'];
            //     dd($password,bcrypt($request->pass),$request->pass, bcrypt('penulis-1'),bcrypt($request->pass));
            //     if(bcrypt($request->pass) != $password) {
            //         $errorString = 'Password Yang Dimasukan Salah';
            //     }
            // }
            // else { $errorString = 'Username Tidak Dikenali'; }
            // if($errorString) {
            //     return redirect()
            //         ->route('loginShow')
            //         ->withErrors($validator)
            //         ->withInput()
            //         ->with('error',$errorString);
            // }
        //
        
        $input = $request->all();
        $credentials = ['username' => $input['username'],
                        'password' => $input['pass']];
            
        // dd($credentials,Auth::attempt($credentials));
        if (Auth::attempt($credentials)) {

            // $id_akun = User::select('id_akun','status')->where('username','=',$username)->first();
            // // dd($id_akun);
    
            // $data = $request->session()->put('id_akun',$id_akun['id_akun']);
            // $data = $request->session()->put('status_akun',$id_akun['status']);
            
            // echo $request->session()->get('id_akun');
            // echo $request->session()->get('status_akun');
            return redirect()->route('dashboard');
    
        }
        else {
            return redirect()
                    ->route('loginShow')
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error','Kesalahan Dalam Username Atau Password');
        }
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
        
        $validator = Validator::make($request->all(), $rule, $pesan);
        $validator->validated();

        //if ada form input yang tidak diisi
        if ($validator->fails()) {
            return redirect()
                ->route('signupShow')
                ->withErrors($validator)
                ->withInput();
        }

        //check if username and password exist
            $errorString = null;
            if(User::where('username','=',$request->username)->exists()) {
                $errorString = 'Username Sudah Digunakan Oleh Pengguna Lain';
            }
            else if(User::where('email','=',$request->email)->exists()) {
                $errorString = 'Email Sudah Digunakan Oleh Pengguna Lain';
            }
            if($errorString) {
                return redirect()
                    ->route('signupShow')
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error',$errorString);
            }
        //
        
        $id_akun = strval(date("m").(date("d")+date("B")));

        DB::table('users')-> INSERT ([
            'id_akun' => $id_akun,
            'username' => $request->username,
            'password' => bcrypt($request->pass),
            'nama_lengkap' => '',
            'status' => 'Penulis',
            'no_telepon' => "",
            'email' => $request->email,
            'tanggal_lahir' => date("Y-m-d"),
            'id_kota' => DB::table('kota')->first()->id_kota,
            'id_provinsi' => DB::table('provinsi')->first()->id_provinsi,
            'alamat' => '',
            'kode_pos' => ''
        ]);

        
        DB::table('penulis')-> INSERT ([
            'id_penulis' => "PNL".substr(md5($id_akun),0,4), 
            'id_akun' => $id_akun,
            'id_jurusan' => DB::table('jurusan')->first()->id_jurusan,
            'nama_penulis' => ''
        ]);
            
        
        return redirect()
            ->route('loginShow')
            ->with(['success' => 'Berhasil Signup Akun']);
    }

    public function logout() {
            // For Forget
        Session::forget('id_akun');
        Session::forget('status_akun');
        Auth::logout();
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
        $finalSearch = (new listController)->SearchBarList ();

        $tableKota = json_decode((new listController)->getTable('Kota'),true);
        $tableProv = json_decode((new listController)->getTable('Prov'),true);
        $tableProdi = json_decode((new listController)->getTable('Prodi'),true);
        
        $arrayAkun = (new listController)->getAkun();

        // print_r($arrayAkun);
        return view('profile',compact('arrayAkun','tableProdi','tableKota','tableProv','taskbarValue','finalSearch'));
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
        //check if username and password exist
            $errorString = [];
            $username_change = User::where('username','=',$request->username)->first();
            $email_change = User::where('username','=',$request->username)->first();
            if($username_change && Auth::user()->username != $username_change->username) {
                $errorString[] = 'Username Sudah Digunakan Oleh Pengguna Lain';
            }
            if($email_change && Auth::user()->email != $email_change->email) {
                $errorString[] = 'Email Sudah Digunakan Oleh Pengguna Lain';
            }
            if($errorString) {
                return redirect()
                    ->route('profile')
                    ->with('error',$errorString);
            }
        //
        $tableAkun = json_decode((new listController)->getTable('Akun-'.$id),true);
        $kota = json_decode((new listController)->getTable('KOTA-'.$request->kota),true)[0]['id_kota'];
        $provinsi = json_decode((new listController)->getTable('PROV-'.$request->prov),true)[0]['id_provinsi'];
        
        $img = null;
        if($request->hasFile('imageup')) {
            $img_ext =  $request->file('imageup')->getClientOriginalExtension();
            $img = $id.".".$img_ext;
            $request->file('imageup')->storeAs('public/profile-image/',$img);
        }
        
        // echo $img."<br>";
        // print_r($request->all());
        User::where('id',$id)->update([
            'username' => $request->username,
            'nama_lengkap' => $request->name,
            'no_telepon' => $request->tlp,
            'email' => $request->email,
            'tanggal_lahir' => $request->tgl,
            'id_kota' => $kota,
            'id_provinsi' => $provinsi,
            'alamat' => $request->alamat,
            'kode_pos' => $request->pos,
            'foto_profil' => $img
        ]);

        if (Auth::user()->status == 'Penulis') {
            $tablePenulis = json_decode((new listController)->getTable('PNL-'.$id),true);
            $jurusan = json_decode((new listController)->getTable('Prodi-'.$request->prodi),true)[0]['id_jurusan'];
            $existID = penulis::where('nama_penulis','=',$request->name,'and')
            ->where('id_penulis','!=',$tablePenulis[0]['id_penulis'])
            ->whereNull('id_akun')
            ->exists();

            // echo $existID;

            if ($existID) {
                # hapus id penulis yang didaftarkan tanpa akun
                $ExistPNL_ID = $tablePenulis[0]['id_penulis'];

                penulis::where('id_penulis','=',$tablePenulis[0]['id_penulis'])->delete();
                penulis::where('nama_penulis','=',$request->name,'and')
                ->where('id_penulis','!=',$tablePenulis[0]['id_penulis'],'and')
                ->whereNull('id_akun')
                ->update ([
                    'id_penulis' => $tablePenulis[0]['id_penulis'],
                    'id_akun' => $id,
                    'nama_penulis' => $request->name,
                    'id_jurusan' => $jurusan
                ]);
            }
            else {
                penulis::where('id_akun',$id) -> update ([
                    'id_jurusan' => $jurusan,
                    'nama_penulis' => $request->name
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
