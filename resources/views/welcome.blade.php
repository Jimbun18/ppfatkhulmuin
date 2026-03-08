@extends('layouts.main')

@section('title', 'Beranda')

@section('content')

<?php
    // Persiapan Logo
    $identitas = \App\Models\Section::where('key', 'identitas')->first();
    $logo = $identitas && $identitas->image ? asset('storage/' . $identitas->image) : 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Nahdlatul_Ulama_Logo_Vector.svg/1200px-Nahdlatul_Ulama_Logo_Vector.svg.png';
?>

<section id="hero" class="position-relative" style="min-height: 95vh; overflow: hidden;">
    
    @if($sliders->count() > 0)
        <div id="heroCarousel" class="carousel slide carousel-fade position-absolute top-0 start-0 w-100 h-100" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner h-100">
                @foreach($sliders as $key => $slide)
                <div class="carousel-item h-100 {{ $key == 0 ? 'active' : '' }}">
                    
                    <div class="w-100 h-100 position-absolute top-0 start-0">
                        <img src="{{ asset('storage/' . $slide->image) }}" class="w-100 h-100" style="object-fit: cover; filter: blur(3px) brightness(0.4); transform: scale(1.05);"> 
                    </div>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center h-100 pb-5" style="z-index: 10; bottom: 0; left: 0; right: 0;">
                        <div class="container text-center" data-aos="zoom-in">
                            
                            <div class="mb-4 d-inline-block">
                                <img src="{{ $logo }}" width="130" style="object-fit: contain; filter: drop-shadow(0px 4px 8px rgba(0,0,0,0.6));">
                            </div>

                            <h1 class="display-3 fw-bold mb-3 text-white" style="text-shadow: 0 4px 15px rgba(0,0,0,0.6);">
                                {!! $slide->title ? nl2br(e($slide->title)) : 'Membangun Generasi <br> <span class="text-warning">Santri Beradab</span>' !!}
                            </h1>
                            
                            <p class="lead mb-5 px-md-5 mx-md-5 opacity-90 text-light fw-light" style="text-shadow: 0 2px 5px rgba(0,0,0,0.8);">
                                {{ $slide->description ?? "Pondok Pesantren Fathul Mu'in mensinergikan tradisi salafiyah dengan pendidikan modern berhaluan Ahlussunnah wal Jama'ah An-Nahdliyah." }}
                            </p>
                            
                            <div class="d-flex justify-content-center gap-3 flex-wrap">
                                <a href="{{ route('register') }}" class="btn btn-warning btn-lg fw-bold px-5 py-3 rounded-pill text-dark shadow-lg hover-effect"><i class="fas fa-user-plus me-2"></i> Daftar Santri Baru</a>
                                <a href="#program" class="btn btn-outline-light btn-lg fw-bold px-5 py-3 rounded-pill shadow hover-effect backdrop-blur"><i class="fas fa-book-open me-2"></i> Pelajari Program</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            @if($sliders->count() > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" style="z-index: 20;">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" style="z-index: 20;">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
            @endif
        </div>
    @else
        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: radial-gradient(circle at center, #007a33 0%, #004d26 100%);">
             <div class="container position-relative text-center text-white" style="z-index: 10;" data-aos="zoom-in">
                <div class="mb-4 d-inline-block">
                     <img src="{{ $logo }}" width="130" style="object-fit: contain; filter: drop-shadow(0px 4px 8px rgba(0,0,0,0.6));">
                </div>
                <h1 class="display-3 fw-bold mb-3" style="text-shadow: 0 4px 15px rgba(0,0,0,0.6);">
                    Membangun Generasi <br> <span class="text-warning">Santri Beradab</span>
                </h1>
                <p class="lead mb-5 px-md-5 mx-md-5 opacity-90 text-light fw-light">
                    Pondok Pesantren Fathul Mu'in mensinergikan tradisi salafiyah dengan pendidikan modern berhaluan Ahlussunnah wal Jama'ah An-Nahdliyah.
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('register') }}" class="btn btn-warning btn-lg fw-bold px-5 py-3 rounded-pill text-dark shadow-lg hover-effect"><i class="fas fa-user-plus me-2"></i> Daftar Santri Baru</a>
                    <a href="#program" class="btn btn-outline-light btn-lg fw-bold px-5 py-3 rounded-pill shadow hover-effect backdrop-blur"><i class="fas fa-book-open me-2"></i> Pelajari Program</a>
                </div>
            </div>
        </div>
    @endif
    
    <div style="position: absolute; bottom: -1px; left: 0; width: 100%; z-index: 30;">
        <svg viewBox="0 0 1440 320" preserveAspectRatio="none" style="height: 80px; width: 100%;">
            <path fill="#ffffff" fill-opacity="1" d="M0,224L80,213.3C160,203,320,181,480,181.3C640,181,800,203,960,213.3C1120,224,1280,224,1360,224L1440,224L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
        </svg>
    </div>
</section>


<section id="tentang" class="py-5 bg-white position-relative">
    <div class="container py-5">
        
        <div class="row align-items-center mb-5">
            <div class="col-md-6 order-2 order-md-1" data-aos="fade-right">
                <small class="text-success fw-bold text-uppercase ls-1">SEJARAH SINGKAT</small>
                <h2 class="fw-bold display-6 mb-3 text-nu" style="font-family: 'Merriweather', serif;">Profil Pesantren</h2>
                <p class="text-secondary lh-lg text-justify">
                    {{ Str::limit($about->content ?? 'Sejarah pondok belum ditambahkan. Silakan edit di menu admin.', 300) }}
                </p>
                <a href="{{ route('profil.sejarah') }}" class="btn btn-outline-nu rounded-pill mt-2">
                    Baca Sejarah Lengkap <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
            <div class="col-md-6 order-1 order-md-2 mb-4 mb-md-0 text-center" data-aos="zoom-in">
                <div class="position-relative d-inline-block">
                    @if($about && $about->image)
                        <img src="{{ asset('storage/' . $about->image) }}" class="img-fluid rounded-4 shadow-lg" style="max-height: 350px; border: 5px solid white; object-fit: cover;">
                    @else
                        <img src="https://images.unsplash.com/photo-1605634289360-1c05635c9429?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" class="img-fluid rounded-4 shadow-lg" style="max-height: 350px; border: 5px solid white;">
                    @endif
                    <div class="bg-warning position-absolute top-0 start-0 rounded-circle" style="width: 30px; height: 30px; margin-top: -15px; margin-left: -15px;"></div>
                    <div class="bg-success position-absolute bottom-0 end-0 rounded-circle" style="width: 50px; height: 50px; margin-bottom: -25px; margin-right: -25px; z-index: -1;"></div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm bg-light rounded-4 overflow-hidden position-relative hover-top">
                    <div class="position-absolute top-0 end-0 p-3 opacity-25">
                        <i class="fas fa-eye fa-5x text-success"></i>
                    </div>
                    <div class="card-body p-4 position-relative z-1">
                        <h4 class="fw-bold text-nu mb-3"><i class="fas fa-eye text-warning me-2"></i> {{ $visi->title ?? 'Visi' }}</h4>
                        <p class="fs-5 fst-italic text-dark">"{!! nl2br(e($visi->content ?? 'Visi belum diisi.')) !!}"</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm bg-nu text-white rounded-4 overflow-hidden position-relative hover-top">
                     <div class="position-absolute top-0 end-0 p-3 opacity-25">
                        <i class="fas fa-bullseye fa-5x text-white"></i>
                    </div>
                    <div class="card-body p-4 position-relative z-1">
                        <h4 class="fw-bold text-warning mb-3"><i class="fas fa-bullseye me-2"></i> {{ $misi->title ?? 'Misi' }}</h4>
                        <div class="lead lh-lg text-white-50 fs-6">
                            {!! nl2br(e($misi->content ?? 'Misi belum diisi.')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="program" class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-down">
            <small class="text-success fw-bold text-uppercase ls-1">Pendidikan</small>
            <h2 class="fw-bold text-nu display-6 mb-3" style="font-family: 'Merriweather', serif;">Program Pesantren</h2>
            <div style="width: 80px; height: 4px; background: #ffc107; margin: 0 auto;"></div>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($programs as $p)
            <div class="col-md-4" data-aos="fade-up">
                <a href="{{ route('program.show', $p->id) }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm rounded-4 text-center p-4 hover-top transition-card bg-white">
                        <div class="card-body">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="{{ $p->icon }} fa-3x"></i>
                            </div>
                            <h4 class="fw-bold text-dark mb-3">{{ $p->title }}</h4>
                            <p class="text-muted mb-4">{{ $p->description }}</p>
                            
                            <span class="text-success fw-bold small">Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i></span>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center text-muted">Belum ada program yang ditambahkan.</div>
            @endforelse
        </div>
    </div>
</section>


@php
    // Fungsi PHP untuk memecah teks dari Admin menjadi Array rapi
    function parseKepengurusan($text) {
        $lines = explode("\n", str_replace("\r", "", $text ?? ''));
        $inti = []; $seksi = [];
        foreach($lines as $line) {
            if(trim($line) == '') continue;
            $parts = explode(':', $line);
            $role = trim($parts[0] ?? '');
            $names = trim($parts[1] ?? '');

            // Otomatis deteksi: Jika jabatannya ini, masuk ke Pengurus Inti
            $is_inti = in_array(strtolower($role), ['pengasuh', 'penasehat', 'lurah i & ii', 'lurah i', 'lurah ii', 'sekretaris', 'bendahara']);
            
            if($is_inti) { $inti[] = ['role' => $role, 'names' => $names]; } 
            else { $seksi[] = ['role' => $role, 'names' => $names]; }
        }
        return ['inti' => $inti, 'seksi' => $seksi];
    }

    $putra = parseKepengurusan($pengurus_putra->content ?? '');
    $putri = parseKepengurusan($pengurus_putri->content ?? '');
@endphp

<section id="kepengurusan" class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-down">
            <small class="text-success fw-bold text-uppercase ls-1">Organisasi</small>
            <h2 class="fw-bold text-nu display-6 mb-3 font-serif">Struktur Kepengurusan</h2>
            <div style="width: 80px; height: 4px; background: #ffc107; margin: 0 auto;"></div>
        </div>

        <ul class="nav nav-pills justify-content-center mb-5" id="pills-tab" role="tablist" data-aos="zoom-in">
            <li class="nav-item" role="presentation">
                <button class="nav-link active px-4 py-2 fw-bold rounded-pill mx-2 border border-success" id="pills-putra-tab" data-bs-toggle="pill" data-bs-target="#pills-putra" type="button" role="tab">
                    <i class="fas fa-male me-2"></i>Pengurus Putra
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link px-4 py-2 fw-bold rounded-pill mx-2 border border-success" id="pills-putri-tab" data-bs-toggle="pill" data-bs-target="#pills-putri" type="button" role="tab">
                    <i class="fas fa-female me-2"></i>Pengurus Putri
                </button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent" data-aos="fade-up">
            
            <div class="tab-pane fade show active" id="pills-putra" role="tabpanel">
                <div class="row justify-content-center g-4">
                    
                    <div class="col-lg-5">
                        <div class="card border-0 border-start border-success border-5 shadow-sm h-100 rounded-4">
                            <div class="card-header bg-white fw-bold text-success pt-4 pb-2 fs-5 border-0">
                                Jajaran Pengasuh & Inti
                            </div>
                            <div class="card-body px-4">
                                <ul class="list-group list-group-flush">
                                    @foreach($putra['inti'] as $item)
                                    <li class="list-group-item px-0 py-3 d-flex justify-content-between align-items-start border-light">
                                        <div class="fw-bold text-dark w-50">{{ $item['role'] }}</div>
                                        <div class="text-end text-muted small w-50 lh-base">{{ $item['names'] }}</div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="card border-0 border-start border-warning border-5 shadow-sm h-100 rounded-4">
                            <div class="card-header bg-white fw-bold text-warning pt-4 pb-2 fs-5 border-0">
                                Seksi-seksi Kepengurusan
                            </div>
                            <div class="card-body px-4">
                                <div class="row g-4">
                                    @foreach($putra['seksi'] as $item)
                                    <div class="col-md-6">
                                        <div class="p-3 bg-light rounded-3 h-100 border border-white shadow-sm">
                                            <div class="fw-bold text-dark mb-1">{{ $item['role'] }}</div>
                                            <div class="text-secondary small lh-base">{{ str_replace(',', ', ', $item['names']) }}</div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="tab-pane fade" id="pills-putri" role="tabpanel">
                <div class="row justify-content-center g-4">
                    
                    <div class="col-lg-5">
                        <div class="card border-0 border-start border-success border-5 shadow-sm h-100 rounded-4">
                            <div class="card-header bg-white fw-bold text-success pt-4 pb-2 fs-5 border-0">
                                Jajaran Pengasuh & Inti
                            </div>
                            <div class="card-body px-4">
                                <ul class="list-group list-group-flush">
                                    @foreach($putri['inti'] as $item)
                                    <li class="list-group-item px-0 py-3 d-flex justify-content-between align-items-start border-light">
                                        <div class="fw-bold text-dark w-50">{{ $item['role'] }}</div>
                                        <div class="text-end text-muted small w-50 lh-base">{{ $item['names'] }}</div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="card border-0 border-start border-warning border-5 shadow-sm h-100 rounded-4">
                            <div class="card-header bg-white fw-bold text-warning pt-4 pb-2 fs-5 border-0">
                                Seksi-seksi Kepengurusan
                            </div>
                            <div class="card-body px-4">
                                <div class="row g-4">
                                    @foreach($putri['seksi'] as $item)
                                    <div class="col-md-6">
                                        <div class="p-3 bg-light rounded-3 h-100 border border-white shadow-sm">
                                            <div class="fw-bold text-dark mb-1">{{ $item['role'] }}</div>
                                            <div class="text-secondary small lh-base">{{ str_replace(',', ', ', $item['names']) }}</div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


<section id="jadwal" class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-down">
            <small class="text-success fw-bold text-uppercase ls-1">Rutinitas</small>
            <h2 class="fw-bold text-nu display-6 mb-3" style="font-family: 'Merriweather', serif;">Jadwal Kegiatan Harian</h2>
            <div style="width: 80px; height: 4px; background: #ffc107; margin: 0 auto;"></div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-8" data-aos="fade-up">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                    <table class="table table-hover table-striped mb-0 text-center align-middle">
                        <thead class="bg-nu text-white">
                            <tr>
                                <th class="py-3" width="30%">Waktu</th>
                                <th class="py-3" width="70%">Kegiatan Santri</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($schedules as $s)
                            <tr>
                                <td class="py-3 fw-bold text-success">{{ $s->time }}</td>
                                <td class="py-3 text-dark">{{ $s->activity }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="py-4 text-muted">Jadwal belum ditambahkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="berita" class="py-5 bg-white">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-down">
            <small class="text-success fw-bold text-uppercase ls-1">Informasi Terkini</small>
            <h2 class="fw-bold text-nu display-6 mb-3" style="font-family: 'Merriweather', serif;">Kabar Pesantren</h2>
            <div style="width: 80px; height: 4px; background: #ffc107; margin: 0 auto;"></div>
        </div>
        
        <div class="row g-4">
            @forelse($news as $post)
            <div class="col-md-4" data-aos="fade-up">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-top">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top object-fit-cover" style="height: 200px;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-newspaper fa-4x text-muted opacity-25"></i>
                        </div>
                    @endif
                    <div class="card-body p-4 bg-white">
                        <div class="mb-2">
                            <span class="badge bg-warning text-dark">{{ ucfirst($post->category) }}</span>
                            <small class="text-muted ms-2"><i class="fas fa-calendar-alt me-1"></i> {{ $post->created_at->format('d M Y') }}</small>
                        </div>
                        <h5 class="fw-bold text-dark mb-3">{{ Str::limit($post->title, 50) }}</h5>
                        <p class="text-muted small">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                        <div class="mt-4 pt-3 border-top">
                <a href="{{ route('berita.show', $post->id) }}" class="btn btn-success rounded-pill px-4 fw-bold">
                    Lihat Detail <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-4">Belum ada berita yang diterbitkan.</div>
            @endforelse
        </div>
    </div>
</section>


<style>
    /* Efek Hover Kartu secara Umum */
    .hover-top { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .hover-top:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important; }
    
    /* Efek Kaca untuk tombol outline di Hero */
    .backdrop-blur { backdrop-filter: blur(5px); background: rgba(255,255,255,0.1); }
    .backdrop-blur:hover { background: rgba(255,255,255,0.2); }
    
    /* Spasi Tulisan */
    .ls-1 { letter-spacing: 1.5px; }
</style>

@endsection