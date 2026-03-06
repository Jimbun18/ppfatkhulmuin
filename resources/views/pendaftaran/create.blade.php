@extends('layouts.main')

@section('title', 'Pendaftaran Santri Baru')

@section('content')
<div class="container py-5">
    <div class="row g-5">
        
        <div class="col-lg-5" data-aos="fade-right">
            <h2 class="fw-bold text-nu mb-3">Penerimaan Santri Baru (PSB)</h2>
            <p class="text-muted lh-lg mb-4">
                Bergabunglah menjadi bagian dari keluarga besar Fatkhul Mu'in. Kuota terbatas untuk menjaga kualitas pendidikan.
            </p>

            <div class="card border-0 shadow-sm rounded-4 mb-4 border-start border-4 border-warning bg-light">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Syarat Dokumen:</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Scan Kartu Keluarga (KK) & Akta</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Scan Ijazah Terakhir (Jika ada)</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Pas Foto 3x4 (Warna)</li>
                    </ul>
                </div>
            </div>

            <div class="card border-0 shadow rounded-4 bg-nu text-white overflow-hidden">
                <div class="card-body p-4 position-relative">
                    <div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
                    
                    <h5 class="fw-bold">Butuh Bantuan?</h5>
                    <p class="small opacity-75 mb-4">Hubungi Panitia PSB jika mengalami kendala saat mengisi formulir.</p>
                    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success w-100 fw-bold border-0 shadow-sm">
                        <i class="fab fa-whatsapp me-2"></i> Chat Panitia
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-7" data-aos="fade-left">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-5">
                    <h4 class="fw-bold mb-4 text-nu">Formulir Pendaftaran Online</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control bg-light border-0 py-3" placeholder="Sesuai Ijazah" value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">NIK / NISN</label>
                                <input type="number" name="nik" class="form-control bg-light border-0 py-3" placeholder="16 digit NIK" value="{{ old('nik') }}" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control bg-light border-0 py-3" value="{{ old('tempat_lahir') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control bg-light border-0 py-3" value="{{ old('tanggal_lahir') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select bg-light border-0 py-3" required>
                                <option value="">- Pilih -</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control bg-light border-0 py-3" rows="3" placeholder="Nama Jalan, RT/RW, Desa, Kecamatan..." required>{{ old('alamat') }}</textarea>
                        </div>

                        <hr class="my-4 border-secondary opacity-10">

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Nama Wali / Ayah Kandung</label>
                                <input type="text" name="nama_wali" class="form-control bg-light border-0 py-3" value="{{ old('nama_wali') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">No. HP / WhatsApp Wali</label>
                                <input type="number" name="no_hp_wali" class="form-control bg-light border-0 py-3" placeholder="08xxxxxxxx" value="{{ old('no_hp_wali') }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" class="form-control bg-light border-0 py-3" placeholder="Contoh: SMPN 1 Maju Jaya" value="{{ old('asal_sekolah') }}" required>
                        </div>

                        <div class="alert alert-warning d-flex align-items-center mb-4 border-0 shadow-sm" role="alert">
                            <i class="fas fa-file-upload me-3 fs-4"></i>
                            <div class="small">
                                Silakan upload <strong>Scan KK</strong> dan <strong>Pas Foto</strong>. <br>
                                Format: JPG/PNG, Maksimal 2MB.
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Upload KK</label>
                                <input type="file" name="file_kk" class="form-control" accept="image/*" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Upload Pas Foto</label>
                                <input type="file" name="file_foto" class="form-control" accept="image/*" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-nu w-100 py-3 fw-bold shadow">
                            <i class="fas fa-paper-plane me-2"></i> Kirim Formulir Pendaftaran
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection