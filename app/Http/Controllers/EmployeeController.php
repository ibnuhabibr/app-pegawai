<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    // 1. Mengambil semua data dari tabel 'employees' menggunakan Model
    $employees = Employee::all();

    // 2. Mengirim data ke view dan menampilkannya
    return view('employees.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    // 1. Validasi data
    $request->validate([
        'nama_lengkap' => 'required|string|max:100',
        'email' => 'required|email|max:100',
        'nomor_telepon' => 'required|string|max:15',
        'tanggal_lahir' => 'required|date',
        'tanggal_masuk' => 'required|date',
        'alamat' => 'required|string',
    ]);

    // 2. Simpan data ke database
    Employee::create($request->all());

    // 3. Redirect kembali ke halaman index
    return redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
    return view('employees.edit', ['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
    // 1. Validasi data
    $request->validate([
        'nama_lengkap' => 'required|string|max:100',
        'email' => 'required|email|max:100',
        'nomor_telepon' => 'required|string|max:15',
        'tanggal_lahir' => 'required|date',
        'tanggal_masuk' => 'required|date',
        'alamat' => 'required|string',
    ]);

    // 2. Update data di database
    $employee->update($request->all());

    // 3. Redirect kembali ke halaman index
    return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
    // Hapus data dari database
    $employee->delete();

    // Redirect kembali ke halaman index
    return redirect()->route('employee.index');
    }
}
