@extends('master')

@section('title', 'Detail Departemen')
@section('page-title', 'Detail Departemen')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $department->nama_departemen }}</h3>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">ID Departemen</dt>
            <dd class="col-sm-9">{{ $department->id }}</dd>

            <dt class="col-sm-3">Nama Departemen</dt>
            <dd class="col-sm-9">{{ $department->nama_departemen }}</dd>

            <dt class="col-sm-3">Dibuat Pada</dt>
            <dd class="col-sm-9">{{ $department->created_at->format('d M Y H:i:s') }}</dd>

            <dt class="col-sm-3">Diperbarui Pada</dt>
            <dd class="col-sm-9">{{ $department->updated_at->format('d M Y H:i:s') }}</dd>
        </dl>
    </div>
    <div class="card-footer text-end">
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection