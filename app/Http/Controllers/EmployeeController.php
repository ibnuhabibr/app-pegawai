<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        // Muat relasi 'department' dan 'position' bersamaan dengan employee
        $employees = Employee::with(['department', 'position'])->latest()->paginate(5);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::orderBy('nama_departemen')->get(); // Ambil semua department, urutkan A-Z
        $positions = Position::orderBy('nama_jabatan')->get();     // Ambil semua position, urutkan A-Z
        return view('employees.create', compact('departments', 'positions')); // Kirim ke view
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'nomor_telepon' => 'required|string|max:20',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required|string',
        'tanggal_masuk' => 'required|date',
        'status' => 'required|string',
    ]);

    // Simpan data ke database
    Employee::create($request->all());

    // Arahkan kembali ke halaman utama
    return redirect()->route('employees.index');
    }

    public function show(string $id)
    {
    $employee = Employee::find($id);
    return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee) 
    {
        $departments = Department::orderBy('nama_departemen')->get();
        $positions = Position::orderBy('nama_jabatan')->get();
        return view('employees.edit', compact('employee', 'departments', 'positions')); // Kirim ke view
    }

public function update(Request $request, string $id)
    {
    // Validasi input
    $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'nomor_telepon' => 'required|string|max:20',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required|string',
        'tanggal_masuk' => 'required|date',
        'status' => 'required|string',
    ]);

    // Cari data yang akan diupdate
    $employee = Employee::findOrFail($id);

    // Update data
    $employee->update($request->all());

    // Arahkan kembali ke halaman utama
    return redirect()->route('employees.index');
    }

    public function destroy(string $id)
    {
    // Cari data berdasarkan ID
    $employee = Employee::find($id);

    // Hapus data
    $employee->delete();

    // Arahkan kembali ke halaman utama
    return redirect()->route('employees.index');
    }
}
