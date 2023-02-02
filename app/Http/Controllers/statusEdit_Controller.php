<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\listController;
use App\Models\akun;
use App\Models\penulis;
use App\Models\artikel;
use App\Models\artikel_detail;
use App\Models\artikel_detail_penulis;
use App\Models\revisi;
use App\Models\revisi_detail;
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

        $AlltableArray = json_decode((new listController)->getTable('All'),true);
        $tableArray = json_decode((new listController)->getTable($tableName),true);
        $tableProdi = json_decode((new listController)->getTable('Prodi'),true);
        
        $tableArray = (new listController)->SliceTable($tableArray, $AlltableArray, $tableName);

        $judul =  (new listController)->UniqueList($tableArray,'JUDUL');
        $penulis = (new listController)->UniqueList($tableArray,'PENULIS');

        $final = (new listController)->TabletoList($tableArray,$judul,'title-pnl-prodi');

        $arrayAkun = (new listController)->getAkun();
        return view('status-edit',compact('arrayAkun','title','judul','penulis','tableProdi','final','taskbarValue','tableArray','AlltableArray','level_status'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $level_status, $id) {
        // echo $level_status." || ".$id;
        // print_r($request->all());
        $artikelDetail = json_decode((new listController)->getTable('Judul-'.$id),true);

        $StaBaru = ($request->status_baru) ? $request->status_baru : null;
        $CatatanBaru = ($request->catatan_revisi) ? $request->catatan_revisi : null ;
        // echo "<br>".$StaBaru."<br>";
        // echo "<br>".$CatatanBaru."<br>";

        if ($StaBaru && $CatatanBaru) {
            revisi_detail::where('ID_DETAILREVISI',$artikelDetail[0]['ID_DETAILREVISI'])
            ->update ([
                'STATUS_REVISI' => 1,
                'STATUS_ARTIKEL_BARU' => $StaBaru,
                'REVISI' => $CatatanBaru
            ]);
        }
        
        return redirect()
            ->route('status.index', ['level_status' => $level_status])
            ->with(['success' => 'Berhasil Update Status Artikel '.$id.' dari ['.$artikelDetail[0]['STATUS_ARTIKEL'].'] ke ['.$StaBaru.']']);
    }

}
