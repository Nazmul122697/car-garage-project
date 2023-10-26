@extends('backend.master')

@push('css')
    <!-- Dropify cdn link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" rel="stylesheet" />
@endpush

@section('content')
    <!-- main body content start -->
    <div class="main-container">
        <div class="d-flex justify-content-end mb-5">
            <a href="{{ route('sliders.index') }}" class="btn btn-application">
                <i class="fa-regular fa-eye puls-app"></i>
                View
            </a>
        </div>
        <div class="mx-5 p-4 shadow">
            <h6 class="text-uppercase fw-semibold text-center">Update Slider</h6>
            <form action="{{ route('sliders.update',$slider->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <!--title start-->
                    <div class="col-12 mb-3 login-field">
                        <label for="title" class="mb-2">Title <abbr class="required text-danger">*</abbr></label>
                        <input type="text" name="title" id="title" value="{{ @$slider->title }}"
                            placeholder="Enter slide title"
                            class="form-control py-2 small-text-12 @error('title') is-invalid @enderror" />
                        @error('title')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--title end-->

                    <!--image start-->
                    <div class="form-group mb-3 col-12 login-field">
                        <label for="file" class="mb-2">Image <sup class="text-danger">*</sup></label>
                        <div>
                            <input type="file" id="file" name="image" data-height="150"
                                class="@error('image') is-invalid @enderror"
                                 data-default-file="{{@$slider->image ? asset('upload/slider/'.$slider->image) : ''}}" autocomplete="off" accept="image/*"/>
                            @error('image')
                                <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!--image end-->

                    <!--status start-->
                    <div class="form-check form-switch d-flex align-items-center gap-2 languge-content mb-3">
                        <div>
                            <input class="form-check-input language-btn ms-0 mt-0"
                            name="status" type="checkbox" role="switch"
                                {{@$slider->status == 1 ? 'checked' : ''}}/>
                        </div>
                        <p class="">Status</p>
                    </div>
                    <!--status end-->

                    <!--submit btn start-->
                    <div class="form-group mb-2 mb-3">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light px-4 fw-medium">
                                update
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
    <!-- dropify -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <!-- custom js -->
    <script>
        $("#file").dropify();
        $("#summernote").summernote({
            height: 300,
        });
    </script>
@endpush
