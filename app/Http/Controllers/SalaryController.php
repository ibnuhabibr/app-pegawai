<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee; 
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::with('employee')->latest()->paginate(10);
        return view('salaries.index', compact('salaries'));
    }

    public function create()
    {
        $employees = Employee::orderBy('nama_lengkap')->get();
        return view('salaries.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|date_format:Y-m', // Format tahun-bulan (e.g., 2025-10)
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
        ]);

        // Hitung total gaji
        $gajiPokok = $request->gaji_pokok;
        $tunjangan = $request->tunjangan ?? 0; // Default 0 jika null
        $potongan = $request->potongan ?? 0;   // Default 0 jika null
        $totalGaji = ($gajiPokok + $tunjangan) - $potongan;

        // Gabungkan data request dengan total gaji
        $data = $request->all();
        $data['total_gaji'] = $totalGaji;

        Salary::create($data);

        return redirect()->route('salaries.index')
                         ->with('success', 'Data gaji berhasil ditambahkan.');
    }

    public function show(Salary $salary)
    {
        $salary->load('employee');
        return view('salaries.show', compact('salary'));
    }

    public function edit(Salary $salary)
    {
        $employees = Employee::orderBy('nama_lengkap')->get();
        return view('salaries.edit', compact('salary', 'employees'));
    }

    public function update(Request $request, Salary $salary)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|date_format:Y-m',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
        ]);

        // Hitung ulang total gaji
        $gajiPokok = $request->gaji_pokok;
        $tunjangan = $request->tunjangan ?? 0;
        $potongan = $request->potongan ?? 0;
        $totalGaji = ($gajiPokok + $tunjangan) - $potongan;

        // Gabungkan data request dengan total gaji
        $data = $request->all();
        $data['total_gaji'] = $totalGaji;

        $salary->update($data);

        return redirect()->route('salaries.index')
                         ->with('success', 'Data gaji berhasil diperbarui.');
    }

    public function destroy(Salary $salary)
    {
        $salary->delete();
        return redirect()->route('salaries.index')
                         ->with('success', 'Data gaji berhasil dihapus.');
    }
}