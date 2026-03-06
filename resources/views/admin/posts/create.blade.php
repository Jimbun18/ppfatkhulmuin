@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="card col-md-8 mx-auto shadow border-0">
        <div class="card-header bg-nu text-white fw-bold">
            <i class="fas fa-pen-nib me-2"></i> Tulis Berita Baru
        </div>
        <div class="card-body p-4">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Artikel</label>
                    <input type="text" name="title" class="form-control" placeholder="Contoh: Juara 1 Lomba MQK Nasional" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Kategori</label>
                        <select name="category" class="form-select" required>
                            <option value="berita">Berita Umum</option>
                            <option value="pengumuman">Pengumuman</option>
                            <option value="agenda">Agenda Kegiatan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Gambar Utama (Thumbnail)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Format: JPG/PNG, Max 2MB</small>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Isi Berita</label>
                    <textarea name="content" class="form-control" rows="10" placeholder="Tulis isi berita di sini..." required></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('posts.index') }}" class="btn btn-light border">Batal</a>
                    <button type="submit" class="btn btn-success fw-bold px-4">Terbitkan Berita</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection