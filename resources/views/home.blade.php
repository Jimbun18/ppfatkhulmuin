@extends('layouts.main')

@section('title', 'Dashboard Santri')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-secondary">Dashboard Pendaftar</h5>
                </div>
                <div class="card-body text-center p-5">
                    
                    @if (!$pendaftaran)
                        <img src="https://cdn-icons-png.flaticon.com/512/2921/2921222.png" width="150" class="mb-3 opacity-50">
                        <h3>Halo, {{ Auth::user()->name }}!</h3>
                        <p class="text-muted">Anda belum melengkapi formulir pendaftaran.</p>
                        <a href="{{ route('pendaftaran.create') }}" class="btn btn-nu btn-lg mt-3">
                            <i class="fas fa-edit me-2"></i> Isi Formulir Sekarang
                        </a>

                    @else
                        
                        @if($pendaftaran->status == 'menunggu')
                            <div class="display-1 text-warning mb-3"><i class="fas fa-hourglass-half"></i></div>
                            <h2 class="fw-bold">Menunggu Verifikasi</h2>
                            <p class="lead">Data Anda sedang diperiksa oleh panitia. Mohon cek secara berkala.</p>
                            <div class="alert alert-warning d-inline-block mt-2">
                                <i class="fas fa-info-circle"></i> Status: <strong>Sedang Diproses</strong>
                            </div>

                        @elseif($pendaftaran->status == 'diterima')
                            <div class="display-1 text-success mb-3"><i class="fas fa-check-circle"></i></div>
                            <h2 class="fw-bold text-success">SELAMAT!</h2>
                            <p class="lead">Anda dinyatakan <strong>DITERIMA</strong> sebagai santri baru.</p>
                            <a href="#" class="btn btn-outline-success mt-3"><i class="fas fa-print"></i> Cetak Bukti Diterima</a>

                        @elseif($pendaftaran->status == 'ditolak')
                            <div class="display-1 text-danger mb-3"><i class="fas fa-times-circle"></i></div>
                            <h2 class="fw-bold text-danger">Mohon Maaf</h2>
                            <p class="lead">Pendaftaran Anda belum dapat kami terima.</p>
                            <p class="text-muted">Alasan: {{ $pendaftaran->catatan_admin ?? 'Tidak memenuhi syarat administrasi.' }}</p>
                        @endif

                        <hr class="my-4">
                        <div class="text-start bg-light p-3 rounded">
                            <h6 class="fw-bold">Data Anda:</h6>
                            <ul class="mb-0 list-unstyled">
                                <li><strong>Nama:</strong> {{ $pendaftaran->nama_lengkap }}</li>
                                <li><strong>NIK:</strong> {{ $pendaftaran->nik }}</li>
                                <li><strong>Asal Sekolah:</strong> {{ $pendaftaran->asal_sekolah }}</li>
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection