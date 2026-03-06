@extends('layouts.main')

@section('title', 'Kabar Pesantren')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-nu">Kabar Pesantren</h2>
        <p class="text-muted">Berita, Kegiatan, dan Pengumuman Terbaru</p>
    </div>

    <div class="row">
        @forelse($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100 hover-top">
                <div style="height: 200px; overflow: hidden;" class="rounded-top position-relative">
                    <span class="position-absolute top-0 start-0 bg-warning text-dark fw-bold px-3 py-1 m-2 rounded small">
                        {{ ucfirst($post->category) }}
                    </span>
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $post->title }}">
                    @else
                        <div class="w-100 h-100 bg-secondary d-flex align-items-center justify-content-center text-white">
                            <i class="fas fa-image fa-2x"></i>
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> {{ $post->created_at->format('d M Y') }}</small>
                    <h5 class="card-title mt-2 fw-bold">
                        <a href="{{ route('berita.show', $post->slug) }}" class="text-dark text-decoration-none stretched-link">
                            {{ Str::limit($post->title, 60) }}
                        </a>
                    </h5>
                    <p class="card-text text-muted small">
                        {{ Str::limit(strip_tags($post->content), 100) }}
                    </p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486747.png" width="100" class="mb-3 opacity-25">
            <p class="text-muted">Belum ada berita yang diterbitkan.</p>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection