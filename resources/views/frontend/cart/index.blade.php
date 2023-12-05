@extends('frontend.layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('frontend/style/themify-icons.css') }}">
@endsection

@section('hero')
<!-- ======= Top Header ======= -->
<div class="top-header">
    <div class="page-header d-flex align-items-center"
        style="background-image: url('{{ asset('frontend/img/produk1.jpg')}}');">
        <div class="container position-relative">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 text-center">
                    <h2>CART</h2>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Top Header -->
@endsection

@section('content')
<div class="shopping-cart section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Shopping Summery -->

                <table class="table shopping-summery table-responsive">
                    <thead>
                        <tr class="main-hading">
                            <th>PRODUCT</th>
                            <th>NAME</th>
                            <th class="text-center" width="20%">UNIT PRICE</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-center" width="20%">TOTAL</th>
                            <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('cart-update') }}" method="post">
                            @csrf
                            @php $totalPrice = 0; $totalAdmin = 0 @endphp
                            @forelse ($carts as $key=>$item)
                            <tr>
                                <td class="image" data-title="No"><img
                                        src="{{ $item->product->images->first()->image }}" alt="#">
                                </td>
                                <td class="product-des" data-title="Description">
                                    @if ($item->size != '')
                                    <p class="product-name"><a href="#">{{ $item->product->name }}</a>
                                        ({{ $item->size }})
                                        @else
                                        <p class="product-name"><a href="#">{{ $item->product->name }}</a>
                                            @endif</p>
                                        <p class="product-des">{!! $item->product->summary !!}</p>
                                </td>
                                <td class="price" data-title="Price"><span>{{ moneyFormat($item->price) }} </span></td>
                                <td class="qty" data-title="Qty">
                                    <!-- Input Order -->
                                    <div class="input-group">
                                        <div class="button minus">
                                            <button type="button" class="btn btn-primary btn-number" data-type="minus"
                                                data-field="quant[{{$key}}]">
                                                <i class="ti-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="quant[{{ $key }}]" class="input-number" data-min="1"
                                            data-max="100" value="{{ $item->quant }}">
                                        <input type="hidden" name="qty_id[]" value="{{ $item->id }}">
                                        <div class="button plus">
                                            <button type="button" class="btn btn-primary btn-number" data-type="plus"
                                                data-field="quant[{{$key}}]">
                                                <i class="ti-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!--/ End Input Order -->
                                </td>
                                <td class="total-amount" data-title="Total">
                                    <span>{{ moneyFormat($item->amount) }}</span>
                                </td>
                                <td class="action" data-title="Remove"><a onclick="destroy(this.id)"
                                        id="{{$item->id}}"><i class="ti-trash remove-icon"></i></a></td>
                            </tr>
                            @php 
                                $totalPrice += $item->amount; 
                                $totalAdmin = $totalPrice + 2500
                            @endphp
                            @empty
                                <tr>
                                    <td colspan="6" width="120%" class="text-center">Data Tidak tersedia</td>
                                </tr>
                            @endforelse
                    </tbody>
                </table>
                <button class="btn btnn float-right" type="submit">Update</button>
                <!--/ End Shopping Summery -->
                </form>
            </div>
        </div>
    </div>
