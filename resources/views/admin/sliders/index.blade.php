@extends('layouts.main')

@section('title', 'Manajemen Slider')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between mb-4">
        <h3>Manajemen Banner / Slider</h3>
        <a href="{{ route('sliders.create') }}" class="btn btn-primary fw-bold">+ Tambah Banner</a>
    </div>

    <div class="row">
        @foreach($sliders as $slider)
        <div class="col-md-4 mb-3">
            <div class="card shadow">
                <img src="{{ asset('storage/' . $slider->image) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $slider->title ?? 'Tanpa Judul' }}</h5>
                    <td>
                    <a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-warning btn-sm me-1"><i class="fas fa-edit"></i> Edit</a>
                    
                    <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus banner ini?')"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                </td>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection