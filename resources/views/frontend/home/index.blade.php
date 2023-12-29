@extends('frontend.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('frontend/library/glightbox/css/glightbox.min.css') }}">
@endsection

@section('hero')
    <div class="hero">
        @forelse ($headerVideo as $header)
            <video autoplay loop muted plays-inline class="back-video">
                <source src="{{ asset($header->video) }}" type="video/mp4">
            </video>
            <div class="content">
                <h1>{{ $header->title }}</h1>
                <P>{{ $header->sub_title }}</P>
            </div>
        @empty
            <video autoplay loop muted plays-inline class="back-video">
                <source src="{{ asset('frontend/img/example.mp4') }}" type="video/mp4">
            </video>
            <div class="content">
                <h1>TIDAK ADA DATA</h1>
            </div>
        @endforelse
    </div>
@endsection
@section('content')
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        @forelse ($abouts as $about)
            <div class="container">
                <header class="section-header">
                    <h2>
                        {{ $about->title }}
                    </h2>
                </header>
                <div class="row justify-content-center">
                    <div class="col-lg-8 content">
                        {!! $about->sub_title !!}
                    </div>
                </div>
            </div>
        @empty
            <div class="container">
                <header class="section-header">
                    <h2>Dari CILEGON untuk INDONESIA<br>
                        Cerita yang akan terus berjalan Sejak 2018.
                    </h2>
                </header>
                <div class="row justify-content-center">
                    <div class="col-lg-8 content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore excepturi quis ut obcaecati esse
                            minima totam recusandae facere temporibus, autem dolores, voluptate inventore mollitia voluptas
                            quam. Natus enim corporis sint?</p>
                    </div>
                </div>
            </div>
        @endforelse
    </section><!-- End About Section -->
    <!-- ======= Recent news Posts Section ======= -->
    <section id="recent-blog-posts" class="recent-blog-posts">
        <div class="container">
            <header class="section-header">
                <h2>{{ $titleNews->title }}</h2>
                <p>{{ $titleNews->sub_title }}</p>
            </header>
            <div class="row">
                @forelse ($news as $item)
                    <div class="col-lg-4">
                        <div class="post-box">
                            <div class="post-img"><img src="{{ asset($item->thumbnail) }}" class="img-fluid" alt="">
                            </div>
                            <span class="post-date">{{ $item->created_at->format('M d, Y') }}</span>
                            <h3 class="post-title">{{ $item->judul }}</h3>
                            <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-4">
                        <div class="post-box">
                            <div class="post-img"><img src="{{ asset('frontend/img/values-1.png') }}" class="img-fluid"
                                    alt="">
                            </div>
                            <span class="post-date">Tue, September 15</span>
                            <h3 class="post-title">Eum ad dolor et. Autem aut fugiat debitis voluptatem consequuntur sit
                            </h3>
                            <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="post-box">
                            <div class="post-img"><img src="{{ asset('frontend/img/values-2.png') }}" class="img-fluid"
                                    alt="">
                            </div>
                            <span class="post-date">Fri, August 28</span>
                            <h3 class="post-title">Et repellendus molestiae qui est sed omnis voluptates magnam</h3>
                            <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="post-box">
                            <div class="post-img"><img src="{{ asset('frontend/img/values-3.png') }}" class="img-fluid"
                                    alt="">
                            </div>
                            <span class="post-date">Mon, July 11</span>
                            <h3 class="post-title">Quia assumenda est et veritatis aut quae</h3>
                            <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- End Recent news Posts Section -->

    <section id="banner" class="d-flex flex-column justify-content-center"
        style=" background: url('{{ asset($aboutKaligandu->background) }}') top center; background-size:cover;background-position:center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <p>{{ $aboutKaligandu->title_one }}</p>
                    <h1>{{ $aboutKaligandu->title_two }}</h1>
                    <h2>{{ $aboutKaligandu->title_three }}</h2>
                    <p>{{ $aboutKaligandu->title_four }}</p>
                    <a href="{{ $aboutKaligandu->video_url }}" class="glightbox play-btn mb-4"></a>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('frontend/library/glightbox/js/glightbox.min.js') }}"></script>
    <script>
        const glightbox = GLightbox({
            selector: '.glightbox'
        });
    </script>
@endsection
