@extends('user.layouts.app')

@section('style')
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

@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i>Edit Reviews</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="{{ route('reviews') }}">Reviews</a></li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <form action="{{ route('reviews.update', $review->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="d-flex my-3 align-items-center">
                        <p class="mb-0 mr-2">Your Rating * :</p>
                        <div class="rate">
                            <input type="radio" {{ $review->rate == 5 ? 'checked' : ''  }} id="star5" class="rate" name="rate" value="5" />
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" {{ $review->rate == 4 ? 'checked' : ''  }} id="star4" class="rate" name="rate" value="4" />
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" {{ $review->rate == 3 ? 'checked' : ''  }} id="star3" class="rate" name="rate" value="3" />
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" {{ $review->rate == 2 ? 'checked' : ''  }} id="star2" class="rate" name="rate" value="2">
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" {{ $review->rate == 1 ? 'checked' : ''  }} id="star1" class="rate" name="rate" value="1" />
                            <label for="star1" title="text">1 star</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">Your Review *</label>
                        <textarea id="message" name="review" cols="30" rows="5"
                            class="form-control">{{ $review->review }}</textarea>
                    </div>
                    <div class="form-group mb-0">
                        <input type="submit" value="Update Review" class="btn btn-info px-3">
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection
