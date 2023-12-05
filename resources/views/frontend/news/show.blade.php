@extends('frontend.layouts.app')

@section('hero')
<!-- ======= Top Header ======= -->
<div class="top-header">
    <div class="page-header d-flex align-items-center" style="background-image: url('{{ $heroSection->background }}');">
      <div class="container position-relative">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6 text-center">
            <h2>{{ $heroSection->title }}</h2>
            <p>Detail Post</p>
          </div>
        </div>
      </div>
    </div>
  </div><!-- End Top Header -->
@endsection

@section('content')
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

      <div class="row">

        <div class="col-lg-8 entries">

            <article class="article article-single">

                <div class="article-img">
                  <img src="{{ asset($posts->thumbnail) }}" alt="" class="img-fluid">
                </div>
  
                <h2 class="article-title">
                  <a href="{{ route('news.show',$posts->slug) }}">{{ $posts->judul }}</a>
                </h2>
  
                <div class="article-meta">
                  <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#">{{ $posts->user->name }}</a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#">{{ $posts->created_at->format('M d, Y') }}</a></li>
                  </ul>
                </div>
  
                <div class="article-content">
                  {!! $posts->content !!}
                </div>
  
              </article><!-- End blog article -->

        </div><!-- End blog entries list -->

        <div class="col-lg-4">

            @include('frontend.news.partial.sidebar')

        </div><!-- End blog sidebar -->

      </div>

    </div>
  </section><!-- End Blog Section -->
@endsection
