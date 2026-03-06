@extends('layouts.main')

@section('title', $program->title)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <a href="/#program" class="btn btn-outline-success mb-4 rounded-pill btn-sm fw-bold">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
            </a>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                
                @if(!empty($program->images) && is_array($program->images) && count($program->images) > 0)
                    <div id="programCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner bg-dark">
                            @foreach($program->images as $key => $img)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $img) }}" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Foto {{ $program->title }}">
                                </div>
                            @endforeach
                        </div>
                        
                        @if(count($program->images) > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#programCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#programCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>

                @elseif(!empty($program->image))
                    <img src="{{ asset('storage/' . $program->image) }}" class="w-100" style="max-height: 400px; object-fit: cover;" alt="{{ $program->title }}">
                
                @else
                    <div class="bg-success d-flex align-items-center justify-content-center" style="height: 250px;">
                        <i class="{{ $program->icon }} fa-5x text-white opacity-50"></i>
                    </div>
                @endif
                <div class="card-body p-5">
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-warning bg-opacity-25 text-warning p-3 rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="{{ $program->icon }} fa-2x"></i>
                        </div>
                        <h2 class="fw-bold text-nu mb-0">{{ $program->title }}</h2>
                    </div>

                    <div class="lead text-dark lh-lg" style="font-size: 1.1rem; text-align: justify;">
                        @if($program->content)
                            {!! nl2br(e($program->content)) !!}
                        @else
                            {!! nl2br(e($program->description)) !!}
                        @endif
                    </div>
                    
                </div>
                </div>

        </div>
    </div>
</div>
@endsection