@extends('layouts.main')

@section('title', 'Detail Santri')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header bg-nu text-white fw-bold">Data Diri Santri</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr><th width="30%">Nama Lengkap</th><td>{{ $data->nama_lengkap }}</td></tr>
                        <tr><th>NIK</th><td>{{ $data->nik }}</td></tr>
                        <tr><th>TTL</th><td>{{ $data->tempat_lahir }}, {{ $data->tanggal_lahir }}</td></tr>
                        <tr><th>Jenis Kelamin</th><td>{{ $data->jenis_kelamin }}</td></tr>
                        <tr><th>Alamat</th><td>{{ $data->alamat }}</td></tr>
                        <tr><th>Nama Wali</th><td>{{ $data->nama_wali }}</td></tr>
                        <tr><th>No HP Wali</th><td>{{ $data->no_hp_wali }}</td></tr>
                        <tr><th>Asal Sekolah</th><td>{{ $data->asal_sekolah }}</td></tr>
                    </table>
                </div>
            </div>
            
            <div class="card shadow">
                <div class="card-header bg-secondary text-white fw-bold">Berkas Lampiran</div>
                <div class="card-body d-flex gap-3">
                    <div class="text-center border p-2 rounded">
                        <p class="fw-bold mb-1">Kartu Keluarga</p>
                        <a href="{{ asset('storage/'.$data->file_kk) }}" target="_blank">
                            <img src="{{ asset('storage/'.$data->file_kk) }}" height="100" class="rounded">
                        </a>
                        <br>
                        <small>Klik untuk perbesar</small>
                    </div>
                    <div class="text-center border p-2 rounded">
                        <p class="fw-bold mb-1">Pas Foto</p>
                        <a href="{{ asset('storage/'.$data->file_foto) }}" target="_blank">
                            <img src="{{ asset('storage/'.$data->file_foto) }}" height="100" class="rounded">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow border-0 bg-light">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Status Pendaftaran</h5>
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="alert {{ $data->status == 'diterima' ? 'alert-success' : ($data->status == 'ditolak' ? 'alert-danger' : 'alert-warning') }} text-center">
                        <h4 class="fw-bold text-uppercase mb-0">{{ $data->status }}</h4>
                    </div>

                    <hr>
                    <form action="{{ route('admin.verifikasi', $data->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="fw-bold">Ubah Status:</label>
                            <select name="status" class="form-select mb-2" required>
                                <option value="menunggu" {{ $data->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="diterima" {{ $data->status == 'diterima' ? 'selected' : '' }}>Terima Santri</option>
                                <option value="ditolak" {{ $data->status == 'ditolak' ? 'selected' : '' }}>Tolak Pendaftaran</option>
                            </select>
                            
                            <textarea name="catatan" class="form-control" placeholder="Catatan jika ditolak (Opsional)" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection