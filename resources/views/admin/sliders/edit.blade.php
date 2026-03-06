@extends('layouts.main')
@section('title', 'Edit Banner')
@section('content')
<div class="container py-5">
    <div class="card col-md-6 mx-auto shadow">
        <div class="card-header bg-warning text-dark fw-bold">Edit Banner</div>
        <div class="card-body">
            <form action="{{ route('sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                
                <div class="mb-3">
                    <label class="fw-bold">Ganti Gambar (Opsional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                    @if($slider->image)
                        <img src="{{ asset('storage/'.$slider->image) }}" width="100" class="mt-2 rounded shadow-sm">
                    @endif
                </div>
                
                <div class="mb-3">
                    <label class="fw-bold">Judul Slide (Opsional)</label>
                    <input type="text" name="title" class="form-control" value="{{ $slider->title }}">
                </div>
                
                <div class="mb-3">
                    <label class="fw-bold">Deskripsi Singkat (Opsional)</label>
                    <textarea name="description" class="form-control" rows="3">{{ $slider->description }}</textarea>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('sliders.index') }}" class="btn btn-secondary">Batal</a>
                    <button class="btn btn-primary">Update Banner</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection