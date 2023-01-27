<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\listController;
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

        $judul =  (new listController)->UniqueList($tableArray,'JUDUL');
        $penulis = (new listController)->UniqueList($tableArray,'PENULIS');

        $final = (new listController)->TabletoList($tableArray,$judul,'title-pnl-prodi');

        $arrayAkun = (new listController)->getAkun();
        return view('status-edit',compact('arrayAkun','title','judul','penulis','tableProdi','final','taskbarValue','tableArray','AlltableArray'));
    }
}
