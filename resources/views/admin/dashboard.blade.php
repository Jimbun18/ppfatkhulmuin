@extends('layouts.main')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container py-5">
    
    <div class="d-flex justify-content-between align-items-center mb-5" data-aos="fade-down">
        <div>
            <h2 class="fw-bold text-nu" style="font-family: 'Merriweather', serif;">Dashboard Admin</h2>
            <p class="text-muted mb-0">Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong>!</p>
        </div>
        <div class="d-none d-md-block text-end">
            <span class="d-block fw-bold text-dark">{{ now()->isoFormat('dddd, D MMMM Y') }}</span>
            <small class="text-muted">Panel Administrator Pesantren</small>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card border-0 shadow rounded-4 overflow-hidden h-100 text-white" 
                 style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-uppercase fw-bold opacity-75 ls-1">Total Pendaftar</h6>
                        <i class="fas fa-users fa-2x opacity-50"></i>
                    </div>
                    <h1 class="display-4 fw-bold mb-0">{{ $totalPendaftar }}</h1>
                    <small class="opacity-75">Calon Santri Masuk</small>
                    
                
                </div>
            </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card border-0 shadow rounded-4 overflow-hidden h-100 text-dark" 
                 style="background: linear-gradient(135deg, #ffc107 0%, #ffca2c 100%);">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-uppercase fw-bold opacity-75 ls-1">Perlu Verifikasi</h6>
                        <i class="fas fa-hourglass-half fa-2x opacity-50"></i>
                    </div>
                    <h1 class="display-4 fw-bold mb-0">{{ $belumVerifikasi }}</h1>
                    <small class="opacity-75">Menunggu Tindakan Admin</small>
                    
                    @if($belumVerifikasi > 0)
                        <a href="{{ route('admin.pendaftar') }}" class="btn btn-light btn-sm fw-bold rounded-pill px-3 mt-3 shadow-sm border-0 position-relative z-1">
                            Proses Data <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card border-0 shadow rounded-4 overflow-hidden h-100 text-white" 
                 style="background: linear-gradient(135deg, #198754 0%, #157347 100%);">
                <div class="card-body p-4 position-relative">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-uppercase fw-bold opacity-75 ls-1">Santri Diterima</h6>
                        <i class="fas fa-user-check fa-2x opacity-50"></i>
                    </div>
                    <h1 class="display-4 fw-bold mb-0">{{ $diterima }}</h1>
                    <small class="opacity-75">Lolos Seleksi Masuk</small>
                    
                    
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <h5 class="fw-bold text-nu mb-3 border-start border-4 border-warning ps-3">Kelola Konten Website</h5>
        <div class="row g-3">
            
            <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="100">
                <a href="{{ route('programs.index') }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-top transition-card">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-graduation-cap fa-2x"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">Program</h6>
                            <small class="text-muted d-block">Pendidikan & Jurusan</small>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="200">
                <a href="{{ route('schedules.index') }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-top transition-card">
                        <div class="card-body text-center p-4">
                            <div class="bg-info bg-opacity-10 text-info rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-clock fa-2x"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">Jadwal</h6>
                            <small class="text-muted d-block">Kegiatan Harian</small>
                        </div>
                    </div>
                </a>
            </div>



            <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="400">
                <a href="{{ route('sliders.index') }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-top transition-card">
                        <div class="card-body text-center p-4">
                            <div class="bg-warning bg-opacity-10 text-warning rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-images fa-2x"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">Banner</h6>
                            <small class="text-muted d-block">Slider Beranda</small>
                        </div>
                    </div>
                </a>
            </div>
            
             <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="500">
                <a href="{{ route('sections.index') }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-top transition-card">
                        <div class="card-body text-center p-4">
                            <div class="bg-secondary bg-opacity-10 text-secondary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-edit fa-2x"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">Profil</h6>
                            <small class="text-muted d-block">Sambutan & Visi Misi</small>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>

    <div class="mt-5">
        <h5 class="fw-bold text-nu mb-3 border-start border-4 border-success ps-3">Manajemen Data & Publikasi</h5>
        <div class="row g-3">
            
            <div class="col-md-6" data-aos="fade-right">
                <a href="{{ route('admin.pendaftar') }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-top transition-card bg-white">
                        <div class="card-body p-4 d-flex align-items-center">
                            <div class="bg-nu text-white rounded-3 p-3 me-3">
                                <i class="fas fa-clipboard-list fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-1">Data Pendaftaran</h5>
                                <p class="text-muted small mb-0">Verifikasi, Terima, atau Tolak calon santri baru.</p>
                            </div>
                            <div class="ms-auto">
                                <i class="fas fa-chevron-right text-muted"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6" data-aos="fade-left">
                <a href="{{ route('posts.index') }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-4 h-100 hover-top transition-card bg-white">
                        <div class="card-body p-4 d-flex align-items-center">
                            <div class="bg-danger text-white rounded-3 p-3 me-3">
                                <i class="fas fa-newspaper fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-1">Berita & Agenda</h5>
                                <p class="text-muted small mb-0">Tulis artikel kegiatan atau pengumuman pondok.</p>
                            </div>
                            <div class="ms-auto">
                                <i class="fas fa-chevron-right text-muted"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>

</div>

<style>
    .hover-top { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-top:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
    .ls-1 { letter-spacing: 1px; }
</style>
@endsection