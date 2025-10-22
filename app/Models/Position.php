<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee; 

class Position extends Model
{
    use HasFactory;
    protected $fillable = ['nama_jabatan', 'gaji_pokok'];

    // Relasi ke Employee (Satu Position punya banyak Employee)
    public function employees()
    {
        // hasMany(NamaModelRelasi::class, 'foreign_key_di_tabel_relasi')
        return $this->hasMany(Employee::class, 'jabatan_id');
    }
}