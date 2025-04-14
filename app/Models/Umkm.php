<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $table = 'umkms';
    protected $fillable = [
        'user_id', 'nama_umkm', 'jenis_usaha', 'alamat_umkm', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function permohonans()
    {
        return $this->hasMany(Permohonan::class);
    }
}
