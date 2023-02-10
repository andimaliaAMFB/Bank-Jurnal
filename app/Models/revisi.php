<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class revisi extends Model
{
    use HasFactory;
    protected $table = 'revisi';
    protected $primaryKey = 'id_revisi';
    protected $fillable = ['id_revisi',
                            'id_artikel_detail',
                            'id_akun',
                            'status_artikel_baru',
                            'status_revisi',
                            'catatan_revisi'];
    protected $keyType = 'string';
}
