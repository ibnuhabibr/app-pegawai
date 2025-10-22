<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Position;
use App\Models\Attendance;
use App\Models\Salary;

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

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
    ];

    // Relasi ke Department (Satu Employee punya satu Department)
    public function department()
    {
        return $this->belongsTo(Department::class, 'departemen_id');
    }

    // Relasi ke Position (Satu Employee punya satu Position)
    public function position()
    {
        return $this->belongsTo(Position::class, 'jabatan_id');
    }

    // Relasi ke Attendance (Satu Employee punya banyak data Absensi)
    public function attendance() 
    {
        // hasMany(NamaModelRelasi::class, 'foreign_key_di_tabel_relasi')
        return $this->hasMany(Attendance::class, 'karyawan_id');
    }

    public function salaries() 
    {
    return $this->hasMany(Salary::class, 'karyawan_id');
    }
}