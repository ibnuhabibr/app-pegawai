@extends('master')

@section('title', 'Input Gaji')
@section('page-title', 'Form Input Gaji')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('salaries.store') }}" method="POST">
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
                <label for="bulan" class="form-label">Bulan (Tahun-Bulan)</label>
                <input type="month" class="form-control @error('bulan') is-invalid @enderror"
                       id="bulan" name="bulan" value="{{ old('bulan', date('Y-m')) }}" required>
                @error('bulan')
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
             <div class="mb-3">
                <label for="tunjangan" class="form-label">Tunjangan</label>
                <input type="number" class="form-control @error('tunjangan') is-invalid @enderror"
                       id="tunjangan" name="tunjangan" value="{{ old('tunjangan', 0) }}" min="0" step="1000">
                @error('tunjangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="potongan" class="form-label">Potongan</label>
                <input type="number" class="form-control @error('potongan') is-invalid @enderror"
                       id="potongan" name="potongan" value="{{ old('potongan', 0) }}" min="0" step="1000">
                @error('potongan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- Total Gaji tidak perlu input, akan dihitung otomatis --}}
            <div class="d-flex justify-content-end">
                <a href="{{ route('salaries.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection