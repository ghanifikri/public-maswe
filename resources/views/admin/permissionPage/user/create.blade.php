@extends('admin.layouts.app')

@section('title', 'Add User')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form autocomplete="off" action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <!-- name -->
                    <div class="form-group">
                        <label for="input_user_name" class="font-weight-bold">
                            Name
                        </label>
                        <input id="input_user_name" value="{{ old('name') }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            placeholder="" />
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        <!-- error message -->
                    </div>
                    <!-- role -->
                    <div class="form-group">
                        <label for="select_user_role" class="font-weight-bold">
                            Role
                        </label>
                        <select id="select_user_role" name="role" data-placeholder="" class="custom-select w-100 @error('role') is-invalid @enderror">
                            <option value="" selected="selected">Select Role</option>
                            @foreach ($roles as $role)
                                @if (old('role') && $role->id)
                                <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                @else
                                <option value="{{ $role->id }}" >{{ $role->name }}</option>
                                @endif
                                                
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('role') }}
                        </div>
                        <!-- error message -->
                    </div>
                    <!-- email -->
                    <div class="form-group">
                        <label for="input_user_email" class="font-weight-bold">
                            Email
                        </label>
                        <input id="input_user_email" value="" name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="" />
                        <!-- error message -->
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    </div>
                    <!-- password -->
                    <div class="form-group">
                        <label for="input_user_password" class="font-weight-bold">
                            Password
                        </label>
                        <input id="input_user_password" name="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="" autocomplete="new-password" />
                        <!-- error message -->
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    </div>
                    <!-- password_confirmation -->
                    <div class="form-group">
                        <label for="input_user_password_confirmation" class="font-weight-bold">
                            Password confirmation
                        </label>
                        <input id="input_user_password_confirmation" name="password_confirmation" type="password"
                            class="form-control" placeholder="" autocomplete="new-password" />
                        <!-- error message -->
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning px-4 mx-2" href="">
                            Back
                        </a>
                        <button type="submit" class="btn btn-primary float-right px-4">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
