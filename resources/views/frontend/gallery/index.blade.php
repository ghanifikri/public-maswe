@extends('frontend.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('frontend/library/glightbox/css/glightbox.min.css') }}">
@endsection

@section('hero')
<section id="hero" class="d-flex align-items-center" style="background: url('{{ asset($heroSection->background) }}') top left; background-size: cover;">
    <div class="container">
      <h1>{{ $heroSection->title }}</h1>
      <h2>{{ $heroSection->sub_title }}</h2>
    </div>
  </section>
@endsection

@section('content')
<section id="gallery" class="gallery">
    <div class="container">

      <div class="row g-0">

        <div class="col-lg-3 col-md-4">
          <div class="gallery-item">
            <a href="{{ asset('frontend/img/gallery-1.jpg') }}" class="gallery-lightbox">
              <img src="{{ asset('frontend/img/gallery-1.jpg') }}" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="gallery-item">
            <a href="{{ asset('frontend/img/gallery-2.jpg') }}" class="gallery-lightbox">
              <img src="{{ asset('frontend/img/gallery-2.jpg') }}" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="gallery-item">
            <a href="{{ asset('frontend/img/gallery-3.jpg') }}" class="gallery-lightbox">
              <img src="{{ asset('frontend/img/gallery-3.jpg') }}" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="gallery-item">
            <a href="{{ asset('frontend/img/gallery-4.jpg') }}" class="gallery-lightbox">
              <img src="{{ asset('frontend/img/gallery-4.jpg') }}" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="gallery-item">
            <a href="{{ asset('frontend/img/gallery-5.jpg') }}" class="gallery-lightbox">
              <img src="{{ asset('frontend/img/gallery-5.jpg') }}" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="gallery-item">
            <a href="{{ asset('frontend/img/gallery-6.jpg') }}" class="gallery-lightbox">
              <img src="{{ asset('frontend/img/gallery-6.jpg') }}" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="gallery-item">
            <a href="{{ asset('frontend/img/gallery-7.jpg') }}" class="gallery-lightbox">
              <img src="{{ asset('frontend/img/gallery-7.jpg') }}" alt="" class="img-fluid">
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-4">
          <div class="gallery-item">
            <a href="{{ asset('frontend/img/gallery-8.jpg') }}" class="gallery-lightbox">
              <img src="{{ asset('frontend/img/gallery-8.jpg') }}" alt="" class="img-fluid">
            </a>
          </div>
        </div>

      </div>

    </div>
  </section>
@endsection

@section('js')

<script src="{{ asset('frontend/library/glightbox/js/glightbox.min.js') }}"></script>
<script>
    const galleryLightbox = GLightbox({
      selector: '.gallery-lightbox'
    });
</script>
@endsection
