<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// TAMBAHKAN INI
use App\Models\Department;
use App\Models\Position;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'status',
        'departemen_id',
        'jabatan_id',
    ];

    // TAMBAHKAN METHOD INI
    public function department()
    {
        return $this->belongsTo(Department::class, 'departemen_id');
    }

    // DAN METHOD INI
    public function position()
    {
        return $this->belongsTo(Position::class, 'jabatan_id');
    }
}
