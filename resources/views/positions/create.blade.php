@extends('master')

@section('title', 'Tambah Jabatan')
@section('page-title', 'Form Tambah Jabatan')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('positions.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror"
                       id="nama_jabatan" name="nama_jabatan" value="{{ old('nama_jabatan') }}" required>
                @error('nama_jabatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                <input type="number" class="form-control @error('gaji_pokok') is-invalid @enderror"
                       id="gaji_pokok" name="gaji_pokok" value="{{ old('gaji_pokok') }}" required min="0" step="1000">
                @error('gaji_pokok')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('positions.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection