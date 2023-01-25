<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class statusEdit_Controller extends Controller
{
    public function index($level_status) {
        $title;
        if ($level_status == "draft") {
            $title = "Artikel Draft";
        }
        else  if ($level_status == "revisi-minor") {
            $title = "Artikel Revisi Minor";
        }
        else  if ($level_status == "revisi-mayor") {
            $title = "Artikel Revisi Minor";
        }
        else  if ($level_status == "layak-publish") {
            $title = "Artikel Layak Publish";
        }
        return view('status-edit',compact('title'));
    }
}
