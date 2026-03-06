@extends('layouts.main')

@section('title', 'Sejarah Pondok')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="text-center mb-5" data-aos="fade-down">
                <small class="text-success fw-bold text-uppercase ls-1">PROFIL PONDOK</small>
                <h2 class="fw-bold text-nu display-5">{{ $sejarah->title ?? 'Sejarah Pondok Pesantren' }}</h2>
                <div style="width: 80px; height: 4px; background: #ffc107; margin: 15px auto;"></div>
            </div>

            @if($sejarah->image)
            <div class="mb-5 text-center" data-aos="zoom-in">
                <img src="{{ asset('storage/' . $sejarah->image) }}" class="img-fluid rounded-4 shadow-lg w-100" style="max-height: 500px; object-fit: cover;" alt="Sejarah Pondok">
                <small class="text-muted d-block mt-2 fst-italic">Dokumentasi Sejarah Pondok Pesantren</small>
            </div>
            @endif

            <div class="bg-white p-5 rounded-4 shadow-sm border-start border-5 border-success" data-aos="fade-up">
                <div class="lead text-dark lh-lg text-justify" style="font-size: 1.1rem;">
                    {!! nl2br(e($sejarah->content)) !!}
                </div>
            </div>

            <div class="mt-5 text-center">
                <a href="/" class="btn btn-outline-success rounded-pill px-4 fw-bold">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection