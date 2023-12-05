@extends('user.layouts.app')

@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-user"></i> Profile</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Profile</a></li>
    </ul>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="tile">
            <div class="image text-center">
                @if($user->avatar)
                <img class="card-img-top img-fluid roundend-circle"
                    style="border-radius:50%;height:80px;width:80px;margin:auto;" src="{{$user->avatar}}"
                    alt="profile picture">
                @else
                <img class="card-img-top img-fluid roundend-circle"
                    style="border-radius:50%;height:80px;width:80px;text-align:center;"
                    src="{{asset('frontend/img/user.png')}}" alt="profile picture">
                @endif
            </div>
            <hr>
            <div class="tile-body mt-4">
                <table class="table table-borderless">
                    <tr>
                        <th width="5%" style="padding: 0.3rem !important"><i class="fa fa-user"></i></th>
                        <td width="95%" style="padding: 0.3rem !important">{{$user->name}}</td>
                    </tr>
                    <tr>
                        <th width="5%" style="padding: 0.3rem !important"><i class="fa fa-envelope"></i></th>
                        <td width="95%" style="padding: 0.3rem !important">{{$user->email}}</td>
                    </tr>
                    <tr>
                        <th width="5%" style="padding: 0.3rem !important"><i class="fa fa-phone"></i></th>
                        <td width="95%" style="padding: 0.3rem !important">{{$user->phone_number}}</td>
                    </tr>
                    @if ($user->address)
                    <tr>
                        <th width="5%" style="padding: 0.3rem !important"><i class="fa fa-map-marker"></i></th>
                        <td width="95%" style="padding: 0.3rem !important;text-transform:uppercase">
                            {{$user->address}},
                            {{$user->district->name}}, {{$user->regencies->name}}, {{$user->provinces->name}}</td>
                    </tr>
                    @endif

                    <tr class="text-muted">
                        <th width="5%" style="padding: 0.3rem !important"><i class="fa fa-gear"></i></th>
                        <td width="95%" style="padding: 0.3rem !important">{{$user->role}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="tile">
            <div class="tile-body">
                <form autocomplete="off" action="{{ route('profile.update', $user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" value="{{old('name')? old('name') : $user->name}}" class="form-control {{$errors->first('name')
                        ? "is-invalid": ""}}" id="name" name="name" placeholder="Enter name">
                        <div class="invalid-feedback">
                            {{$errors->first('name')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" value="{{old('email')? old('email') : $user->email}}" class="form-control {{$errors->first('email')
                        ? "is-invalid": ""}}" id="email" name="email" placeholder="Enter email">
                        <div class="invalid-feedback">
                            {{$errors->first('email')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">No Telphone</label>
                        <input type="number" value="{{old('phone_number')? old('phone_number') : $user->phone_number}}"
                            class="form-control {{$errors->first('phone_number')
                        ? "is-invalid": ""}}" id="phone_number" name="phone_number" placeholder="Enter phone number">
                        <div class="invalid-feedback">
                            {{$errors->first('phone_number')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Avatar</label>
                        <div class="input-group">
                            <input placeholder="Url Background" value="{{ old('avatar') ? old('avatar') : asset($user->avatar) }}" type="text" id="image_label"
                                class="form-control {{$errors->first('avatar')
                            ? "is-invalid": ""}}" name="avatar" aria-label="Image" aria-describedby="button-image">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button"
                                    id="button-image">Select</button>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            {{$errors->first('avatar')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Provinsi</label>
                        <select class="form-control" name="province_id" id="province_id" required>
                            <option value="">Pilih Propinsi</option>
                            @foreach ($provinces as $row)
                            <option value="{{ $row->id }}" {{ $user->provinces_id == $row->id ? 'selected':'' }}>
                                {{ $row->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger">{{ $errors->first('province_id') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Kabupaten / Kota</label>
                        <select class="form-control" name="city_id" id="city_id" required>
                            <option value="">Pilih Kabupaten/Kota</option>
                        </select>
                        <p class="text-danger">{{ $errors->first('city_id') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Kecamatan</label>
                        <select class="form-control" name="district_id" id="district_id" required>
                            <option value="">Pilih Kecamatan</option>
                        </select>
                        <p class="text-danger">{{ $errors->first('district_id') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="input_post_content" class="font-weight-bold">
                            Alamat
                        </label>
                        <textarea id="input_post_content" name="address" placeholder=""
                        class="form-control {{$errors->first('address') ? "is-invalid": ""}}" rows="3">{{ old('address', $user->address) }}</textarea>
                        <div class="invalid-feedback">
                            {{$errors->first('address')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" 
                            class="form-control {{$errors->first('password')
                        ? "is-invalid": ""}}" id="password" name="password" placeholder="Enter Password">
                        <div class="invalid-feedback">
                            {{$errors->first('password')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-block">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {

        document.getElementById('button-image').addEventListener('click', (event) => {
            event.preventDefault();

            window.open('/file-manager/fm-button', 'fm', 'width=800,height=800');
        });
    });

    // set file link
    function fmSetLink($url) {
        document.getElementById('image_label').value = $url;
    }
</script>
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
                        let city_selected = {{ $user->regencies_id }};
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
                        let city_selected = {{ $user->districts_id }};
                        let selected = type == 'bySelect' && city_selected == item.id ? 'selected':'';
                        $('#district_id').append('<option value="'+item.id+'" '+ selected +'>'+item.name+'</option>')
                        resolve()
                    })
                }
            });
        })
    }
</script>
@endsection
