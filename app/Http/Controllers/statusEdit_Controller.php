<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\listController;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RevisionNotif;

use App\Models\User;
use App\Models\penulis;
use App\Models\artikel;
use App\Models\artikel_detail;
use App\Models\artikel_detail_penulis;
use App\Models\revisi;
use Session;

class statusEdit_Controller extends Controller
{
    public function index($level_status) {
        $title;
        $tableName;
        if ($level_status == "draft") {
            $title = "Artikel Draft";
            $tableName = "Draft";
        }
        else  if ($level_status == "revisi-mayor") {
            $title = "Artikel Revisi Mayor";
            $tableName = "Revisi Mayor";
        }
        else  if ($level_status == "revisi-minor") {
            $title = "Artikel Revisi Minor";
            $tableName = "Revisi Minor";
        }

        $taskbarValue = (new listController)->taskbarList ();
        $finalSearch = (new listController)->SearchBarList ();

        $tableArray = json_decode((new listController)->getTable($tableName),true);
        $tableProdi = json_decode((new listController)->getTable('Prodi'),true);

        $final = (new listController)->finalArray($tableArray);
        $judul =  array_column($final, 0);
        $penulis = [];
        foreach(array_column($final, 2) as $list_penulis) {
            $array_penulis = explode(", ",$list_penulis);
            foreach($array_penulis as $nama_penulis) {
                if(!in_array($nama_penulis,$penulis)) { $penulis[] = $nama_penulis; }
            }
        }
        $history = (new listController)->historyArray ($tableArray);

        $arrayAkun = (new listController)->getAkun();
        return view('status-edit',compact('arrayAkun','title','judul','penulis','tableProdi','final','taskbarValue','finalSearch','history','level_status'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $level_status, $id) {
        $artikelDetail = json_decode((new listController)->getTable('Judul-'.$id),true);

        $StaBaru = ($request->status_baru) ? $request->status_baru : null;
        $CatatanBaru = ($request->catatan_revisi) ? $request->catatan_revisi : null ;
        $idPenulis = artikel_detail_penulis::where('id_artikel_detail', '=', $artikelDetail[0]['id_artikel_detail'])->get();
        $Akun = [];
        foreach($idPenulis as $key => $value) {
            $idAkun = penulis::where('id_penulis','=',$value->id_penulis)->first()->id_akun;
            if(!in_array($idAkun,$Akun)) { $Akun[] = $idAkun; }
        }

        if ($StaBaru && $CatatanBaru) {
            revisi::where('id_artikel_detail',$artikelDetail[0]['id_artikel_detail'])
            ->update ([
                'id_akun' => Auth()->user()->id,
                'status_revisi' => 1,
                'status_artikel_baru' => $StaBaru,
                'catatan_revisi' => $CatatanBaru,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        
        
            foreach ($Akun as $value) { //kirim notifikasi pembaruan revisi oleh admin
                $message = [
                    'to' => $value,
                    'judul_artikel' => $id,
                    'subject' => 'Perubahan Status Artikel',
                    'message' => 'Artikel '.$id.' Telah Dinilai'
                ];
                User::where('id','=',$value)->first()->notify(new RevisionNotif($message));
            }
    
            return redirect()
                ->back()
                ->with(['success' => 'Berhasil Update Status Artikel '.$id.' dari ['.$artikelDetail[0]['status_artikel'].'] ke ['.$StaBaru.']']);

        }
        else {

            return redirect()
                ->back()
                ->with(['error' => 'Perubahan Status Artikel Gagal (Pastikan Memasukan Penilaian Revisi Sebelum Mengirim Perubahan)']);
        }
    }

}
