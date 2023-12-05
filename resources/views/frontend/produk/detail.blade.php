@extends('frontend.layouts.app')

@section('style')
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('frontend/library/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/library/icons/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/library/icons/elegant-icons.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/library/owl-carousel/owl.carousel.min.css') }}">
<style>
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rate:not(:checked)>input {
        position: absolute;
        display: none;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rated:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }

    .star-rating-complete {
        color: #c59b08;
    }

    .rating-container .form-control:hover,
    .rating-container .form-control:focus {
        background: #fff;
        border: 1px solid #ced4da;
    }

    .rating-container textarea:focus,
    .rating-container input:focus {
        color: #000;
    }

    .rated {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rated:not(:checked)>input {
        position: absolute;
        display: none;
    }

    .rated:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ffc700;
    }

    .rated:not(:checked)>label:before {
        content: '★ ';
    }

    .rated>input:checked~label {
        color: #ffc700;
    }

    .rated:not(:checked)>label:hover,
    .rated:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rated>input:checked+label:hover,
    .rated>input:checked+label:hover~label,
    .rated>input:checked~label:hover,
    .rated>input:checked~label:hover~label,
    .rated>label:hover~input:checked~label {
        color: #c59b08;
    }

</style>
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
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner border">
                    @foreach ($product->images as $key=>$item)
                    <div class="carousel-item {{(($key==0)? 'active' : '')}}">
                        <img class="w-100 h-100" src="{{ $item->image }}" alt="Image">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-7 pb-5">
            <h3 class="product-detail-name font-weight-semi-bold">{{ $product->name }}</h3>
            <div class="d-flex mb-3">
                <div class="color-star mr-2">
                    @php
                    $rate=ceil($product->getReview->avg('rate'))
                    @endphp
                    @for ($i = 1; $i <= 5; $i++) @if ($rate>= $i)
                        <small class="fas fa-star"></small>
                        @else
                        <small class="far fa-star"></small>
                        @endif
                        @endfor
                </div>
                <small class="pt-1">({{ $product->getReview->count() }} Reviews)</small>
            </div>
            <h3 class="font-weight-semi-bold mb-4" id="productPrice">{{ moneyFormat($product->price) }}</h3>
            <span class="mb-4">{!! $product->summary !!}</span>
            <dl class="d-flex align-items-center mb-2">
                @foreach ($attributes as $attribute)
                @php
                if ($product) {
                $attributeCheck = in_array($attribute->id, $product->attributes->pluck('attribute_id')->toArray());
                } else {
                $attributeCheck = [];
                }
                @endphp
                <form action="{{ route('add-to-cart') }}" method="POST">
                    @csrf
                    @if ($attributeCheck)
                    <dt class="mr-2 pb-1">{{ $attribute->name }}: </dt>
                    <dd>
                        <select class="form-control option" style="width:180px;" name="size">
                            <option data-price="0" value="0"> Select a {{ $attribute->name }}</option>
                            @foreach($product->attributes as $attributeValue)
                            @if ($attributeValue->attribute_id == $attribute->id)
                            <option data-price="{{ $attributeValue->price }}" value="{{ $attributeValue->value }}">
                                {{ ucwords($attributeValue->value) }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </dd>
                    @endif
                    @endforeach
            </dl>
            <input type="hidden" name="slug" value="{{ $product->slug }}">
            <input type="hidden" name="price" id="finalPrice" value="{{ $product->sale_price > 0 ? $product->sale_price : $product->price }}">
            <div class="d-flex align-items-center mb-4 pt-2">
                <div class="input-group quantity mr-3" style="width: 130px;">
                    <div class="input-group-btn">
                        <a class="btn btn-minus" data-type="minus" data-field="quant[1]">
                            <i class="fa fa-minus"></i>
                        </a>
                    </div>
                    <input type="text" name="quant[1]" class="form-control bg-light text-center" data-min="1" id="quantity" value="1">
                    <div class="input-group-btn">
                        <a class="btn btn-plus" data-type="plus" data-field="quant[1]">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-add-cart px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                
                </form>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews
                    ({{ $product->getReview->count() }})</a>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3">Product Description</h4>
                    {!! $product->description !!}
                </div>
                <div class="tab-pane fade" id="tab-pane-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4">{{ $product->getReview->count() }} review for "{{ $product->name }}"</h4>
                            @foreach ($product['getReview'] as $data)
                            <div class="media mb-4">
                                <img src="{{ asset('frontend/img/user.jpg') }}" alt="Image" class="img-fluid mr-3 mt-1"
                                    style="width: 45px;">
                                <div class="media-body">
                                    <h6>{{ $data->user_info['name'] }}<small> -
                                            <i>{{ $data->created_at->format('d M, Y') }}</i></small></h6>
                                    <div class="color-star mb-2">
                                        @for ($i = 1; $i <= 5; $i++) @if ($data->rate>=$i)
                                            <i class="fas fa-star"></i>
                                            @else
                                            <i class="far fa-star"></i>
                                            @endif
                                            @endfor
                                    </div>
                                    <p>{{ $data->review }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-4">Leave a review</h4>
                            <small>Your email address will not be published. Required fields are marked *</small>
                            @auth
                            <form method="POST" class="form" action="{{ route('review.store', $product->slug) }}">
                                @csrf
                                <div class="d-flex my-3 align-items-center">
                                    <p class="mb-0 mr-2">Your Rating * :</p>
                                    <div class="rate">
                                        <input type="radio" id="star5" class="rate" name="rate" value="5" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" checked id="star4" class="rate" name="rate" value="4" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" class="rate" name="rate" value="3" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" class="rate" name="rate" value="2">
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" class="rate" name="rate" value="1" />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="message">Your Review *</label>
                                    <textarea id="message" name="review" cols="30" rows="5"
                                        class="form-control"></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <input type="submit" value="Leave Your Review" class="btn btn-add-cart px-3">
                                </div>
                            </form>
                            @else
                            <p class="">
                                You need to <a href="{{route('frontend.login')}}"
                                    style="color:rgb(26, 55, 27)">Login</a> OR <a style="color:rgb(26, 55, 27)"
                                    href="{{route('frontend.register')}}">Register</a>

                            </p>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('frontend/library/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/library/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script>
    $('.quantity a').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });

    $(document).ready(function () {
        function formatRupiah(money) {
            return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                } // diletakkan dalam object
            ).format(money);
        }
        $('.option').change(function () {
            $('#productPrice').html(
                "{{ $product->sale_price > 0 ? $product->sale_price : $product->price }}");
            let extraPrice = $(this).find(':selected').data('price');
            let price = parseFloat($('#productPrice').html());
            let finalPrice = (Number(extraPrice) + price);
            $('#finalPrice').val(finalPrice);
            $('#productPrice').html(formatRupiah(finalPrice));
        });
    });

</script>
@endsection
