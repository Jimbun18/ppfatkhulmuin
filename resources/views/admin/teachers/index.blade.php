@extends('layouts.main')

@section('title', 'Manajemen Asatidz')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow border-0">
                <div class="card-header bg-success text-white">Tambah Pengajar</div>
                <div class="card-body">
                    <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Nama Ustadz/Ustadzah</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Jabatan / Posisi</label>
                            <input type="text" name="position" class="form-control" placeholder="Contoh: Pengasuh, Guru Fiqih" required>
                        </div>
                        <div class="mb-3">
                            <label>Foto</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <button class="btn btn-success w-100">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-body">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Foto</th>
                                <th>Nama & Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teachers as $guru)
                            <tr>
                                <td>
                                    @if($guru->image)
                                        <img src="{{ asset('storage/' . $guru->image) }}" width="50" height="50" class="rounded-circle object-fit-cover">
                                    @else
                                        <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 50px; height: 50px;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong class="d-block">{{ $guru->name }}</strong>
                                    <small class="text-muted">{{ $guru->position }}</small>
                                </td>
                                <td>
                                    <form action="{{ route('teachers.destroy', $guru->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center text-muted">Belum ada data pengajar.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection