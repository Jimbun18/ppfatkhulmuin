@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Manajemen Berita & Artikel</h3>
        <a href="{{ route('posts.create') }}" class="btn btn-primary fw-bold">
            <i class="fas fa-plus me-2"></i> Tulis Berita
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                        <tr>
                            <td>
                                @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" width="60" class="rounded object-fit-cover">
                                @else
                                    <span class="badge bg-secondary">No Image</span>
                                @endif
                            </td>
                            <td class="fw-bold">{{ Str::limit($post->title, 40) }}</td>
                            <td>
                                @if($post->category == 'berita')
                                    <span class="badge bg-success">Berita</span>
                                @elseif($post->category == 'pengumuman')
                                    <span class="badge bg-warning text-dark">Pengumuman</span>
                                @else
                                    <span class="badge bg-info">Agenda</span>
                                @endif
                            </td>
                            <td>{{ $post->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus berita ini?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada berita yang ditulis.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection