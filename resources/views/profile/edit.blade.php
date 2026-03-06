@extends('layouts.main')

@section('title', 'Pengaturan Akun')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-nu">Pengaturan Akun</h3>
        <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('home') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white fw-bold py-3 border-bottom-0">
                    <i class="fas fa-user-edit text-primary me-2"></i> Edit Data Diri
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf @method('PUT')

                        <div class="mb-3">
                            <label class="form-label small text-muted fw-bold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small text-muted fw-bold">Alamat Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        @if($user->role == 'santri')
                        <div class="mb-3">
                            <label class="form-label small text-muted fw-bold">Nomor WhatsApp / Telepon</label>
                            <input type="number" name="no_hp" class="form-control" value="{{ old('no_hp', $pendaftar->no_hp_wali ?? '') }}" placeholder="08xxxxx">
                            <small class="text-muted d-block mt-1">Nomor ini digunakan untuk info dari pondok.</small>
                        </div>
                        @endif

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary fw-bold px-4">Simpan Profil</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white fw-bold py-3 border-bottom-0">
                    <i class="fas fa-key text-warning me-2"></i> Ganti Kata Sandi
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf @method('PUT')

                        <div class="mb-3">
                            <label class="form-label small text-muted fw-bold">Kata Sandi Saat Ini</label>
                            <div class="input-group">
                                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" id="current_pass" required>
                                <span class="input-group-text bg-light" onclick="togglePass('current_pass')" style="cursor: pointer;"><i class="fas fa-eye text-muted"></i></span>
                            </div>
                            @error('current_password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label small text-muted fw-bold">Kata Sandi Baru</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="new_pass" required>
                                <span class="input-group-text bg-light" onclick="togglePass('new_pass')" style="cursor: pointer;"><i class="fas fa-eye text-muted"></i></span>
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label small text-muted fw-bold">Ulangi Sandi Baru</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" class="form-control" id="confirm_pass" required>
                                <span class="input-group-text bg-light" onclick="togglePass('confirm_pass')" style="cursor: pointer;"><i class="fas fa-eye text-muted"></i></span>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-warning text-dark fw-bold px-4">Update Sandi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function togglePass(id) {
        var x = document.getElementById(id);
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
@endsection