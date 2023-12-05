@extends('frontend.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('frontend/library/icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/library/icons/elegant-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/library/owl-carousel/owl.carousel.min.css') }}">
@endsection

@section('hero')
<section id="hero" class="d-flex align-items-center"
    style="background: url('{{ asset('frontend/img/history.jpg') }}') top left; background-size: cover;">
    <div class="container">
        <h1>PRODUCT</h1>
        <h2>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</h2>
    </div>
</section>
@endsection

@section('content')
<section class="product spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="product-slider owl-carousel">
                    @foreach ($products as $item)
                    <div class="product-item">
                        <div class="pi-pic">
                                <img src="{{ $item->images->first()->image }}" alt="" />
                            <ul>
                                <li class="w-icon active">
                                    <a href="{{ route('produk.detail', $item->slug) }}"><i class="icon_bag_alt"></i></a>
                                </li>
                                <li class="quick-view"><a href="{{ route('produk.detail', $item->slug) }}">+ Quick View</a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">{{ $item->kategori }}</div>
                            <a href="{{ route('produk.detail', $item->slug) }}">
                                <h5>{{ $item->name }}</h5>
                            </a>
                            <div class="product-price">
                                {{ moneyFormat($item->price) }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')

<script src="{{ asset('frontend/library/owl-carousel/owl.carousel.min.js') }}"></script>
<script>

    $(".product-slider").owlCarousel({
        loop: true,
        margin: 25,
        nav: true,
        items: 4,
        dots: true,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 2,
            },
            992: {
                items: 2,
            },
            1200: {
                items: 3,
            }
        }
    });
</script>
@endsection
