<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class revisi_detail extends Model
{
    use HasFactory;
    protected $table = 'revisi_detail';
    public $timestamps = false;
    protected $primaryKey = 'ID_DETAILREVISI';
    protected $fillable = ['ID_DETAILREVISI','ID_REVISI','TANGGAL_REVISI','STATUS_ARTIKEL_BARU','STATUS_REVISI','REVISI'];
    protected $keyType = 'string';
}
