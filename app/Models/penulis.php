<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penulis extends Model
{
    use HasFactory;
    protected $table = 'penulis';
    public $timestamps = false;
    protected $primaryKey = 'ID_PENULIS';
    protected $fillable = ['ID_PENULIS','ID_AKUN','ID_JURUSAN','NAMA_PENULIS'];
    protected $keyType = 'string';
}
