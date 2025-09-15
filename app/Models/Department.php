<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee; // Tambahkan ini

class Department extends Model
{
    use HasFactory;

    // Tambahkan method ini
    public function employees()
    {
        return $this->hasMany(Employee::class, 'departemen_id');
    }
}
