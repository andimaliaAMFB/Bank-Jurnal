<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penulis extends Model
{
    use HasFactory;
    protected $table = 'penulis';
    public $timestamps = false;
    protected $primaryKey = 'id_penulis';
    protected $fillable = ['id_penulis','id_akun','id_jurusan','nama_penulis'];
    protected $keyType = 'string';
}
