<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;

    protected $table = 'permohonans';

    protected $fillable = [
       'user_id', 'umkm_id', 'nomor_permohonan', 'tanggal_pengajuan', 'status', 'keterangan',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenPermohonan::class);
    }

    public function logs()
    {
        return $this->hasMany(LogStatus::class);
    }
}
