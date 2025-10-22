@extends('master')

@section('title', 'Detail Absensi')
@section('page-title', 'Detail Absensi')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail Absensi: {{ $attendance->employee->nama_lengkap ?? 'N/A' }}</h3>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Nama Karyawan</dt>
            <dd class="col-sm-9">{{ $attendance->employee->nama_lengkap ?? 'N/A' }}</dd>

            <dt class="col-sm-3">Tanggal</dt>
            <dd class="col-sm-9">{{ $attendance->tanggal->format('d M Y') }}</dd>

            <dt class="col-sm-3">Waktu Masuk</dt>
            <dd class="col-sm-9">{{ $attendance->waktu_masuk }}</dd>
            
            <dt class="col-sm-3">Waktu Keluar</dt>
            <dd class="col-sm-9">{{ $attendance->waktu_keluar ?? '-' }}</dd>

            <dt class="col-sm-3">Status Absensi</dt>
            <dd class="col-sm-9">{{ $attendance->status_absensi }}</dd>

            <dt class="col-sm-3">Dibuat Pada</dt>
            <dd class="col-sm-9">{{ $attendance->created_at->format('d M Y H:i:s') }}</dd>
        </dl>
    </div>
    <div class="card-footer text-end">
        <a href="{{ route('attendance.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection