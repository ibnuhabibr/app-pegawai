<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Pegawai')</title>
    
    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Google Fonts - Inter for modern typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <!-- Meta tags for better SEO and performance -->
    <meta name="description" content="Sistem manajemen data pegawai modern dengan UI/UX yang elegan">
    <meta name="theme-color" content="#667eea">
</head>
<body class="slide-in">

    <!-- Modern Minimalist Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top border-bottom">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/employees') }}">
                <div class="brand-icon me-3">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="32" height="32" rx="8" fill="#6366F1"/>
                        <path d="M16 8C13.7909 8 12 9.79086 12 12C12 14.2091 13.7909 16 16 16C18.2091 16 20 14.2091 20 12C20 9.79086 18.2091 8 16 8Z" fill="white"/>
                        <path d="M8 22C8 18.6863 10.6863 16 14 16H18C21.3137 16 24 18.6863 24 22V24H8V22Z" fill="white"/>
                    </svg>
                </div>
                <div>
                    <span class="fw-bold text-dark fs-5">Pegawai</span>
                    <div class="text-muted small">Management System</div>
                </div>
            </a>
            
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern {{ request()->is('employees*') ? 'active' : '' }}" href="{{ url('/employees') }}">
                            <i class="bi bi-people me-2"></i>Pegawai
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern {{ request()->is('departments*') ? 'active' : '' }}" href="{{ url('/departments') }}">
                            <i class="bi bi-building me-2"></i>Departemen
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern {{ request()->is('positions*') ? 'active' : '' }}" href="{{ url('/positions') }}">
                            <i class="bi bi-briefcase me-2"></i>Jabatan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern {{ request()->is('attendance*') ? 'active' : '' }}" href="{{ url('/attendance') }}">
                            <i class="bi bi-clock me-2"></i>Absensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-modern {{ request()->is('salaries*') ? 'active' : '' }}" href="{{ url('/salaries') }}">
                            <i class="bi bi-currency-dollar me-2"></i>Gaji
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Clean Main Content -->
    <main class="container-fluid px-4 py-4 min-vh-100">
        <div class="row">
            <div class="col-12">
                <!-- Minimalist Page Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 fw-semibold text-dark mb-1">@yield('page-title', 'Dashboard')</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}" class="text-decoration-none text-muted">
                                        <i class="bi bi-house me-1"></i>Home
                                    </a>
                                </li>
                                @yield('breadcrumb')
                            </ol>
                        </nav>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="d-none d-md-flex gap-2">
                        @yield('quick-actions')
                    </div>
                </div>
                
                <!-- Content Area -->
                <div class="content-area">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    <!-- Floating Action Button for Quick Add -->
    @if(!request()->is('*/create'))
    <button class="fab" onclick="quickAdd()" data-bs-toggle="tooltip" data-bs-placement="left" title="Tambah Data Cepat">
        <i class="bi bi-plus-lg"></i>
    </button>
    @endif

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="position-fixed top-0 start-0 w-100 h-100 d-none" style="background: rgba(255,255,255,0.9); z-index: 9999;">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="text-center">
                <div class="loading-spinner mb-3"></div>
                <p class="text-muted">Memuat data...</p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        // Quick Add Function
        function quickAdd() {
            const currentPath = window.location.pathname;
            let createUrl = '/employees/create'; // default
            
            if (currentPath.includes('departments')) {
                createUrl = '/departments/create';
            } else if (currentPath.includes('positions')) {
                createUrl = '/positions/create';
            } else if (currentPath.includes('attendance')) {
                createUrl = '/attendance/create';
            } else if (currentPath.includes('salaries')) {
                createUrl = '/salaries/create';
            }
            
            window.location.href = createUrl;
        }

        // Show loading overlay for form submissions
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    document.getElementById('loadingOverlay').classList.remove('d-none');
                });
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add hover effects to cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-4px)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>

    @yield('scripts')
</body>
</html>