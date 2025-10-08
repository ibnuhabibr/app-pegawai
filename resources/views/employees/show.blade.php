@extends('master')

@section('title', 'Detail Pegawai')
@section('page-title', 'Detail Pegawai')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $employee->nama_lengkap }}</h3>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Nama Lengkap</dt>
            <dd class="col-sm-9">{{ $employee->nama_lengkap }}</dd>

            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">{{ $employee->email }}</dd>

            <dt class="col-sm-3">Nomor Telepon</dt>
            <dd class="col-sm-9">{{ $employee->nomor_telepon }}</dd>

            <dt class="col-sm-3">Tanggal Lahir</dt>
            <dd class="col-sm-9">{{ $employee->tanggal_lahir }}</dd>

            <dt class="col-sm-3">Alamat</dt>
            <dd class="col-sm-9">{{ $employee->alamat }}</dd>

            <dt class="col-sm-3">Tanggal Masuk</dt>
            <dd class="col-sm-9">{{ $employee->tanggal_masuk }}</dd>

            <dt class="col-sm-3">Status</dt>
            <dd class="col-sm-9">
                @if($employee->status == 'aktif')
                    <span class="badge bg-success">Aktif</span>
                @else
                    <span class="badge bg-danger">Nonaktif</span>
                @endif
            </dd>
        </dl>
    </div>
    <div class="card-footer text-end">
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
