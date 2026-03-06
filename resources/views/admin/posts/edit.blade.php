@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="card col-md-8 mx-auto shadow border-0">
        <div class="card-header bg-warning text-dark fw-bold">
            <i class="fas fa-edit me-2"></i> Edit Berita
        </div>
        <div class="card-body p-4">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Artikel</label>
                    <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Kategori</label>
                        <select name="category" class="form-select" required>
                            <option value="berita" {{ $post->category == 'berita' ? 'selected' : '' }}>Berita Umum</option>
                            <option value="pengumuman" {{ $post->category == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                            <option value="agenda" {{ $post->category == 'agenda' ? 'selected' : '' }}>Agenda Kegiatan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Ganti Gambar (Opsional)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        @if($post->image)
                            <small class="d-block mt-1 text-success">Gambar saat ini ada.</small>
                        @endif
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Isi Berita</label>
                    <textarea name="content" class="form-control" rows="10" required>{{ $post->content }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('posts.index') }}" class="btn btn-light border">Batal</a>
                    <button type="submit" class="btn btn-primary fw-bold px-4">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection