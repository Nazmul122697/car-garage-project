@extends('backend.auth.master')

@section('title')
    Register
@endsection

@section('content')
    <aside class="side-container">
        <div class="side-bg">
            <!-- <img src="{{ asset('/') }}backend/asset/image/side-reg.svg" alt="shape" /> -->
            <div class="side-content">
                <div class="d-flex flex-column align-items-center text-center">
                    <div class="side-logo">
                        <img src="{{ asset('/') }}backend/asset/logo/home-logo1.png" alt="logo" />
                    </div>
                    <div class="side-area-text">
                        <h5>Welcome to the</h5>
                        <p>E-Health Certification System</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <section class="register-container">
        <div class="container">

            <div class="registers-form">
                <h2 class="mb-5 text-center text-lg-start title">Exporter Registration</h2>
                <!--Form start-->
                <form action="{{ route('registration.valid') }}" method="POST">
                    @csrf
                    <div class="row g-3">

                        <!--Contact person name start-->
                        <div class="col-12 col-lg-12 login-field">
                            <label for="contact-person" class="mb-2">Contact Person
                                <abbr class="required text-danger">*</abbr></label>
                            <input type="text" name="name" id="contact-person"
                                placeholder="Enter contact person name"
                                value="{{old('name')}}"
                                class="form-control input-style py-2 small-text-12
                                @error('name') is-invalid @enderror"
                                required />

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--Contact person name end-->

                        <!--Email start-->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="email" class="mb-2">Email Address <abbr class="required text-danger">*</abbr>
                            </label>
                            <input type="email" name="email" id="email"
                                placeholder="Enter your email"
                                value="{{old('email')}}"
                                class="form-control input-style py-2 small-text-12 @error('email') is-invalid @enderror"
                                required />

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--Email end-->

                        <!--Mobile number start-->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="mobile-no" class="mb-2">Mobile No. <abbr
                                    class="required text-danger">*</abbr></label>
                            <input type="tel" name="phone" id="mobile-no"
                                placeholder="Enter mobile no." required
                                value="{{old('phone')}}"
                                class="form-control input-style py-2 small-text-12
                                @error('phone') is-invalid @enderror" min="11"
                                required />
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--Mobile number end-->

                        <!-- Division start -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="division" class="mb-2">Division</label>

                            <select id="division" name="division" class="select2 @error('division') is-invalid @enderror"
                                required placeholder="Division...">
                                <option value="" selected disabled>Division...</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}" {{$division->id == old('division') ? 'selected' : ''}}>
                                        {{ $division->name }}({{ $division->bn_name }})
                                    </option>
                                @endforeach
                            </select>

                            @error('division')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- Division end -->

                        <!--District start-->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="district" class="mb-2">District</label>

                            <select id="district" name="district" class="select2 @error('district') is-invalid @enderror"  required
                                placeholder="District...">
                                <option value="" selected disabled>District...</option>

                            </select>
                            @error('district')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--District end-->

                        <!--Register btn start-->
                        <div class="mt-5">
                            <button class="register-btn" type="submit">Register</button>
                        </div>
                        <!--Register btn end-->
                    </div>
                </form>
                <!--Form end-->

                <div class="form-button-area">
                    <div>
                        <hr class="horizontal-line" />
                    </div>
                    <!--Login btn start-->
                    <div>
                        <a href="{{ route('login') }}">
                            <button class="login-btn">Login</button>
                        </a>
                    </div>
                    <!--Login btn end-->
                </div>
            </div>

        </div>
    </section>
@endsection

@push('js')
    <script>
        $('document').ready(function() {

            $('#division').change(function() {
                let divisionId = $(this).find('option:selected').val();
                let districtId = $('#district').empty();
                $.ajax({
                    url: "{{ url('register/get-district') }}",
                    type: "get",
                    data: {
                        division_id: divisionId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        var html = `<option selected disabled>Select District</option>`;
                        $.each(result, function(key, value) {
                            html += `<option value="` + value.id + `">` + value.name + `(`+value.bn_name+`)` + `</option>`
                            districtId.empty();
                            districtId.append(html);
                        });
                    },
                    error: function(error){

                    }
                });
            });
        })
    </script>
@endpush
