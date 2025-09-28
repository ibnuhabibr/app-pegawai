<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->paginate(5);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
    return view('employees.create');
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

    public function edit(string $id)
    {
    $employee = Employee::find($id);
    return view('employees.edit', compact('employee'));
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
