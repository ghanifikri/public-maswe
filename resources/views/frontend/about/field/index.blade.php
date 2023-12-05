@extends('frontend.layouts.app')

@section('style')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
<!-- ===== Link Swiper's CSS ===== -->
{{-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" /> --}}
<link rel="stylesheet" href="{{ asset('frontend/library/swiper/swiper-bundle.min.css') }}">
<!-- ===== Fontawesome CDN Link ===== -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
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
<section id="facilites" class="facilities">
    <div class="container">
        <header class="section-header">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <h2>{{ $headerFP->title }}</h2>
                    <p>{{ $headerFP->sub_title }}</p>
                </div>
            </div>
        </header>
        <div class="row facilities-container">
            @forelse ($fasilitasProduksi as $item)
            <div class="col-lg-4 col-md-6 facilities-item">
                <a href="" onclick="show({{ $item->id }})" data-toggle="modal" data-target="#myModal">
                    <div class="facilities-img"><img src="{{ asset($item->image) }}" class="img-fluid" alt=""></div>
                    <div class="facilities-info">
                        <h4>{{ $item->nama_fasilitas }}</h4>
                    </div>
                </a>
            </div>
            @empty

            @endforelse
            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog modal-lg">
                    <span id="page"></span>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="kapasitas-produksi" id="kapasitas-produksi">
    <div class="container">
        <div class="row align-items-center">
            @foreach ($kapasitasProduksi as $item)
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset($item->image) }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 text-center">
                <h2>{{ $item->judul }}</h2>
                <p>{{ $item->description }}</p>
            </div>
            @endforeach

        </div>
    </div>
</section>
<section class="taliban-skuad" id="taliban-skuad">
    <div class="container">
        <header class="section-header">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <h2>{{ $headerTeam->title }}</h2>
                    <p>{{ $headerTeam->sub_title }}</p>
                </div>
            </div>
        </header>
    </div>
    <div class="swiper mySwiper container">
        <div class="swiper-wrapper content">
            @forelse ($teams as $item)
            <div class="swiper-slide card">
                <div class="card-content">
                    <div class="image">
                        <img src="{{ asset($item->image) }}" alt="">
                    </div>
                    <div class="name-profession">
                        <span class="name">{{ $item->nama }}</span>
                        <span class="profession">{{ $item->jabatan }}</span>
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
            </div>
            @empty

            @endforelse
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Swiper JS -->
{{-- <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> --}}
<script src="{{ asset('frontend/library/swiper/swiper-bundle.min.js') }}"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        slidesPerGroup: 1,
        loop: true,
        loopFillGroupWithBlank: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
    });

</script>
<script>
    function show(id) {
        $.get("{{ url('AboutUs/field/show') }}/" + id, {}, function (data, status) {
            $("#page").html(data);
            $("#myModal").modal('show');
        });
    }

</script>
@endsection
