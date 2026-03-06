@extends('layouts.main')

@section('title', 'Masuk Aplikasi')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg overflow-hidden rounded-4">
                <div class="row g-0">
                    <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center text-center p-5" 
                         style="background: linear-gradient(135deg, #004d26 0%, #008f39 100%);">
                        <div class="text-white">
                            <?php 
                                $identitas = \App\Models\Section::where('key', 'identitas')->first();
                                $logo = $identitas && $identitas->image ? asset('storage/' . $identitas->image) : 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Nahdlatul_Ulama_Logo_Vector.svg/1200px-Nahdlatul_Ulama_Logo_Vector.svg.png';
                            ?>
                            <img src="{{ $logo }}" width="100" class="mb-4 drop-shadow bg-white rounded-circle p-2" style="object-fit: contain;">
                            <h3 class="fw-bold font-serif mb-2">Ahlan Wa Sahlan</h3>
                            <p class="opacity-75 small px-4">
                                Silakan masuk untuk mengakses layanan akademik dan pendaftaran santri di PP Fathul Mu'in.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 bg-white p-5">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold text-nu">Masuk Akun</h3>
                            <p class="text-muted small">Masukkan email dan kata sandi Anda</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                <label for="email">Alamat Email</label>
                                @error('email')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <div class="form-floating flex-grow-1">
                                    <input type="password" class="form-control border-end-0 @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password" placeholder="Password">
                                    <label for="password">Kata Sandi</label>
                                </div>
                                <span class="input-group-text bg-white border-start-0" style="cursor: pointer;" onclick="togglePassword('password', this)">
                                    <i class="fas fa-eye text-muted"></i>
                                </span>
                                @error('password')
                                    <div class="invalid-feedback d-block"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="text-decoration-none small text-success fw-bold" href="{{ route('password.request') }}">
                                        Lupa Sandi?
                                    </a>
                                @endif
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-nu py-3 fw-bold shadow-sm">
                                    MASUK SEKARANG <i class="fas fa-sign-in-alt ms-2"></i>
                                </button>
                            </div>

                            <hr class="my-4 border-secondary opacity-10">

                            <div class="text-center small">
                                Belum punya akun? 
                                <a href="{{ route('register') }}" class="fw-bold text-success text-decoration-none">Daftar Akun Baru</a>
                            </div>
                        </form>
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