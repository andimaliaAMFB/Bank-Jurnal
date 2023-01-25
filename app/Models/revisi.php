<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class revisi extends Model
{
    use HasFactory;
    protected $table = 'revisi';
    public $timestamps = false;
    protected $primaryKey = 'ID_REVISI';
    protected $fillable = ['ID_REVISI','ID_DETAILARTIKEL','ID_AKUN'];
}
