@extends('master')

@section('title', 'Input Absensi')
@section('page-title', 'Form Input Absensi')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('attendance.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="karyawan_id" class="form-label">Nama Karyawan</label>
                <select class="form-select @error('karyawan_id') is-invalid @enderror" id="karyawan_id" name="karyawan_id" required>
                    <option value="" disabled selected>-- Pilih Karyawan --</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('karyawan_id') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
                @error('karyawan_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                       id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
                <input type="time" class="form-control @error('waktu_masuk') is-invalid @enderror"
                       id="waktu_masuk" name="waktu_masuk" value="{{ old('waktu_masuk') }}" required>
                @error('waktu_masuk')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="waktu_keluar" class="form-label">Waktu Keluar</label>
                <input type="time" class="form-control @error('waktu_keluar') is-invalid @enderror"
                       id="waktu_keluar" name="waktu_keluar" value="{{ old('waktu_keluar') }}">
                @error('waktu_keluar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
             <div class="mb-3">
                <label for="status_absensi" class="form-label">Status Absensi</label>
                <select class="form-select @error('status_absensi') is-invalid @enderror" id="status_absensi" name="status_absensi" required>
                    <option value="" disabled selected>-- Pilih Status --</option>
                    <option value="hadir" {{ old('status_absensi') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="izin" {{ old('status_absensi') == 'izin' ? 'selected' : '' }}>Izin</option>
                    <option value="sakit" {{ old('status_absensi') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                    <option value="alpha" {{ old('status_absensi') == 'alpha' ? 'selected' : '' }}>Alpha</option>
                </select>
                 @error('status_absensi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('attendance.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection