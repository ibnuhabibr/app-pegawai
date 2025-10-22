<?php

namespace App\Http\Controllers;

use App\Models\Position; // <-- Import Model
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::latest()->paginate(5); // Ambil data
        return view('positions.index', compact('positions')); // Kirim ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('positions.create'); // Tampilkan form create
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'nama_jabatan' => 'required|string|max:100|unique:positions,nama_jabatan',
            'gaji_pokok' => 'required|numeric|min:0', // Pastikan numerik & tidak negatif
        ]);

        // Simpan
        Position::create($request->all());

        // Redirect
        return redirect()->route('positions.index')
                         ->with('success', 'Jabatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        return view('positions.show', compact('position')); // Tampilkan detail
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        return view('positions.edit', compact('position')); // Tampilkan form edit
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        // Validasi
        $request->validate([
            'nama_jabatan' => 'required|string|max:100|unique:positions,nama_jabatan,' . $position->id,
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        // Update
        $position->update($request->all());

        // Redirect
        return redirect()->route('positions.index')
                         ->with('success', 'Jabatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        // Hapus
        $position->delete();

        // Redirect
        return redirect()->route('positions.index')
                         ->with('success', 'Jabatan berhasil dihapus.');
    }
}