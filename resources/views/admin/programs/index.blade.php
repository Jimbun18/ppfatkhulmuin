@extends('layouts.main')
@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between mb-4">
        <h3>Kelola Program Pendidikan</h3>
        <a href="{{ route('programs.create') }}" class="btn btn-primary">+ Tambah Program</a>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <thead><tr><th>Ikon</th><th>Judul</th><th>Deskripsi</th><th>Aksi</th></tr></thead>
                <tbody>
                    @foreach($programs as $p)
                    <tr>
                        <td class="text-center"><i class="{{ $p->icon }} fa-2x text-success"></i></td>
                        <td>{{ $p->title }}</td>
                        <td>{{ $p->description }}</td>
                        <td>
                            <a href="{{ route('programs.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('programs.destroy', $p->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection