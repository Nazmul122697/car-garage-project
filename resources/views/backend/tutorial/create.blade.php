@extends('backend.master')

@section('content')
    <!-- main body content start -->
    <div class="main-container">
        <div class="d-flex justify-content-end mb-5">
            <a href="{{ route('tutorials.index') }}" class="btn btn-application">
                <i class="fa-regular fa-eye puls-app"></i>
                View
            </a>
        </div>
        <div class="mx-5 p-4 shadow">
            <h6 class="text-uppercase fw-semibold text-center">Create tutorials</h6>
            <form action="{{ route('tutorials.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!--title start-->
                    <div class="col-12 mb-3 login-field">
                        <label for="title" class="mb-2">Title <abbr class="required text-danger">*</abbr></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            placeholder="Enter tutorial title"
                            class="form-control py-2 small-text-12 @error('title') is-invalid @enderror" />
                        @error('title')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--title end-->

                    <!--url start-->
                    <div class="col-12 mb-3 login-field">
                        <label for="url" class="mb-2">Url(<abbr class="required text-danger">Embed</abbr>)</label>
                        <input type="text" name="url" id="url" value="{{ old('url') }}"
                            placeholder="Enter tutorial url"
                            class="form-control py-2 small-text-12 @error('url') is-invalid @enderror" />
                        @error('url')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--url end-->

                    <!--status start-->
                    <div class="form-check form-switch d-flex align-items-center gap-2 languge-content mb-3">
                        <div>
                            <input class="form-check-input language-btn ms-0 mt-0" name="status" type="checkbox"
                                role="switch" checked />
                        </div>
                        <p class="">Status</p>
                    </div>
                    <!--status end-->

                    <!--submit btn start-->
                    <div class="form-group mb-2 mb-3">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light px-4 fw-medium">
                                Save
                            </button>
                        </div>
                    </div>
                    <!--submit btn end-->

                </div>
            </form>
        </div>
    </div>
    <!-- main body content end -->
@endsection


