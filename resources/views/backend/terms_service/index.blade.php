@extends('backend.master')

@push('css')
    <!-- Dropify css cdn link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" rel="stylesheet" />
    <!-- summernote css cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css">
@endpush

@section('content')
    <!-- main body content start -->
    <div class="main-container">
        <div class="mx-2 p-4 shadow">
            <h6 class="text-uppercase fw-semibold text-center mb-4">
                Update Term of services</h6>
            <form action="{{ route('term-services.update',$termService->id) }}" method="post">
                @csrf
                @method('PUT')
                <!--Image-->

                <!--History-->
                <div class="row">
                    <!--Description start-->
                    <div class="col-md-6 mb-3 login-field">
                        <label for="description" class="mb-2">Description <abbr
                                class="required text-danger">*</abbr></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                            rows="10">{{@$termService->description ?? old('description')}}</textarea>
                        @error('description')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Description end-->

                    <!--Description Bangla start-->
                    <div class="col-md-6 mb-3 login-field">
                        <label for="description_bn" class="mb-2">Description Bangla <abbr
                                class="required text-danger">*</abbr></label>
                        <textarea class="form-control @error('description_bn') is-invalid @enderror" name="description_bn"
                            rows="10">{{@$termService->description_bn ?? old('description_bn')}}</textarea>
                        @error('description_bn')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Description end-->
                </div>

                <div class="row">
                    <!--submit btn start-->
                    <div class="form-group mb-2 mb-3">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light px-4 fw-medium">
                               Update
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
