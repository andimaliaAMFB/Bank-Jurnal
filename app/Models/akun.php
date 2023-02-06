<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\akun as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class akun extends Model
{
    use HasFactory;
    protected $table = 'akun';
    public $timestamps = false;
    protected $primaryKey = 'ID_AKUN';
    protected $fillable = ['ID_AKUN','USERNAME','PASSWORD','NAMA','STATUS_PENGGUNA','NO_TELEPON','EMAIL','TANGGAL_LAHIR','ALAMAT','ID_KOTA','ID_PROVINSI','KODE_POS'];
    protected $keyType = 'string';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [ 'PASSWORD', 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['PASSWORD'] = bcrypt($value);
    }
}
