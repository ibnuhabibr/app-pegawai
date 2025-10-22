@extends('master')

@section('title', 'Detail Gaji')
@section('page-title', 'Detail Gaji')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail Gaji: {{ $salary->employee->nama_lengkap ?? 'N/A' }} ({{ \Carbon\Carbon::parse($salary->bulan.'-01')->format('M Y') }})</h3>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Nama Karyawan</dt>
            <dd class="col-sm-9">{{ $salary->employee->nama_lengkap ?? 'N/A' }}</dd>

            <dt class="col-sm-3">Bulan</dt>
            <dd class="col-sm-9">{{ \Carbon\Carbon::parse($salary->bulan.'-01')->format('F Y') }}</dd> {{-- Nama bulan lengkap --}}

            <dt class="col-sm-3">Gaji Pokok</dt>
            <dd class="col-sm-9">Rp {{ number_format($salary->gaji_pokok, 2, ',', '.') }}</dd> {{-- Tambah 2 desimal --}}

            <dt class="col-sm-3">Tunjangan</dt>
            <dd class="col-sm-9">Rp {{ number_format($salary->tunjangan, 2, ',', '.') }}</dd>

            <dt class="col-sm-3">Potongan</dt>
            <dd class="col-sm-9">Rp {{ number_format($salary->potongan, 2, ',', '.') }}</dd>

            <hr> {{-- Pemisah --}}

            <dt class="col-sm-3">Total Gaji Diterima</dt>
            <dd class="col-sm-9 fw-bold">Rp {{ number_format($salary->total_gaji, 2, ',', '.') }}</dd> {{-- Tebalkan --}}

            <dt class="col-sm-3 mt-3">Data Dibuat Pada</dt>
            <dd class="col-sm-9 mt-3">{{ $salary->created_at->format('d M Y H:i:s') }}</dd>
        </dl>
    </div>
    <div class="card-footer text-end">
        <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection