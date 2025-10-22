<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department; // <-- Import
use App\Models\Position;   // <-- Import

class DepartmentPositionSeeder extends Seeder
{
    public function run(): void
    {
        Department::create(['nama_departemen' => 'IT']);
        Department::create(['nama_departemen' => 'Human Resources']);
        Department::create(['nama_departemen' => 'Finance']);

        Position::create(['nama_jabatan' => 'Software Engineer', 'gaji_pokok' => 15000000]);
        Position::create(['nama_jabatan' => 'HR Staff', 'gaji_pokok' => 8000000]);
        Position::create(['nama_jabatan' => 'Accounting', 'gaji_pokok' => 9000000]);
    }
}