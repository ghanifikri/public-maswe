@extends('frontend.layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('frontend/library/glightbox/css/glightbox.min.css') }}">
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
<section id="banner-history" class="d-flex flex-column justify-content-center" style=" background: url('{{ asset($aboutMaswe->background) }}') top center; background-size:cover;background-position:center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <h1>{{ $aboutMaswe->title_one }}</h1>
                <p>{{ $aboutMaswe->title_two }}</p>
                <h2>{{ $aboutMaswe->title_three }}</h2>
                <a href="{{ $aboutMaswe->video_url }}" class="glightbox play-btn mb-4"></a>
            </div>
        </div>
    </div>
</section>
<section id="about-page" class="about-page">
    <div class="container">
        @forelse ($histories as $history)
        <div class="row align-items-center mb-4">
            <div class="col-lg-5 content">
                <h1>{{ $history->title }}</h1>
                <p>{{ $history->description }}</p>
            </div>
            <div class="col-lg-7 about-page-img">
                <img src="{{ asset($history->image) }}" alt="">
            </div>
        </div>
        @empty
        <div class="row align-items-center mb-4">
            <div class="col-lg-12 content">
                <h1>data masih kosong</h1>
            </div>
        </div>
        @endforelse
        
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
<script src="{{ asset('frontend/library/glightbox/js/glightbox.min.js') }}"></script>
<script>
    const glightbox = GLightbox({
        selector: '.glightbox'
    });

</script>
@endsection
