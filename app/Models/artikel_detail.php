<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artikel_detail extends Model
{
    use HasFactory;
    protected $table = 'artikel_detail';
    public $timestamps = false;
    protected $primaryKey = 'ID_DETAILARTIKEL';
    protected $fillable = ['ID_DETAILARTIKEL','ID_ARTIKEL','JUDUL_ARTIKEL','TANGGAL_UPLOAD','STATUS_ARTIKEL'];
    protected $keyType = 'string';
}
