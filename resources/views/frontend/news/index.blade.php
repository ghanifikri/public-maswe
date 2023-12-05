@extends('frontend.layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('frontend/style/pagination.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
@endsection

@section('hero')
<!-- ======= Top Header ======= -->
<div class="top-header">
    <div class="page-header d-flex align-items-center" style="background-image: url('{{ asset($heroSection->background) }}');">
      <div class="container position-relative">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6 text-center">
            <h2>{{ $heroSection->title }}</h2>
            <p>{{ $heroSection->sub_title }}</p>
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
          @forelse ($posts as $post)
          <article class="article">

            <div class="article-img">
              <img src="{{ asset($post->thumbnail) }}" alt="" class="img-fluid">
            </div>

            <h2 class="article-title">
              <a href="{{ route('news.show', $post->slug) }}">{{ $post->judul }}</a>
            </h2>

            <div class="article-meta">
              <ul>
                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-single.html">{{ $post->user->name }}</a></li>
                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.html">{{ $post->created_at->format('M d, Y') }}</a></li>
              </ul>
            </div>

            <div class="article-content">
              <p>
                {{ $post->description }}
              </p>
              <div class="read-more">
                <a href="blog-single.html">Read More</a>
              </div>
            </div>

          </article>
          @empty
              
          @endforelse
            {{ $posts->links('pagination::bootstrap-4') }}
        </div><!-- End blog entries list -->

        <div class="col-lg-4">

            @include('frontend.news.partial.sidebar')

        </div><!-- End blog sidebar -->

      </div>

    </div>
  </section><!-- End Blog Section -->
@endsection
