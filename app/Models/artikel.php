<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artikel extends Model
{
    use HasFactory;
    protected $table = 'artikel';
    public $timestamps = false;
    protected $primaryKey = 'ID_ARTIKEL';
    protected $fillable = ['ID_ARTIKEL','ID_AKUN'];
    protected $keyType = 'string';
}
