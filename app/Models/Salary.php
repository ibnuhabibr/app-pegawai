<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee; // <-- Tambahkan ini

class Salary extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi
    protected $fillable = [
        'karyawan_id',
        'bulan', // Format 'YYYY-MM'
        'gaji_pokok',
        'tunjangan',
        'potongan',
        'total_gaji', // Sebaiknya dihitung otomatis, tapi kita isi manual dulu
    ];

    // Kolom numerik
    protected $casts = [
        'gaji_pokok' => 'decimal:2',
        'tunjangan' => 'decimal:2',
        'potongan' => 'decimal:2',
        'total_gaji' => 'decimal:2',
    ];

    // Relasi ke Employee (Satu Gaji milik satu Employee)
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'karyawan_id');
    }
}