<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artikel_detail extends Model
{
    use HasFactory;
    protected $table = 'artikel_detail';
    protected $primaryKey = 'id_artikel_detail';
    protected $fillable = ['id_artikel_detail',
                            'id_artikel',
                            'judul_artikel',
                            'status_artikel',
                            'file_artikel'];
    protected $keyType = 'string';
}
