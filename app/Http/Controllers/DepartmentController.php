<?php

namespace App\Http\Controllers;

use App\Models\Department; // <-- Import Model
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::latest()->paginate(5); // Ambil data, urutkan, paginasi
        return view('departments.index', compact('departments')); // Kirim ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create'); // Tampilkan form create
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'nama_departemen' => 'required|string|max:100|unique:departments,nama_departemen', // Nama harus unik
        ]);

        // Simpan
        Department::create($request->all());

        // Redirect
        return redirect()->route('departments.index')
                         ->with('success', 'Departemen berhasil ditambahkan.'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        // Kita bisa gunakan Route Model Binding
        return view('departments.show', compact('department')); // Tampilkan detail
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department')); // Tampilkan form edit
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        // Validasi
        $request->validate([
            // Pastikan unik kecuali untuk dirinya sendiri
            'nama_departemen' => 'required|string|max:100|unique:departments,nama_departemen,' . $department->id,
        ]);

        // Update
        $department->update($request->all());

        // Redirect
        return redirect()->route('departments.index')
                         ->with('success', 'Departemen berhasil diperbarui.'); //  pesan sukses
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        // Hapus
        $department->delete();

        // Redirect
        return redirect()->route('departments.index')
                         ->with('success', 'Departemen berhasil dihapus.'); 
    }
}