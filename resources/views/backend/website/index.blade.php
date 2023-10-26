@extends('backend.master')

@push('css')
    <!-- Dropify css cdn link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" rel="stylesheet" />
    <style>
        .dropify-message p {
            font-size: 18px;
        }
    </style>
@endpush

@section('content')
    <!-- main body content start -->
    <div class="main-container">
        <div class="mx-2 p-4 shadow">
            <h6 class="text-uppercase fw-semibold text-center mb-4">
                {{ @$website ? 'Update' : 'Create' }} Website</h6>
            <form action="{{ route('websites.update', $website->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!--Phone1 start-->
                    <div class="col-6 mb-3 login-field">
                        <label for="phone1" class="mb-2">Phone1 <abbr class="required text-danger">*</abbr></label>
                        <input type="text" name="phone1" id="phone1" value="{{ @$website->phone1 ?? old('phone1') }}"
                            placeholder="Enter phone number"
                            class="form-control py-2 small-text-12 @error('phone1') is-invalid @enderror" />
                        @error('phone1')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Phone1 end-->

                    <!--Phone2 start-->
                    <div class="col-6 mb-3 login-field">
                        <label for="phone2" class="mb-2">Phone2 <abbr class="required text-danger">*</abbr></label>
                        <input type="text" name="phone2" id="phone2" value="{{ @$website->phone2 ?? old('phone2') }}"
                            placeholder="Enter phone number"
                            class="form-control py-2 small-text-12 @error('phone2') is-invalid @enderror" />
                        @error('phone2')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Phone2 end-->
                </div>
                <!--row end-->

                <div class="row">
                    <!--Email start-->
                    <div class="col-4 mb-3 login-field">
                        <label for="email" class="mb-2">Email <abbr class="required text-danger">*</abbr></label>
                        <input type="text" name="email" id="email" value="{{ @$website->email ?? old('email') }}"
                            placeholder="Enter email"
                            class="form-control py-2 small-text-12 @error('email') is-invalid @enderror" />
                        @error('email')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Email end-->

                    <!--Reprting Email start-->
                    <div class="col-4 mb-3 login-field">
                        <label for="reporting_email" class="mb-2">Reprting Email <abbr class="required text-danger">*</abbr></label>
                        <input type="text" name="reporting_email" id="reporting_email" value="{{ @$website->reporting_email ?? old('reporting_email') }}"
                            placeholder="Enter reporting email"
                            class="form-control py-2 small-text-12 @error('reporting_email') is-invalid @enderror" />
                        @error('reporting_email')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Reprting Email end-->

                    <!--Complain / Feedback Email start-->
                    <div class="col-4 mb-3 login-field">
                        <label for="feedback_email" class="mb-2">Complain / Feedback Email <abbr class="required text-danger">*</abbr></label>
                        <input type="text" name="feedback_email" id="feedback_email" value="{{ @$website->feedback_email ?? old('feedback_email') }}"
                            placeholder="Enter feedback email"
                            class="form-control py-2 small-text-12 @error('feedback_email') is-invalid @enderror" />
                        @error('feedback_email')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Complain / Feedback Email end-->
                </div>

                <div class="row">
                    <!--Copyright start-->
                    <div class="col-12 mb-3 login-field">
                        <label for="copyright" class="mb-2">Copyright <abbr class="required text-danger">*</abbr></label>
                        <textarea name="copyright" id="copyright" placeholder="Enter your copyright text"
                            class="form-control py-2 small-text-12 @error('copyright') is-invalid @enderror">
                            {{ @$website->copy_right ?? old('copyright') }}

                        </textarea>
                        @error('copyright')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Copyright end-->
                </div>
                <!--row end-->

                <div class="row">
                    <!--Facebook start-->
                    <div class="col-6 mb-3 login-field">
                        <label for="facebook" class="mb-2">Facebook <abbr class="required text-danger">*</abbr></label>
                        <input type="text" name="facebook" id="facebook"
                            value="{{ @$website->facebook ?? old('facebook') }}" placeholder="Enter facebook url"
                            class="form-control py-2 small-text-12 @error('facebook') is-invalid @enderror" />
                        @error('facebook')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Facebook end-->

                    <!--Linkedin start-->
                    <div class="col-6 mb-3 login-field">
                        <label for="linkedin" class="mb-2">Linkedin <abbr class="required text-danger">*</abbr></label>
                        <input type="text" name="linkedin" id="linkedin"
                            value="{{ @$website->linkedin ?? old('linkedin') }}" placeholder="Enter linkedin url"
                            class="form-control py-2 small-text-12 @error('linkedin') is-invalid @enderror" />
                        @error('linkedin')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Linkedin end-->
                </div>
                <!--row end-->


                <div class="row">
                    <!--Youtube start-->
                    <div class="col-6 mb-3 login-field">
                        <label for="youtube" class="mb-2">Youtube <abbr class="required text-danger">*</abbr></label>
                        <input type="text" name="youtube" id="youtube"
                            value="{{ @$website->youtube ?? old('youtube') }}" placeholder="Enter youtube url"
                            class="form-control py-2 small-text-12 @error('youtube') is-invalid @enderror" />
                        @error('youtube')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Youtube end-->

                    <!--Labs start-->
                    <div class="col-6 mb-3 login-field">
                        <label for="lab" class="mb-2">Labs <abbr class="required text-danger">*</abbr></label>
                        <input type="number" name="lab" id="lab" value="{{ @$website->lab ?? old('lab') }}"
                            placeholder="Enter lab quantity"
                            class="form-control py-2 small-text-12 @error('lab') is-invalid @enderror" />
                        @error('lab')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Labs end-->
                </div>
                <!--row end-->


                <div class="row">
                    <!--Parameter start-->
                    <div class="col-6 mb-3 login-field">
                        <label for="parameter" class="mb-2">Parameter <abbr
                                class="required text-danger">*</abbr></label>
                        <input type="text" name="parameter" id="parameter"
                            value="{{ @$website->parameter ?? old('parameter') }}" placeholder="Enter parameter quantity"
                            class="form-control py-2 small-text-12 @error('parameter') is-invalid @enderror" />
                        @error('parameter')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Parameter end-->

                    <!--Food types start-->
                    <div class="col-6 mb-3 login-field">
                        <label for="food_type" class="mb-2">Food Types <abbr
                                class="required text-danger">*</abbr></label>
                        <input type="number" name="food_type" id="food_type"
                            value="{{ @$website->food_type ?? old('food_type') }}" placeholder="Enter food_type quantity"
                            class="form-control py-2 small-text-12 @error('food_type') is-invalid @enderror" />
                        @error('food_type')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Food types end-->
                </div>
                <!--row end-->

                <div class="row">
                    <!--Logo start-->
                    <div class="col-6 mb-3 login-field">
                        <label for="logo" class="mb-2">Logo <abbr class="required text-danger">*</abbr></label>
                        <input type="file" class="form-control-file @error('logo') is-invalid @enderror dropify"
                            data-default-file="{{ @$website->logo ? asset('upload/website/' . $website->logo) : '' }}"
                            id="logo" name="logo">
                        @error('logo')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Logo end-->

                    <!--Favicon start-->
                    <div class="col-6 mb-3 login-field">
                        <label for="favicon" class="mb-2">Favicon <abbr class="required text-danger">*</abbr></label>
                        <input type="file" class="form-control-file @error('favicon') is-invalid @enderror dropify"
                            data-default-file="{{ $website->favicon ? asset('upload/website/' . $website->favicon) : '' }}"
                            id="favicon" name="favicon">
                        @error('favicon')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Favicon end-->
                </div>
                <!--row end-->

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
                <!--row end-->
            </form>
            <!--form end-->
        </div>
    </div>

    <!-- main body content end -->
@endsection

@push('js')
    <!-- dropify js cdn link-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

    <!-- custom js -->
    <script>
        $(document).ready(function() {
            $(".dropify").dropify();
        });
    </script>
@endpush
