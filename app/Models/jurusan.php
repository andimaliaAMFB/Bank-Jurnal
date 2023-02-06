<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurusan extends Model
{
    use HasFactory;
    protected $table = 'jurusan';
    public $timestamps = false;
    protected $primaryKey = 'ID_JURUSAN';
    protected $fillable = ['ID_JURUSAN','NAMA_JURUSAN'];
    protected $keyType = 'string';
}
