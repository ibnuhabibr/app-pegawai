<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee; 

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['nama_departemen'];

    // Relasi ke Employee (Satu Department punya banyak Employee)
    public function employees()
    {
        // hasMany(NamaModelRelasi::class, 'foreign_key_di_tabel_relasi')
        return $this->hasMany(Employee::class, 'departemen_id');
    }
}