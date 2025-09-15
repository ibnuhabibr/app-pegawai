<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    // Ambil data employees, sekaligus data department dan position terkait
    $employees = Employee::with(['department', 'position'])->get();

    return view('employees.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $departments = Department::all();
    $positions = Position::all();
    return view('employees.create', compact('departments', 'positions'));
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
    $departments = Department::all();
    $positions = Position::all();
    return view('employees.edit', compact('employee', 'departments', 'positions'));
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
