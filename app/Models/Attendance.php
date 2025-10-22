<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee; 

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendance';

    // Kolom yang boleh diisi
    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'waktu_masuk',
        'waktu_keluar',
        'status_absensi',
    ];

    // Otomatis format kolom ini sebagai Carbon (object tanggal/waktu)
    protected $casts = [
        'tanggal' => 'date',
        'waktu_masuk' => 'datetime:H:i', // Format jam:menit
        'waktu_keluar' => 'datetime:H:i', // Format jam:menit
    ];

    // Relasi ke Employee (Satu Absensi milik satu Employee)
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'karyawan_id');
    }
}