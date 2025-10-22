<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee; // <-- Import Employee
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        // Eager load relasi employee
        $attendances = Attendance::with('employee')->latest()->paginate(10);
        return view('attendance.index', compact('attendances'));
    }

    public function create()
    {
        $employees = Employee::orderBy('nama_lengkap')->get(); // Ambil data employee
        return view('attendance.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'required|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i|after:waktu_masuk', // Boleh kosong, tapi jika diisi harus setelah waktu masuk
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha', // Pastikan valuenya sesuai enum
        ]);

        Attendance::create($request->all());

        return redirect()->route('attendance.index')
                         ->with('success', 'Data absensi berhasil ditambahkan.');
    }

    public function show(Attendance $attendance)
    {
        // Eager load relasi employee
        $attendance->load('employee');
        return view('attendance.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $employees = Employee::orderBy('nama_lengkap')->get();
        return view('attendance.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'required|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i|after:waktu_masuk',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        $attendance->update($request->all());

        return redirect()->route('attendance.index')
                         ->with('success', 'Data absensi berhasil diperbarui.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendance.index')
                         ->with('success', 'Data absensi berhasil dihapus.');
    }
}