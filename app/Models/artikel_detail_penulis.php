<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artikel_detail_penulis extends Model
{
    use HasFactory;
    protected $table = 'artikel_detail_penulis';
    public $timestamps = false;
    protected $primaryKey = 'ID_LIST_PENULIS';
    protected $fillable = ['ID_LIST_PENULIS','ID_PENULIS','ID_DETAILARTIKEL'];
}
