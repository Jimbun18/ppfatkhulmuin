@extends('layouts.main')
@section('title', 'Tambah Banner')
@section('content')
<div class="container py-5">
    <div class="card col-md-6 mx-auto shadow">
        <div class="card-header bg-primary text-white fw-bold">Tambah Banner Baru</div>
        <div class="card-body">
            <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="fw-bold">Upload Gambar</label>
                    <input type="file" name="image" class="form-control" required accept="image/*">
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Judul Slide (Opsional)</label>
                    <input type="text" name="title" class="form-control" placeholder="Contoh: Membangun Generasi Beradab">
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Deskripsi Singkat (Opsional)</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Contoh: Pondok Pesantren modern berhaluan..."></textarea>
                </div>
                <button class="btn btn-success w-100">Simpan Banner</button>
            </form>
        </div>
    </div>
</div>
@endsection