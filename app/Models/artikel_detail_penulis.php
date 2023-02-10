<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artikel_detail_penulis extends Model
{
    use HasFactory;
    protected $table = 'artikel_detail_penulis';
    public $timestamps = false;
    protected $primaryKey = 'id_list_penulis';
    protected $fillable = ['id_list_penulis','id_penulis','id_artikel_detail'];
    protected $keyType = 'string';
}
