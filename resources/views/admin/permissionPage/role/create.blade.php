@extends('admin.layouts.app')

@section('title','Tambah Wewenang')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form action="{{ route('role.store') }}" method="POST">
                @csrf
                
                <div class="card-body">
                    <div class="form-group">
                        <label for="input_role_name" class="font-weight-bold">
                            Nama
                        </label>
                        <input id="input_role_name" value="{{ old('name') }}" name="name" type="text"
                            class="form-control @error('name') is-invalid @enderror" />
                        @error('name')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- permission -->
                    <div class="form-group">
                        <label for="input_role_permission" class="font-weight-bold">
                            Wewenang
                        </label>
                        <div class="form-control overflow-auto h-100 @error('permissions') is-invalid @enderror"
                            id="input_role_permission">
                            <div class="row">
                                <!-- list manage name:start -->
                                @foreach ($authorities as $menageName => $permissions)
                                <ul class="list-group mx-1 my-1">
                                    <li class="list-group-item bg-dark text-white">
                                        {{ str_replace("_"," ", $menageName) }}
                                    </li>
                                    <!-- list permission:start -->
                                    @foreach ($permissions as $permission)
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            @if (old('permissions'))
                                            <input id="{{ $permission }}" name="permissions[]" class="form-check-input"
                                                type="checkbox" value="{{ $permission }}"
                                                {{ in_array($permission, old('permissions')) ? 'checked' : null }}>
                                            @else
                                            <input id="{{ $permission }}" name="permissions[]" class="form-check-input"
                                                type="checkbox" value="{{ $permission }}">
                                            @endif

                                            <label for="{{ $permission }}" class="form-check-label">
                                                {{ str_replace("_"," ", $permission) }}
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach

                                    <!-- list permission:end -->
                                </ul>
                                @endforeach

                                <!-- list manage name:end  -->
                            </div>
                        </div>
                        @error('name')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="float-right mb-4">
                        <a class="btn btn-warning px-4 mx-2" href="{{ route('role.index') }}">
                            Back
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
