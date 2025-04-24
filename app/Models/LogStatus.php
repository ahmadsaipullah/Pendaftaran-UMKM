<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogStatus extends Model
{
    use HasFactory;

    protected $table = 'log_statuses';

    protected $fillable = [
        'permohonan_id',
        'status',
        'catatan',
        'updated_by',
    ];

    public function permohonan()
    {
        return $this->belongsTo(Permohonan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }


}
