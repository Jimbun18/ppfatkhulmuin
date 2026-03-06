@extends('layouts.main')

@section('title', 'Kelola Profil & Sejarah')

@section('content')
<div class="container py-5">
    <h3 class="mb-4 fw-bold text-nu border-start border-4 border-warning ps-3">Edit Profil Website</h3>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($sections as $sec)
        <div class="col-md-12 mb-4">
            <div class="card shadow border-0">
                <div class="card-header text-white fw-bold d-flex justify-content-between align-items-center
    {{ $sec->key == 'sambutan' ? 'bg-success' : ($sec->key == 'misi' ? 'bg-dark' : 'bg-primary') }}">
    
    <span class="text-uppercase">
        @if($sec->key == 'about') <i class="fas fa-history me-2"></i> SEJARAH PONDOK
        @elseif($sec->key == 'identitas') <i class="fas fa-globe me-2"></i> IDENTITAS WEBSITE
        @elseif($sec->key == 'visi') <i class="fas fa-eye me-2"></i> VISI PONDOK
        @elseif($sec->key == 'misi') <i class="fas fa-bullseye me-2"></i> MISI PONDOK
        @elseif($sec->key == 'kepengurusan_putra') <i class="fas fa-male me-2"></i> PENGURUS PUTRA
        @elseif($sec->key == 'kepengurusan_putri') <i class="fas fa-female me-2"></i> PENGURUS PUTRI
        @elseif($sec->key == 'rekening_1') <i class="fas fa-money-check-alt me-2"></i> REKENING DONASI 1
        @elseif($sec->key == 'rekening_2') <i class="fas fa-money-check-alt me-2"></i> REKENING DONASI 2
        @else {{ strtoupper($sec->key) }}
        @endif
    </span>
</div>
                
                <div class="card-body">
                    <form action="{{ route('sections.update', $sec->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        
                        <div class="mb-3">
                            <label class="fw-bold">Judul Bagian</label>
                            <input type="text" name="title" class="form-control" value="{{ $sec->title }}">
                        </div>
                        
                        <div class="mb-3">
                            <label class="fw-bold">Isi Konten</label>
                            <textarea name="content" class="form-control" rows="5" required>{{ $sec->content }}</textarea>
                            @if($sec->key == 'rekening_1' || $sec->key == 'rekening_2')
                                <small class="text-danger fw-bold">PENTING: Gunakan tanda garis lurus (|) untuk memisahkan Nomor Rekening dan Atas Nama. Contoh: 1234567890|A.N Pesantren</small>
                            @else
                                <small class="text-muted">Gunakan Enter untuk baris baru.</small>
                            @endif
                        </div>

                        @if($sec->key == 'kepengurusan_putra' || $sec->key == 'kepengurusan_putri')
                            <small class="text-primary fw-bold">Format: <b>Jabatan : Nama 1, Nama 2</b> (Pisahkan dengan Titik Dua. Enter untuk jabatan baru).</small>
                        @endif
                        
                        @if(in_array($sec->key, ['sambutan', 'identitas', 'about']))
                        <div class="mb-3 p-3 bg-light rounded border">
                            <label class="fw-bold">
                                <i class="fas fa-image me-1"></i> 
                                @if($sec->key == 'identitas') Upload Logo Website
                                @elseif($sec->key == 'about') Upload Foto Sejarah
                                @else Foto Pengasuh
                                @endif
                            </label>
                            
                            <div class="d-flex align-items-center gap-3 mt-2">
                                @if($sec->image)
                                    <div class="text-center">
                                        <img src="{{ asset('storage/'.$sec->image) }}" width="80" class="rounded border shadow-sm bg-white p-1" style="object-fit: contain;">
                                        <div class="small text-muted mt-1" style="font-size: 0.7rem;">Saat Ini</div>
                                    </div>
                                @endif
                                
                                <div class="w-100">
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="text-end">
                            <button class="btn btn-primary fw-bold px-4">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection