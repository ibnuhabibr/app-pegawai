@extends('master')

@section('title', 'Tambah Pegawai')
@section('page-title', 'Form Tambah Pegawai')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('employees.index') }}" class="text-decoration-none">Pegawai</a>
</li>
<li class="breadcrumb-item active" aria-current="page">Tambah</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <!-- Progress Indicator -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="bi bi-person-plus text-primary"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Tambah Pegawai Baru</h6>
                            <small class="text-muted">Lengkapi semua informasi yang diperlukan</small>
                        </div>
                    </div>
                    <div class="progress" style="width: 200px; height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 0%" id="formProgress"></div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('employees.store') }}" method="POST" id="employeeForm" class="needs-validation" novalidate>
            @csrf
            
            <!-- Personal Information Section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="bi bi-person text-primary"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Informasi Personal</h6>
                            <small class="text-muted">Data pribadi pegawai</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                       id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" 
                                       placeholder="Nama Lengkap" required>
                                <label for="nama_lengkap">
                                    <i class="bi bi-person me-1"></i>Nama Lengkap
                                </label>
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="valid-feedback">Terlihat bagus!</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email') }}" 
                                       placeholder="Email" required>
                                <label for="email">
                                    <i class="bi bi-envelope me-1"></i>Email
                                </label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="valid-feedback">Email valid!</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control @error('nomor_telepon') is-invalid @enderror"
                                       id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}" 
                                       placeholder="Nomor Telepon" required>
                                <label for="nomor_telepon">
                                    <i class="bi bi-telephone me-1"></i>Nomor Telepon
                                </label>
                                @error('nomor_telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="valid-feedback">Nomor telepon valid!</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label fw-semibold text-muted small">
                                <i class="bi bi-calendar me-1"></i>Tanggal Lahir
                            </label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                   id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="valid-feedback">Tanggal lahir valid!</div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control @error('alamat') is-invalid @enderror"
                                          id="alamat" name="alamat" placeholder="Alamat Lengkap" 
                                          style="height: 100px" required>{{ old('alamat') }}</textarea>
                                <label for="alamat">
                                    <i class="bi bi-geo-alt me-1"></i>Alamat Lengkap
                                </label>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="valid-feedback">Alamat lengkap!</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Work Information Section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="bi bi-briefcase text-success"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Informasi Pekerjaan</h6>
                            <small class="text-muted">Data pekerjaan dan jabatan</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="departemen_id" class="form-label fw-semibold text-muted small">
                                <i class="bi bi-building me-1"></i>Departemen
                            </label>
                            <select class="form-select @error('departemen_id') is-invalid @enderror" 
                                    id="departemen_id" name="departemen_id" required>
                                <option value="" disabled selected>-- Pilih Departemen --</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('departemen_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->nama_departemen }}
                                    </option>
                                @endforeach
                            </select>
                            @error('departemen_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="valid-feedback">Departemen dipilih!</div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="jabatan_id" class="form-label fw-semibold text-muted small">
                                <i class="bi bi-briefcase me-1"></i>Jabatan
                            </label>
                            <select class="form-select @error('jabatan_id') is-invalid @enderror" 
                                    id="jabatan_id" name="jabatan_id" required>
                                <option value="" disabled selected>-- Pilih Jabatan --</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}" {{ old('jabatan_id') == $position->id ? 'selected' : '' }}>
                                        {{ $position->nama_jabatan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jabatan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="valid-feedback">Jabatan dipilih!</div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="tanggal_masuk" class="form-label fw-semibold text-muted small">
                                <i class="bi bi-calendar-check me-1"></i>Tanggal Masuk
                            </label>
                            <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                   id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" required>
                            @error('tanggal_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="valid-feedback">Tanggal masuk valid!</div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="status" class="form-label fw-semibold text-muted small">
                                <i class="bi bi-toggle-on me-1"></i>Status Pegawai
                            </label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>
                                    <i class="bi bi-check-circle"></i> Aktif
                                </option>
                                <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>
                                    <i class="bi bi-x-circle"></i> Nonaktif
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="valid-feedback">Status dipilih!</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            <i class="bi bi-info-circle me-1"></i>
                            Pastikan semua data telah diisi dengan benar sebelum menyimpan
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-success" id="submitBtn">
                                <span class="spinner-border spinner-border-sm me-2 d-none" id="submitSpinner"></span>
                                <i class="bi bi-check-lg me-1" id="submitIcon"></i>
                                <span id="submitText">Simpan Data</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('employeeForm');
    const progressBar = document.getElementById('formProgress');
    const submitBtn = document.getElementById('submitBtn');
    const submitSpinner = document.getElementById('submitSpinner');
    const submitIcon = document.getElementById('submitIcon');
    const submitText = document.getElementById('submitText');
    
    // Form validation
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            // Show loading state
            submitBtn.disabled = true;
            submitSpinner.classList.remove('d-none');
            submitIcon.classList.add('d-none');
            submitText.textContent = 'Menyimpan...';
        }
        form.classList.add('was-validated');
    });
    
    // Progress calculation
    function updateProgress() {
        const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
        const filledInputs = Array.from(inputs).filter(input => {
            if (input.type === 'email') {
                return input.value && input.checkValidity();
            }
            return input.value.trim() !== '';
        });
        
        const progress = (filledInputs.length / inputs.length) * 100;
        progressBar.style.width = progress + '%';
        
        // Change color based on progress
        if (progress < 30) {
            progressBar.className = 'progress-bar bg-danger';
        } else if (progress < 70) {
            progressBar.className = 'progress-bar bg-warning';
        } else {
            progressBar.className = 'progress-bar bg-success';
        }
    }
    
    // Add event listeners to all form inputs
    const allInputs = form.querySelectorAll('input, select, textarea');
    allInputs.forEach(input => {
        input.addEventListener('input', updateProgress);
        input.addEventListener('change', updateProgress);
        
        // Add real-time validation feedback
        input.addEventListener('blur', function() {
            if (this.checkValidity()) {
                this.classList.add('is-valid');
                this.classList.remove('is-invalid');
            } else {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
            }
        });
    });
    
    // Initial progress calculation
    updateProgress();
    
    // Phone number formatting
    const phoneInput = document.getElementById('nomor_telepon');
    phoneInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.startsWith('0')) {
            value = value.substring(1);
        }
        if (value.length > 0) {
            value = '+62 ' + value;
        }
        this.value = value;
    });
    
    // Auto-fill current date for tanggal_masuk
    const tanggalMasukInput = document.getElementById('tanggal_masuk');
    if (!tanggalMasukInput.value) {
        const today = new Date().toISOString().split('T')[0];
        tanggalMasukInput.value = today;
    }
    
    // Smooth scroll to first error
    form.addEventListener('invalid', function(event) {
        event.preventDefault();
        const firstInvalid = form.querySelector(':invalid');
        if (firstInvalid) {
            firstInvalid.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
            firstInvalid.focus();
        }
    }, true);
});
</script>
@endsection