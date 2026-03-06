@extends('layouts.main')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow border-0">
                <div class="card-header bg-nu text-white">Tambah Jadwal</div>
                <div class="card-body">
                    <form action="{{ route('schedules.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Waktu</label>
                            <input type="text" name="time" class="form-control" placeholder="07.00 - 08.00" required>
                        </div>
                        <div class="mb-3">
                            <label>Kegiatan</label>
                            <input type="text" name="activity" class="form-control" placeholder="Sholat Dhuha" required>
                        </div>
                        <button class="btn btn-success w-100">Tambah Jadwal</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="table-dark"><tr><th>Waktu</th><th>Kegiatan</th><th>Aksi</th></tr></thead>
                        <tbody>
                            @foreach($schedules as $s)
                            <tr>
                                <td class="fw-bold">{{ $s->time }}</td>
                                <td>{{ $s->activity }}</td>
                                <td>
                                    <form action="{{ route('schedules.destroy', $s->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm px-3" onclick="return confirm('Hapus?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection