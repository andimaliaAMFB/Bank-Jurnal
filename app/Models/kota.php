<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kota extends Model
{
    use HasFactory;
    protected $table = 'kota';
    public $timestamps = false;
    protected $primaryKey = 'ID_KOTA';
    protected $fillable = ['ID_KOTA','NAMA_KOTA'];
    protected $keyType = 'string';
}
