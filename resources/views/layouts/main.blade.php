<?php
    // Ambil data identitas website dari database
    $identitas = \App\Models\Section::where('key', 'identitas')->first();
    $logo = $identitas && $identitas->image ? asset('storage/' . $identitas->image) : 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Nahdlatul_Ulama_Logo_Vector.svg/1200px-Nahdlatul_Ulama_Logo_Vector.svg.png';
    $nama_pondok = $identitas->title ?? "PP Fatkhul Mu'in";
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - PP Fatkhul Mu'in</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --nu-dark: #004d26; /* Hijau Tua NU */
            --nu-green: #008f39; /* Hijau Standar */
            --nu-gold: #ffc107; /* Kuning Emas */
        }
        body { font-family: 'Poppins', sans-serif; color: #333; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Merriweather', serif; }
        
        /* Utility Colors */
        .text-nu { color: var(--nu-dark) !important; }
        .bg-nu { background-color: var(--nu-dark) !important; }
        .btn-nu { background-color: var(--nu-dark); color: white; border-radius: 50px; padding: 10px 25px; }
        .btn-nu:hover { background-color: var(--nu-green); color: white; }
        .btn-outline-nu { border: 2px solid var(--nu-dark); color: var(--nu-dark); border-radius: 50px; padding: 10px 25px; }
        .btn-outline-nu:hover { background-color: var(--nu-dark); color: white; }

        /* Navbar Styling */
        .navbar { padding: 15px 0; background: white; transition: 0.3s; }
        .navbar-brand img { height: 50px; }
        .nav-link { font-weight: 500; color: #555 !important; margin: 0 10px; }
        .nav-link:hover, .nav-link.active { color: var(--nu-green) !important; }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: var(--nu-dark); border-radius: 5px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top shadow-sm bg-white">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ $logo }}" alt="Logo" height="45" class="me-2" style="object-fit: contain;">
            <div class="d-flex flex-column">
                <span class="fw-bold text-nu" style="font-family: 'Merriweather', serif; font-size: 1.1rem; line-height: 1.2;">PP Fatkhul Mu'in</span>
                <span class="text-muted" style="font-size: 0.65rem; letter-spacing: 1px;">AHLUSSUNNAH WAL JAMAAH</span>
            </div>
        </a>

        <button class="navbar-toggler border-0 me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto my-2 my-lg-0">
                <li class="nav-item"><a class="nav-link" href="/#hero">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="/#tentang">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="/#program">Program</a></li>
                <li class="nav-item"><a class="nav-link" href="/#kepengurusan">Pengurus</a></li>
                <li class="nav-item"><a class="nav-link" href="/#jadwal">Jadwal</a></li>
                <li class="nav-item"><a class="nav-link" href="/#berita">Berita</a></li>
                
                <li class="nav-item d-lg-none mt-3 border-top pt-3">
                    <a class="nav-link fw-bold text-success" href="{{ route('donasi') }}">
                        <i class="fas fa-heart me-2"></i> Donasi
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                
                <a href="{{ route('donasi') }}" class="btn btn-outline-nu btn-sm fw-bold d-none d-lg-flex align-items-center">
                    <i class="fas fa-heart me-2"></i> Donasi
                </a>

                @auth
                    <div class="dropdown ms-1">
                        <button class="btn btn-nu btn-sm fw-bold dropdown-toggle d-flex align-items-center" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-2"></i> {{ Str::limit(Auth::user()->name, 10) }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2" aria-labelledby="userMenu">
                            <li>
                                @if(Auth::user()->role == 'admin')
                                    <a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-2 text-warning"></i> Dashboard Admin
                                    </a>
                                @else
                                    <a class="dropdown-item py-2" href="{{ route('home') }}">
                                        <i class="fas fa-user me-2 text-warning"></i> Dashboard Santri
                                    </a>
                                @endif
                            </li>
                            
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-cog me-2 text-secondary"></i> Pengaturan Akun
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger fw-bold py-2" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i> Keluar
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-link text-decoration-none text-secondary fw-bold btn-sm">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-nu btn-sm fw-bold shadow-sm px-3">Daftar Online</a>
                @endauth

            </div>
        </div>
    </div>
</nav>
    
    <div style="height: 80px;"></div>

    @yield('content')

    <footer class="text-white pt-5 pb-3" style="background-color: var(--nu-dark); border-top: 5px solid var(--nu-gold);">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4" data-aos="fade-right">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-white p-2 rounded-circle me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                        <img src="{{ $logo }}" alt="Logo" width="30" style="object-fit: contain;">
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-warning" style="font-family: 'Merriweather', serif;">PP Fatkhul Mu'in</h5>
                        <small class="text-white-50">Ahlussunnah wal Jama'ah</small>
                    </div>
                </div>
                <p class="text-white-50 mb-4 lh-sm small">
                    Lembaga pendidikan Islam yang mencetak kader ulama dan intelektual muslim yang berakhlakul karimah, berwawasan luas, dan mengabdi untuk agama, nusa, dan bangsa.
                </p>
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-success btn-sm rounded-circle" style="width: 35px; height: 35px;"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/ponpesfatkhulmuin_?igsh=aDRvN29tZm5xeWJ0" class="btn btn-success btn-sm rounded-circle" style="width: 35px; height: 35px;"><i class="fab fa-instagram"></i></a>
                    <a href="https://youtube.com/@fatkhulmuinpwt?si=Gp_BR9tnFzYmxl-5" class="btn btn-success btn-sm rounded-circle" style="width: 35px; height: 35px;"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="col-lg-4 mb-4 ps-lg-5" data-aos="fade-up">
                <h5 class="fw-bold text-warning mb-4">HUBUNGI KAMI</h5>
                <ul class="list-unstyled text-white-50 small">
                    <li class="mb-3 d-flex">
                        <i class="fas fa-map-marker-alt text-warning me-3 mt-1"></i>
                        <span>Jln. Gg. Gagak Rt 2/2 Dusun Brubahan, Karangsalam Kidul, Kedungbanteng, Banyumas, Jawa Tengah.</span>
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="fas fa-phone-alt text-warning me-3 mt-1"></i>
                        <span>085727777834 (Sekretariat)</span>
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="fas fa-envelope text-warning me-3 mt-1"></i>
                        <span>fathulmuin284@gmail.com</span>
                    </li>
                </ul>
            </div>

            <div class="col-lg-4 mb-4" data-aos="fade-left">
                <h5 class="fw-bold text-warning mb-4">LOKASI</h5>
                <div class="rounded-3 overflow-hidden border border-2 border-success shadow-sm position-relative group-hover">
                    <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" class="w-100" style="height: 150px; object-fit: cover; filter: brightness(0.8);">
                    
                    <a href="https://maps.app.goo.gl/Zx76TjGebkbnMr1bA " target="_blank" class="position-absolute top-50 start-50 translate-middle btn btn-light btn-sm fw-bold shadow">
                        <i class="fas fa-map-marked-alt me-2 text-success"></i> Buka Google Maps
                    </a>
                </div>
            </div>
        </div>

        <hr class="border-secondary opacity-25 my-4">

        <div class="row align-items-center small text-white-50">
            <div class="col-md-6 text-center text-md-start">
                &copy; {{ date('Y') }} Pondok Pesantren Fatkhul Mu'in. All rights reserved.
            </div>
            <div class="col-md-6 text-center text-md-end">
                Didesain dengan <i class="fas fa-heart text-danger mx-1"></i> oleh Tim IT Santri
            </div>
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script> AOS.init({ once: true, offset: 120 }); </script>
</body>