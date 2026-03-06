@extends('layouts.main')

@section('title', 'Data Pendaftar')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold text-nu">Manajemen Pendaftaran</h3>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div class="card shadow border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Asal Sekolah</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendaftar as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $row->nama_lengkap }}</strong><br>
                                <small class="text-muted">NIK: {{ $row->nik }}</small>
                            </td>
                            <td>{{ $row->asal_sekolah }}</td>
                            <td>{{ $row->created_at->format('d M Y') }}</td>
                            <td>
                                @if($row->status == 'menunggu')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @elseif($row->status == 'diterima')
                                    <span class="badge bg-success">Diterima</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.show', $row->id) }}" class="btn btn-info btn-sm text-white">
                                    <i class="fas fa-eye"></i> Detail & Verifikasi
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection