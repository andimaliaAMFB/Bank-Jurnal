<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provinsi extends Model
{
    use HasFactory;
    protected $table = 'provinsi';
    public $timestamps = false;
    protected $primaryKey = 'id_provinsi';
    protected $fillable = ['id_provinsi','nama_provinsi'];
    protected $keyType = 'string';
}
