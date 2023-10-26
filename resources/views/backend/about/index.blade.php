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
            <h6 class="text-uppercase fw-semibold text-center">
                {{@$about ? 'Update' : 'Create'}} Abouts</h6>
            <form action="{{ route('abouts.update',$about->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!--Image-->
                <div class="row">
                     <!--image start-->
                     <div class="form-group mb-3 col-12 login-field">
                        <label for="file" class="mb-2">Image <sup class="text-danger">*</sup></label>
                        <div>
                            <input type="file" id="file" name="image" data-height="300"
                                class="@error('image') is-invalid @enderror" autocomplete="off" accept="image/*"
                                data-default-file="{{@$about->image ? asset('upload/about/'.$about->image) : ''}}" />
                            @error('image')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!--image end-->
                </div>

                <!--History-->
                <div class="row">
                    <!--History start-->
                    <div class="col-md-6 mb-3 login-field">
                        <label for="history" class="mb-2">History <abbr
                                class="required text-danger">*</abbr></label>
                        <textarea class="form-control @error('history') is-invalid @enderror" name="history"
                            rows="10">{{@$about->history ?? old('history')}}</textarea>
                        @error('history')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--History end-->

                    <!--History Bangla start-->
                    <div class="col-md-6 mb-3 login-field">
                        <label for="history_bn" class="mb-2">History Bangla <abbr
                                class="required text-danger">*</abbr></label>
                        <textarea class="form-control @error('history_bn') is-invalid @enderror" name="history_bn"
                            rows="10">{{@$about->history_bn ?? old('history_bn')}}</textarea>
                        @error('history_bn')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--History end-->
                </div>

                <!--Mission-->
                <div class="row">
                    <!--Mission start-->
                    <div class="col-md-6 mb-3 login-field">
                        <label for="mission" class="mb-2">Mission <abbr
                                class="required text-danger">*</abbr></label>
                        <textarea class="form-control @error('mission') is-invalid @enderror" name="mission"
                            rows="10">{{@$about->mission ?? old('mission')}}</textarea>
                        @error('mission')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Mission end-->

                    <!--Mission Bangla start-->
                    <div class="col-md-6 mb-3 login-field">
                        <label for="mission_bn" class="mb-2">Mission Bangla <abbr
                                class="required text-danger">*</abbr></label>
                        <textarea class="form-control @error('mission_bn') is-invalid @enderror" name="mission_bn"
                            rows="10">{{@$about->mission_bn ?? old('mission_bn')}}</textarea>
                        @error('mission_bn')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Mission end-->
                </div>

                <!--Vision-->
                <div class="row">
                    <!--Vision start-->
                    <div class="col-md-6 mb-3 login-field">
                        <label for="vision" class="mb-2">Vision <abbr
                                class="required text-danger">*</abbr></label>
                        <textarea class="form-control @error('vision') is-invalid @enderror" name="vision"
                            rows="10">{{@$about->vision ?? old('vision')}}</textarea>
                        @error('vision')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Vision end-->

                    <!--Vision Bangla start-->
                    <div class="col-md-6 mb-3 login-field">
                        <label for="vision_bn" class="mb-2">Vision Bangla <abbr
                                class="required text-danger">*</abbr></label>
                        <textarea class="form-control @error('vision_bn') is-invalid @enderror" name="vision_bn"
                            rows="10">{{@$about->vision_bn ?? old('vision_bn')}}</textarea>
                        @error('vision_bn')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Vision end-->
                </div>

                <!--strategy-->
                <div class="row">
                    <!--Strategy start-->
                    <div class="col-md-6 mb-3 login-field">
                        <label for="strategy" class="mb-2">Strategy <abbr
                                class="required text-danger">*</abbr></label>
                        <textarea class="form-control @error('strategy') is-invalid @enderror" name="strategy"
                            rows="10">{{@$about->strategy ?? old('strategy')}}</textarea>
                        @error('strategy')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Strategy end-->

                    <!--Strategy Bangla start-->
                    <div class="col-md-6 mb-3 login-field">
                        <label for="strategy_bn" class="mb-2">Strategy Bangla <abbr
                                class="required text-danger">*</abbr></label>
                        <textarea class="form-control @error('strategy_bn') is-invalid @enderror" name="strategy_bn"
                            rows="10">{{@$about->strategy_bn ?? old('strategy_bn')}}</textarea>
                        @error('strategy_bn')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Strategy end-->
                </div>

                <!--Goals-->
                <div class="row">
                    <!--Goals start-->
                    <div class="col-md-6 mb-3 login-field">
                        <label for="goals" class="mb-2">Goals <abbr
                                class="required text-danger">*</abbr></label>
                        <textarea class="form-control @error('goals') is-invalid @enderror" name="goals"
                            rows="10">{{@$about->goals ?? old('goals')}}</textarea>
                        @error('goals')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Goals end-->

                    <!--Goals Bangla start-->
                    <div class="col-md-6 mb-3 login-field">
                        <label for="goals_bn" class="mb-2">Goals Bangla <abbr
                                class="required text-danger">*</abbr></label>
                        <textarea class="form-control @error('goals_bn') is-invalid @enderror" name="goals_bn"
                            rows="10">{{@$about->goals_bn ?? old('goals_bn')}}</textarea>
                        @error('goals_bn')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Goals end-->
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
