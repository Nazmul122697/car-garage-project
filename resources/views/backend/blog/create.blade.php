@extends('backend.master')

@section('title')
 Blog Create
@endsection

@push('css')
    <!-- Dropify css cdn link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" rel="stylesheet" />
    <!-- summernote css cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css">
@endpush

@section('content')
    <!-- main body content start -->
    <div class="main-container">
        <div class="d-flex justify-content-end mb-5">
            <a href="{{ route('blogs.index') }}" class="btn btn-application">
                <i class="fa-regular fa-eye puls-app"></i>
                View
            </a>
        </div>
        <div class="mx-5 p-4 shadow">
            <h6 class="text-uppercase fw-semibold text-center">Create Blogs</h6>
            <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!--title start-->
                    <div class="col-12 mb-3 login-field">
                        <label for="title" class="mb-2">Title <abbr class="required text-danger">*</abbr></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            placeholder="Enter blog title"
                            class="form-control py-2 small-text-12 @error('title') is-invalid @enderror" />
                        @error('title')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--title end-->

                    <!--description start-->
                    <div class="col-12 mb-3 login-field">
                        <label for="description" class="mb-2">Description <abbr
                                class="required text-danger">*</abbr></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="summernote"
                            rows="10">{{old('description')}}</textarea>
                        @error('description')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--description end-->

                    <!--image start-->
                    <div class="form-group mb-3 col-12 login-field">
                        <label for="file" class="mb-2">Image <sup class="text-danger">*(size must be 351*250)</sup></label>
                        <div>
                            <input type="file" id="file" name="image" data-height="150"
                                class="@error('image') is-invalid @enderror" autocomplete="off" accept="image/*" />
                            @error('image')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!--image end-->

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

@push('js')
    <!-- dropify js cdn link-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <!-- summernote Js cdn link-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>
    <!-- custom js -->
    <script>
        $(document).ready(function() {
            $("#file").dropify();
            $("#summernote").summernote({
                height: 300,
            });
        });
    </script>
@endpush
