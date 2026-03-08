@extends('layouts.main')

@section('title', $post->title ?? 'Kabar Pesantren')

@section('content')
<div class="container py-5 mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <a href="/#berita" class="btn btn-sm btn-outline-success rounded-pill mb-4 fw-bold">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>

            <div class="d-flex align-items-center mb-3">
                <span class="badge bg-warning text-dark me-3 px-3 py-2 rounded-pill shadow-sm">{{ strtoupper($post->category) }}</span>
                <small class="text-muted fw-bold">
                    <i class="fas fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d F Y') }}
                </small>
            </div>

            <h1 class="fw-bold mb-4" style="font-family: 'Merriweather', serif; color: #004d40;">
                {{ $post->title }}
            </h1>

            @if($post->image)
            <div class="mb-5 shadow-sm rounded-4 overflow-hidden">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid w-100" style="object-fit: cover; max-height: 500px;">
            </div>
            @endif

            <div class="content-artikel lh-lg fs-6 text-secondary">
                {!! $post->content !!}
            </div>

            <div class="mt-5 pt-4 border-top">
                <p class="fw-bold mb-2">Bagikan kabar ini:</p>
                <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' - ' . url()->current()) }}" target="_blank" class="btn btn-success rounded-circle me-2" style="width: 40px; height: 40px; line-height: 25px;">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-primary rounded-circle" style="width: 40px; height: 40px; line-height: 25px;">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </div>

        </div>
    </div>
</div>
@endsection