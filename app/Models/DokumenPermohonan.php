<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPermohonan extends Model
{
    use HasFactory;

    protected $table = 'dokumen_permohonans';

    protected $fillable = [
        'permohonan_id', 'nama_dokumen', 'file_path','status','keterangan'
    ];

    public function permohonan()
    {
        return $this->belongsTo(Permohonan::class);
    }
}
