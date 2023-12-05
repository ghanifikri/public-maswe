@extends('admin.layouts.app')
@section('title', 'Change Font')

@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('template_admin/vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('template_admin/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
<h1 class="h3 mb-4 text-gray-800">Change Font</h1>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <input type="hidden" id="name_values" name="name_values" value="titleAboutMaswe">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Font Title</label>
                    <div class="col-sm-8 mb-2">
                        <select name="type_fonts" id="type_fonts" class="form-control select2bs4" style="width: 100%;">
                            <option value="">Change Font</option>
                            @foreach ($fonts as $item)
                            <option value="{{ $item->font }}"
                                {{ old('type_fonts', $fontTitle->type_fonts) === $item->font ? 'selected' : NULL }}>
                                {{ $item->font }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-success btn-title">Change</button>
                    </div>
                </div>
                <div class="form-group row">
                    <input type="hidden" id="name_values2" name="name_values" value="titleOther">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Font Other</label>
                    <div class="col-sm-8 mb-2">
                        <select name="type_fonts" id="type_fonts2" class="form-control select2bs4" style="width: 100%;">
                            <option value="">Change Font</option>
                            @foreach ($fonts as $item)
                            <option value="{{ $item->font }}"
                                {{ old('type_fonts', $fontOther->type_fonts) === $item->font ? 'selected' : NULL }}>
                                {{ $item->font }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-success btn-title2">Change</button>
                    </div>
                </div>
                <div class="form-group row">
                    <input type="hidden" id="name_values1" name="name_values" value="titleDescriptionAboutMaswe">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Font Description</label>
                    <div class="col-sm-8 mb-2">
                        <select name="type_fonts" id="type_fonts1" class="form-control select2bs4" style="width: 100%;">
                            <option value="">Change Font</option>
                            @foreach ($fonts as $item)
                            <option value="{{ $item->font }}"
                                {{ old('type_fonts', $fontDescription->type_fonts) === $item->font ? 'selected' : NULL }}>
                                {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-success btn-subtitle">Change</button>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('aboutMaswe.index') }}" class="btn btn-info float-right">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<!-- Select2 -->
<script src="{{ asset('template_admin/vendor/select2/js/select2.full.min.js') }}"></script>

<script>
    $(function () {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.btn-title').click(function () {
        var name_values = $('#name_values').val();
        var type_fonts = $('#type_fonts').val();

        $.ajax({
            url: '{{ route('changeFont.storeTitleAboutMaswe') }}',
            type: 'POST',
            data: {
                name_values: $('#name_values').val(),
                type_fonts: $('#type_fonts').val()
            },
            success: function (response) {
                if (response.status == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'BERHASIL!',
                        text: 'DATA BERHASIL DIUBAH!',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(function () {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'GAGAL!',
                        text: 'DATA GAGAL DIUBAH!',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(function () {
                        location.reload();
                    });
                }
            }
        });
    })

    $('.btn-title2').click(function () {
        var name_values = $('#name_values2').val();
        var type_fonts = $('#type_fonts2').val();

        $.ajax({
            url: '{{ route('changeFont.storeTitleHeroAbout') }}',
            type: 'POST',
            data: {
                name_values: $('#name_values2').val(),
                type_fonts: $('#type_fonts2').val()
            },
            success: function (response) {
                if (response.status == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'BERHASIL!',
                        text: 'DATA BERHASIL DIUBAH!',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(function () {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'GAGAL!',
                        text: 'DATA GAGAL DIUBAH!',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(function () {
                        location.reload();
                    });
                }
            }
        });
    })

    $('.btn-subtitle').click(function () {
        var name_values = $('#name_values1').val();
        var type_fonts = $('#type_fonts1').val();

        $.ajax({
            url: '{{ route('changeFont.storeTitleHeroAbout') }}',
            type: 'POST',
            data: {
                name_values: $('#name_values1').val(),
                type_fonts: $('#type_fonts1').val()
            },
            success: function (response) {
                if (response.status == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'BERHASIL!',
                        text: 'DATA BERHASIL DIUBAH!',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(function () {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'GAGAL!',
                        text: 'DATA GAGAL DIUBAH!',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(function () {
                        location.reload();
                    });
                }
            }
        });
    })

</script>
@endsection
