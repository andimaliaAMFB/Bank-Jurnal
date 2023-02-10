<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artikel extends Model
{
    use HasFactory;
    protected $table = 'artikel';
    protected $primaryKey = 'id_artikel';
    protected $fillable = ['id_artikel','id_akun'];
    protected $keyType = 'string';
}
