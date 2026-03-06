@extends('layouts.main')

@section('title', $post->title)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-success">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="/berita" class="text-decoration-none text-success">Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Baca</li>
                </ol>
            </nav>

            <h1 class="fw-bold mb-3">{{ $post->title }}</h1>
            <div class="text-muted mb-4">
                <i class="far fa-calendar-alt me-1"></i> {{ $post->created_at->format('d M Y') }} 
                | <i class="fas fa-tag me-1"></i> {{ ucfirst($post->category) }}
            </div>

            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded shadow mb-4 w-100" alt="{{ $post->title }}">
            @endif

            <div class="article-content lh-lg">
                {!! nl2br(e($post->content)) !!}
            </div>

            <hr class="my-5">
            <a href="/" class="btn btn-outline-success"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection