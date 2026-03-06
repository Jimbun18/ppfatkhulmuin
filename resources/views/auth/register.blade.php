@extends('layouts.main')

@section('title', 'Daftar Akun')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg overflow-hidden rounded-4">
                <div class="row g-0">
                    
                    <div class="col-md-6 bg-white p-5 order-2 order-md-1">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold text-nu">Buat Akun Baru</h3>
                            <p class="text-muted small">Langkah awal mendaftar sebagai Calon Santri</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama Lengkap">
                                <label for="name">Nama Lengkap</label>
                                @error('name')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                                <label for="email">Alamat Email</label>
                                @error('email')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <div class="form-floating flex-grow-1">
                                    <input type="password" class="form-control border-end-0 @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password" placeholder="Password">
                                    <label for="password">Kata Sandi (Min 8 Karakter)</label>
                                </div>
                                <span class="input-group-text bg-white border-start-0" style="cursor: pointer;" onclick="togglePassword('password', this)">
                                    <i class="fas fa-eye text-muted"></i>
                                </span>
                                @error('password')
                                    <div class="invalid-feedback d-block"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div class="input-group mb-4">
                                <div class="form-floating flex-grow-1">
                                    <input type="password" class="form-control border-end-0" id="password-confirm" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi Password">
                                    <label for="password-confirm">Ulangi Kata Sandi</label>
                                </div>
                                <span class="input-group-text bg-white border-start-0" style="cursor: pointer;" onclick="togglePassword('password-confirm', this)">
                                    <i class="fas fa-eye text-muted"></i>
                                </span>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-warning text-dark py-3 fw-bold shadow-sm">
                                    <i class="fas fa-user-plus me-2"></i> DAFTAR AKUN
                                </button>
                            </div>

                            <hr class="my-4 border-secondary opacity-10">

                            <div class="text-center small">
                                Sudah punya akun? 
                                <a href="{{ route('login') }}" class="fw-bold text-success text-decoration-none">Masuk disini</a>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center text-center p-5 order-1 order-md-2"
                         style="background: linear-gradient(135deg, #004d26 0%, #008f39 100%);">
                        <div class="text-white">
                            <div class="mb-4">
                                <i class="fas fa-quran fa-4x text-warning bg-white rounded-circle p-3 shadow"></i>
                            </div>
                            <h3 class="fw-bold font-serif mb-3">Generasi Qur'ani</h3>
                            <p class="opacity-75 px-4 fst-italic">
                                "Barangsiapa yang menempuh jalan untuk menuntut ilmu, maka Allah akan mudahkan baginya jalan menuju surga."
                            </p>
                            <small class="mt-3 d-block text-warning fw-bold">(HR. Muslim)</small>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId, iconSpan) {
        const input = document.getElementById(fieldId);
        const icon = iconSpan.querySelector('i');
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endsection