</div>
<section class="shop checkout section">
    <div class="container">
        <form class="form" method="post" action="{{ route('checkout') }}">
        @csrf
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="checkout-form">
                        <h2>Lakukan Pembayaran Anda Disini</h2>
                        <br>
                        <!-- Form -->
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Nama<span>*</span></label>
                                    <input class="form-control" type="text" value="{{ Auth::user()->name }}" name="name"
                                        placeholder="" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Email Address<span>*</span></label>
                                    <input class="form-control" type="email" value="{{ Auth::user()->email }}"
                                        name="email" placeholder="" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Phone Number<span>*</span></label>
                                    <input class="form-control" type="number" name="phone_number" value="{{ Auth::user()->phone_number ? Auth::user()->phone_number : '' }}" placeholder=""
                                        required="required">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Provinsi<span>*</span></label>
                                    <select class="form-control" name="province_id" id="province_id">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach ($provinces as $row)
                                        <option value="{{ $row->id }}" {{ Auth::user()->provinces_id == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Kabupaten / Kota<span>*</span></label>
                                    <select class="form-control" name="city_id" id="city_id">
                                        <option value="">Pilih Kabupaten/Kota</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Kecamatan<span>*</span></label>
                                    <select class="form-control" name="district_id" id="district_id">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Alamat<span>*</span></label>
                                    <textarea class="form-control" name="address" id="" cols="30" rows="3">{{ Auth::user()->address ? Auth::user()->address : '' }}</textarea>
                                </div>
                            </div>
                            <input type="hidden" name="total_price" value="{{ $totalAdmin }}">
                        </div>
                        <!--/ End Form -->
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="order-details">
                        <!-- Order Widget -->
                        <div class="single-widget">
                            <h2>CART TOTALS</h2>
                            <div class="content">
                                <ul>
                                    <li>Sub Total<span>{{ moneyFormat($totalPrice) }}</span></li>
                                    <li>Biaya Admin<span>Rp 2.500</span></li>
                                    <li class="last">Total<span>{{ moneyFormat($totalAdmin) }}</span></li>
                                </ul>
                            </div>
                        </div>
                        <!--/ End Order Widget -->
                        <!-- Button Widget -->
                        <div class="single-widget get-button">
                            <div class="content">
                                <div class="button">
                                    <button type="submit" class="btnn">Bayar Sekarang</button>
                                </div>
                            </div>
                        </div>
                        <!--/ End Button Widget -->
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@section('js')
<script src="{{ asset('frontend/js/jquery-migrate-3.0.0.js') }}"></script>
<script src="{{ asset('frontend/js/nicesellect.js') }}"></script>

<script>
    $(document).ready(function(){
        loadCity($('#province_id').val(), 'bySelect').then(() => {
            loadDistrict($('#city_id').val(), 'bySelect');
        })
        
    })
    $('#province_id').on('change', function() {
        loadCity($(this).val(), '');
    })
    $('#city_id').on('change', function() {
        loadDistrict($(this).val(), '');
    })

    function loadCity(province_id, type) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: "{{ url('/api/city') }}",
                type: "GET",
                data: { province_id: province_id },
                success: function(html){
                    $('#city_id').empty()
                    $('#city_id').append('<option value="">Pilih Kabupaten/Kota</option>')
                    $.each(html.data, function(key, item) {
                        let city_selected = {{ Auth::user()->regencies_id }};
                        let selected = type == 'bySelect' && city_selected == item.id ? 'selected':'';
                        $('#city_id').append('<option value="'+item.id+'" '+ selected +'>'+item.name+'</option>')
                        resolve()
                    })
                }
            });
        })
    }
    function loadDistrict(city_id, type) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: "{{ url('/api/district') }}",
                type: "GET",
                data: { city_id: city_id },
                success: function(html){
                    $('#district_id').empty()
                    $('#district_id').append('<option value="">Pilih Kabupaten/Kota</option>')
                    $.each(html.data, function(key, item) {
                        let city_selected = {{ Auth::user()->districts_id }};
                        let selected = type == 'bySelect' && city_selected == item.id ? 'selected':'';
                        $('#district_id').append('<option value="'+item.id+'" '+ selected +'>'+item.name+'</option>')
                        resolve()
                    })
                }
            });
        })
    }
</script>
<script>
    // $('select').niceSelect();

    $('.quantity button').on('click', function () {
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

    function destroy(id) {
        var id = id;
        var token = $("meta[name='csrf-token']").attr("content");

        Swal.fire({
            title: 'APAKAH KAMU YAKIN ?',
            text: "INGIN MENGHAPUS DATA INI!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'BATAL',
            confirmButtonText: 'YA, HAPUS!',
        }).then((result) => {
            if (result.isConfirmed) {
                //ajax delete
                jQuery.ajax({
                    url: `cart-delete/${id}`,
                    data: {
                        "id": id,
                        "_token": token
                    },
                    type: 'DELETE',
                    success: function (response) {
                        if (response.status == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'BERHASIL!',
                                text: 'DATA BERHASIL DIHAPUS!',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(function () {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'GAGAL!',
                                text: 'DATA GAGAL DIHAPUS!',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            }
        })
    }

</script>
@endsection
