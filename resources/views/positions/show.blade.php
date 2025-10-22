@extends('master')

@section('title', 'Detail Jabatan')
@section('page-title', 'Detail Jabatan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $position->nama_jabatan }}</h3>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">ID Jabatan</dt>
            <dd class="col-sm-9">{{ $position->id }}</dd>

            <dt class="col-sm-3">Nama Jabatan</dt>
            <dd class="col-sm-9">{{ $position->nama_jabatan }}</dd>

            <dt class="col-sm-3">Gaji Pokok</dt>
            <dd class="col-sm-9">Rp {{ number_format($position->gaji_pokok, 0, ',', '.') }}</dd>

            <dt class="col-sm-3">Dibuat Pada</dt>
            <dd class="col-sm-9">{{ $position->created_at->format('d M Y H:i:s') }}</dd>

            <dt class="col-sm-3">Diperbarui Pada</dt>
            <dd class="col-sm-9">{{ $position->updated_at->format('d M Y H:i:s') }}</dd>
        </dl>
    </div>
    <div class="card-footer text-end">
        <a href="{{ route('positions.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection