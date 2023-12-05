@extends('frontend.layouts.app')

@section('style')

@endsection

@section('hero')
<section id="hero-history" class="d-flex align-items-center"
    style="background: url('{{ asset($heroSection->background) }}') top left; background-size: cover;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <h1>{{ $heroSection->title }}</h1>
                    <h2>{{ $heroSection->description }}</h2>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<section class="team" id="team">
    <div class="container">
        <header class="section-header">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <h2>{{ $headerSection->title }}</h2>
                    <p>{{ $headerSection->sub_title }}</p>
                </div>
            </div>
        </header>
        <div class="member-info">
            <div class="row justify-content-center">
                @forelse ($founder as $f)
                <div class="col-6 col-lg-3 text-center mb-4">
                    <div class="member-image mx-auto" style="background-image: url('{{ asset($f->image) }}');">

                    </div>
                    <div class="member-name">
                        {{ $f->nama }}
                    </div>
                    <div class="member-position">
                        {{ $f->jabatan }}
                    </div>
                    <div class="social-link">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="facebook"><i class="bx bxl-instagram"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="facebook"><i class="bx bxl-gmail"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                @empty
                    
                @endforelse
            </div>
            <div class="row">
                @forelse ($people as $p)
                <div class="col-6 col-lg-3 text-center mb-4">
                    <div class="member-image mx-auto" style="background-image: url('{{ asset($p->image) }}');">

                    </div>
                    <div class="member-name">
                        {{ $p->nama }}
                    </div>
                    <div class="member-position">
                        {{ $p->jabatan }}
                    </div>
                    <div class="social-link">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="facebook"><i class="bx bxl-instagram"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="facebook"><i class="bx bxl-gmail"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                @empty
                    
                @endforelse
            </div>
        </div>

    </div>
</section>
<div id="image-link" class="image-link">
    <div class="container-fluid px-0">
        <div class="row no-gutters image-link-container">
            @foreach ($linkImage as $item)
                <div class="col-lg-4 col-md-4 image-link-item">
                    <a href="{{ $item->route }}">
                        <img src="{{ asset($item->background) }}" class="img-fluid" alt="">
                        <div class="image-link-info">
                            <h2>{!! $item->title_link !!}</h2>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection
