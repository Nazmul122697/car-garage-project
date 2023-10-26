@extends('backend.master')

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" rel="stylesheet">
    <style>
        /* .form-switch{
            padding-left: 0rem !important;
        } */

        .dropify-message p {
            font-size: 18px;
        }
    </style>
@endpush

@section('content')
<div class="main-container">
    <div class="all-application-content">
        <h1 class="page-title">Create User</h1>
        <div>
            <a href="{{ route('users.index') }}" class="btn btn-application">
                <i class="fa-regular fa-eye puls-app"></i>
                View
            </a>
        </div>
    </div>

    <div class="p-4 shadow">
        {{-- <h6 class="text-uppercase fw-semibold text-center">Create Blog</h6> --}}
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card" style="padding: 10px;">
                    <form method="POST"
                        action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        @isset($user)
                            @method('PUT')
                        @endisset
                        <div class="row">
                            <div class="col-md-8">
                                <div class="main-card mb-3 card shadow" style="padding: 10px;">
                                    <div class="card-body">
                                        <h5 class="page-title mb-2">User Info</h5>

                                        <div class="form-group mb-3 col-md-12 login-field">
                                            <label for="name">Name <sup class="text-danger">*</sup></label>
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ $user->name ?? old('name') }}" placeholder="Enter user name"
                                                autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3 col-md-12 login-field">
                                            <label for="email">Email <sup class="text-danger">*</sup></label>
                                            <input id="email" type="text"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ $user->email ?? old('email') }}"
                                                placeholder="Enter user email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3 col-md-12 login-field">
                                            <label for="password">Password <sup class="text-danger">*</sup></label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" placeholder="Enter user password" autofocus>

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3 col-md-12 login-field">
                                            <label for="confirm_password">Confirm Password <sup
                                                    class="text-danger">*</sup></label>
                                            <input id="confirm_password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password_confirmation" placeholder="Re-Type password" autofocus>

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group mb-3 col-md-12 login-field">
                                                <label for="phone">Phone <sup class="text-danger">*</sup></label>
                                                <input id="phone" type="text"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    name="phone" value="{{ $user->phone ?? old('phone') }}"
                                                    placeholder="Enter user phone" autofocus>

                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="main-card mb-3 card shadow" style="padding: 10px;">
                                    <div class="card-body">
                                        <h5 class="page-title mb-2">Select Roles and Status</h5>

                                        <div class="form-group mb-3 col-md-12 login-field">
                                            <label for="role">Role <sup class="text-danger">*</sup></label>
                                            <select id="role"
                                                class="form-control select2 @error('role') is-invalid @enderror"
                                                name="role" autofocus>
                                                <option value="">Select role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ @$user->role->id == $role->id ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('role')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3 col-md-12 login-field">
                                            <label for="avatar">Avatar <sup class="text-danger">*</sup></label>
                                            <input id="avatar" type="file"
                                                class="dropify form-control @error('avatar') is-invalid @enderror"
                                                name="avatar" data-height="160" autofocus
                                                data-default-file="{{ @$user->avatar != null ? asset('upload/profile/' . @$user->avatar) : '' }}" accept="image/*">

                                            @error('avatar')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-check form-switch  d-flex align-items-center gap-2 languge-content mb-3" style="padding-left: 1.5rem">
                                            <div>
                                              <input class="form-check-input language-btn ms-0 mt-0" type="checkbox" role="switch" name="status"
                                              id="status" checked>
                                            </div>
                                            <p class="" for="status">Status</p>
                                        </div>

                                        <div class="form-group mb-3 col-md-12 login-field">
                                            <button type="submit" class="btn btn-save">
                                                <i
                                                    class="fa {{ @$user ? 'fa-arrow-circle-up' : 'fa-plus-circle' }}"></i>
                                                <span>{{ @$user ? 'Update User' : 'Save User' }}</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify();
    </script>
@endpush
