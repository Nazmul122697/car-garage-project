@extends('backend.master')

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" rel="stylesheet">
    <style>
        .dropify-message p {
            font-size: 18px;
        }
    </style>
@endpush

@section('content')
    <!-- main body content start -->
    <div class="main-container">
        <div class="dashboard-edit-profile-container shadow p-5 rounded-4">
            <!-- Form start -->
            <form id="form"
                action="{{ Auth::user()->role_id != 2 ? route('profile.update') : route('customer.profile.update') }}"
                method="post" enctype="multipart/form-data">
                @csrf

                <section class="mb-5 d-flex justify-content-between">
                    <!-- customer profile info -->
                    <div class="d-flex align-items-center gap-4">
                        <div id="profile" class="profile-upload">
                            <input type="file" name="image" id="profile-img" accept="image/*"
                                class="d-none profile-edited" data-bs-toggle="modal" data-bs-target="#showModal" disabled />
                            <label for="profile-img" class="edit-profile-img">
                                <img src="{{ @Auth::user()->avatar ? asset('upload/profile/' . Auth::user()->avatar) : asset('/backend/asset/icon/user-avatar.svg') }}"
                                    alt="avatar" />
                                <div class="profile-camera-icon">
                                    <i class="bi bi-camera-fill"></i>
                                </div>
                            </label>
                        </div>
                        <div>
                            <h2 class="mb-3 text-center text-lg-start dashboard-payment-title">
                                My Profile
                            </h2>
                            <div class="db-profile-info d-flex flex-column gap-1">
                                <p class="small-text-14">{{ Auth::user()->name }}</p>
                                <p class="small-text-10">
                                    User Type: <span>{{ Auth::user()->role->name }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button onclick="editProfile()" type="button" title="Edit Profile"
                            class="bg-transparent border-0 fs-5">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </div>
                </section>

                <!-- customer profile end -->
                @if (Auth::user()->role_id != 2)
                    <!--BFSA User Profile Info Start-->
                    <div class="row g-3">
                        <!-- applicant name -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="applicant" class="mb-2">Name of the applicant</label>
                            <input type="text" name="name" id="applicant" value="{{ @Auth::user()->name ?? 'N/A' }}"
                                placeholder="Enter full name" disabled
                                class="form-control input-style py-2 small-text-12 profile-edited @error('name') is-invalid @enderror" />

                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- designation -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="" class="mb-2">Designation</label>
                            <input type="text" name="designation" id=""
                                value="{{ @Auth::user()->designation ?? 'N/A' }}" disabled
                                placeholder="Enter your designation"
                                class="form-control input-style py-2 small-text-12 profile-edited @error('designation')
                                is-invalid
                                @enderror" />
                            @error('designation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- contact num -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="phone" class="mb-2">Contact Number</label>
                            <input type="text" name="phone" id="phone" value="{{ @Auth::user()->phone ?? 'N/A' }}"
                                disabled placeholder="Enter contact number"
                                class="form-control input-style py-2 small-text-12 profile-edited @error('phone') is-invalid @enderror" />

                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- email Address -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="email" class="mb-2">Email</label>
                            <input type="email" name="email" id="email" value="{{ @Auth::user()->email }}"
                                placeholder="Enter email address" disabled
                                class="form-control input-style py-2 small-text-12 profile-edited @error('email') is-invalid @enderror" />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- division -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="division" class="mb-2">Division</label>
                            <select id="division" name="division"
                                class="form-select select2 profile-edited @error('division') is-invalid @enderror" disabled
                                placeholder="Division...">
                                <option value="" selected disabled>Division...</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}"
                                        {{ @Auth::user()->division == $division->id ? 'selected' : '' }}>
                                        {{ $division->name }}({{ $division->bn_name }})
                                    </option>
                                @endforeach
                            </select>

                            @error('division')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                        <!-- district -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="district" class="mb-2">District</label>
                            <select id="district" name="district"
                                class="form-select select2 profile-edited @error('district') is-invalid @enderror" disabled>
                                <option value="" selected disabled>District...</option>
                                @foreach ($districts as $district)
                                <option value="{{ $district->id }}"
                                    {{ @Auth::user()->district == $district->id ? 'selected' : '' }}>
                                    {{ $district->name }}({{ $district->bn_name }})
                                </option>
                                @endforeach
                            </select>

                            @error('district')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                        @if (Auth::user()->role_id == 6)
                            <!-- Signature -->
                            <div class="col-12 col-lg-6 login-field">
                                <label for="signature" class="mb-2">Upload Signature</label>
                                <input type="file" id="signature" name="signature" data-height="100" disabled
                                    class="dropify profile-edited @error('signature') is-invalid @enderror"
                                    data-default-file="{{ Auth::user()->signature ? asset('upload/signature/' . @Auth::user()->signature) : '' }}"
                                    accept="image/*" />

                                @error('signature')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <!-- Seal -->
                            <div class="col-12 col-lg-6 login-field">
                                <label for="seal" class="mb-2">Upload Seal</label>
                                <input type="file"name="seal" data-height="100"
                                    class="dropify profile-edited @error('seal') is-invalid @enderror" autocomplete="off"
                                    data-default-file="{{@Auth::user()->seal ? asset('upload/seal/' . @Auth::user()->seal) : '' }}"
                                    accept="image/*" disabled/>

                                @error('seal')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        @endif


                    </div>
                    <!--BFSA User Profile Info End-->
                @else
                    <div class="row g-3">
                        <!-- applicant name -->
                        <div class="col-12 col-lg-6 login-field d-none applicantName">
                            <label for="applicant" class="mb-2">Name of the applicant</label>
                            <input type="text" name="name" id="applicant" value="{{ @Auth::user()->name }}"
                                placeholder="Enter your full name" disabled
                                class="form-control input-style py-2 small-text-12 profile-edited @error('name') is-invalid @enderror" />
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Comapny name -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="company_name" class="mb-2">Comapny name</label>
                            <input type="text" name="company_name" id="company_name"
                                value="{{ @Auth::user()->customerDetail->company_name }}" disabled
                                placeholder="Enter company name"
                                class="form-control input-style py-2 small-text-12 profile-edited @error('company_name') is-invalid  @enderror" />
                            @error('company_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Nature of Comapny -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="nature" class="mb-2">Nature of Comapny</label>
                            <select id="nature" name="nature"
                                class="form-select select2 input-style profile-edited @error('nature') is-invalid @enderror"
                                disabled>
                                <option value="" selected disabled>Nature...</option>
                                @foreach ($natures as $nature)
                                    <option value="{{ $nature->id }}"
                                        {{ @Auth::user()->customerDetail->nature == $nature->id ? 'selected' : '' }}>
                                        {{ $nature->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nature')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- contact num -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="phone" class="mb-2">Contact Number</label>
                            <input type="text" name="phone" id="phone"
                                value="{{ @Auth::user()->phone ?? 'N/A' }}" disabled placeholder="Enter contact number"
                                class="form-control input-style py-2 small-text-12 profile-edited @error('phone') is-invalid @enderror" />
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- email Address -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="email" class="mb-2">Email</label>
                            <input type="email" name="email" id="email"
                                value="{{ @Auth::user()->email ?? 'N/A' }}" placeholder="Enter email address" disabled
                                class="form-control input-style py-2 small-text-12 profile-edited @error('email') is-invalid @enderror" />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- division -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="division" class="mb-2">Division</label>
                            <select id="division" name="division"
                                class="form-select select2 profile-edited @error('division') is-invalid @enderror"
                                disabled placeholder="Division...">
                                <option value="" selected disabled>Division...</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}"
                                        {{ @Auth::user()->division == $division->id ? 'selected' : '' }}>
                                        {{ $division->name }}({{ $division->bn_name }})
                                    </option>
                                @endforeach
                            </select>
                            @error('division')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- District -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="district" class="mb-2">District</label>
                            <select id="district" name="district"
                                class="form-select select2 profile-edited @error('district') is-invalid @enderror"
                                disabled placeholder="District...">
                                <option value="" selected disabled>District...</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ @Auth::user()->district == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}({{ $district->bn_name }})
                                    </option>
                                @endforeach
                            </select>
                            @error('district')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                        <!-- Country -->
                        {{-- <div class="col-12 col-lg-12 login-field">
                            <label for="country" class="mb-2">Country</label>
                            <select id="country" name="country"
                                class="form-select select2 profile-edited @error('country') is-invalid @enderror"
                                disabled placeholder="country...">
                                <option value="" selected disabled>Country...</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ @Auth::user()->country == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('country')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div> --}}

                        <!-- NID Number -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="nid_no" class="mb-2">NID Number</label>
                            <input type="text" name="nid_no" id="nid_no"
                                value="{{ @Auth::user()->customerDetail->nid_no ?? 'N/A' }}" disabled
                                placeholder="Enter your nid number"
                                class="form-control input-style py-2 small-text-12 profile-edited @error('nid_no') is-invalid @enderror" />
                            @error('nid_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- NID File -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="nid_file" class="mb-2">NID Card</label>
                            <div>
                                <input type="file" name="nid_file" id="nid_file"
                                    class="form-control py-2 small-text-12 d-none remove-d-none @error('nid_file') is-invalid @enderror"
                                    accept="application/pdf" />
                                <label class="upload-signature form-control input-style py-2 small-text-12 add-d-none">
                                    @if (@Auth::user()->customerDetail->nid_file)
                                        <a href="{{ route('customer.details.download', ['type' => 'nid']) }}"
                                            class="file__btn">
                                            <i class="fa-solid fa-arrow-up-from-bracket me-2"></i>
                                            <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                                            <span>{{ Auth::user()->customerDetail->nid_file }}</span>

                                        </a>
                                    @else
                                        <span class="ms-2">N/A</span>
                                    @endif
                                </label>
                                @error('nid_file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror


                            </div>
                        </div>


                        <!-- ERC Number -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="erc_no" class="mb-2">ERC Number</label>
                            <input type="text" name="erc_no" id="erc_no"
                                value="{{ @Auth::user()->customerDetail->erc_no ?? 'N/A' }}" disabled
                                placeholder="Enter your nid number"
                                class="form-control input-style py-2 small-text-12 profile-edited @error('erc_no') is-invalid @enderror" />
                            @error('erc_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- ERC Expiry Date -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="erc_expiry_date" class="mb-2">ERC Expiry Date</label>
                            <input type="date"
                                name="erc_expiry_date" id="erc_expiry_date"
                                value="{{ @Auth::user()->customerDetail->erc_expiry_date ?? ''}}" disabled required
                                min="{{ date('Y-m-d') }}"
                                class="form-control input-style py-2 small-text-12 profile-edited @error('erc_expiry_date') is-invalid @enderror" />
                            @error('erc_expiry_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- ERC File -->
                        <div class="col-12 col-lg-12 login-field">
                            <label for="erc_file" class="mb-2">ERC File</label>
                            <div>
                                <input type="file" name="erc_file" id="erc_file"
                                    class="form-control py-2 small-text-12 d-none remove-d-none @error('erc_file') is-invalid @enderror"
                                    accept="application/pdf" />
                                <label class="upload-signature form-control input-style py-2 small-text-12 add-d-none">
                                    @if (@Auth::user()->customerDetail->erc_file)
                                        <a href="{{ route('customer.details.download', ['type' => 'erc']) }}"
                                            class="file__btn">
                                            <i class="fa-solid fa-arrow-up-from-bracket me-2"></i>
                                            <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                                            <span>{{ Auth::user()->customerDetail->erc_file }}</span>

                                        </a>
                                    @else
                                        <span class="ms-2">N/A</span>
                                    @endif
                                </label>
                                @error('erc_file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>


                        <!-- Trade License Number -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="contact-num" class="mb-2">Trade License Number</label>
                            <input type="text" name="trade_no" id=""
                                value="{{ @Auth::user()->customerDetail->trade_no ?? 'N/A' }}" disabled
                                placeholder="Enter trade license number"
                                class="form-control input-style py-2 small-text-12 profile-edited @error('trade_no') is-invalid @enderror" />
                            @error('trade_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Trade License Expiry Date -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="trade_expiry_date" class="mb-2">Trade License Expiry Date</label>
                            <input type="date"
                                name="trade_expiry_date" id="trade_expiry_date"
                                value="{{ @Auth::user()->customerDetail->trade_expiry_date ?? '' }}" disabled required
                                min="{{ date('Y-m-d') }}"
                                class="form-control input-style py-2 small-text-12 profile-edited @error('trade_expiry_date') is-invalid @enderror" />
                            @error('trade_expiry_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Trade Certificate -->
                        <div class="col-12 login-field">
                            <label for="trade_file" class="mb-2">Trade Certificate</label>
                            <div>
                                <input type="file" name="trade_file" id="trade_file"
                                    class="form-control py-2 small-text-12 d-none remove-d-none @error('trade_file') is-invalid @enderror"
                                    accept="application/pdf" />
                                <label class="upload-signature form-control input-style py-2 small-text-12 add-d-none">
                                    @if (@Auth::user()->customerDetail->trade_file)
                                        <a href="{{ route('customer.details.download', ['type' => 'trade_license']) }}"
                                            class="file__btn">
                                            <i class="fa-solid fa-arrow-up-from-bracket me-2"></i>
                                            <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                                            <span>{{ Auth::user()->customerDetail->trade_file }}</span>

                                        </a>
                                    @else
                                        <span class="ms-2">N/A</span>
                                    @endif
                                </label>
                                @error('trade_file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- TIN Number -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="tin" class="mb-2">TIN Number</label>
                            <input type="text" name="tin_no" id="tin"
                                value="{{ @Auth::user()->customerDetail->tin_no ?? 'N/A' }}" disabled
                                placeholder="Enter company tin number"
                                class="form-control input-style py-2 small-text-12 profile-edited @error('tin_no') is-invalid @enderror" />
                            @error('tin_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!--TIN Expiry Date-->
                        <div class="col-12
                                col-lg-6 login-field">
                            <label for="tin_expiry_date" class="mb-2">TIN Expiry Date</label>
                            <input type="date"
                                name="tin_expiry_date" id=""
                                value="{{ @Auth::user()->customerDetail->tin_expiry_date ?? '' }}" disabled required
                                min="{{ date('Y-m-d') }}"
                                class="form-control input-style py-2 small-text-12 profile-edited @error('tin_expiry_date') is-invalid @enderror" />
                            @error('tin_expiry_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!--Upload TIN Certificate-->
                        <div class="col-12 login-field">
                            <label for="tin_file" class="mb-2">Upload TIN Certificate</label>
                            <div>
                                <input type="file" name="tin_file" id="tin_file"
                                    class="form-control py-2 small-text-12 d-none remove-d-none @error('tin_file') is-invalid @enderror"
                                    accept="application/pdf" />

                                <label class="upload-signature form-control input-style py-2 small-text-12 add-d-none">
                                    @if (@Auth::user()->customerDetail->tin_file)
                                        <a href="{{ route('customer.details.download', ['type' => 'tin']) }}"
                                            class="file__btn">
                                            <i class="fa-solid fa-arrow-up-from-bracket me-2"></i>
                                            <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                                            <span>{{ Auth::user()->customerDetail->tin_file }}</span>

                                        </a>
                                    @else
                                        <span class="ms-2">N/A</span>
                                    @endif
                                </label>
                                @error('tin_file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- BIN Number -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="bin_no" class="mb-2">BIN Number</label>
                            <input type="text" name="bin_no" id="bin_no"
                                value="{{ @Auth::user()->customerDetail->bin_no ?? 'N/A' }}" disabled
                                placeholder="Enter company bin number"
                                class="form-control input-style py-2 small-text-12 profile-edited @error('bin_no') is-invalid @enderror" />
                            @error('bin_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!--BIN Expiry Date -->
                        <div class="col-12 col-lg-6 login-field">
                            <label for="bin_expiry_date " class="mb-2">BIN Expiry Date</label>
                            <input type="date"
                                name="bin_expiry_date" id="bin_expiry_date "
                                value="{{ @Auth::user()->customerDetail->bin_expiry_date ?? '' }}" disabled required
                                min="{{ date('Y-m-d') }}"
                                class="form-control input-style py-2 small-text-12 profile-edited @error('bin_expiry_date') is-invalid @enderror" />
                            @error('bin_expiry_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Upload BIN Certificate-->
                        <div class="col-12 login-field">
                            <label for="bin_file" class="mb-2">Upload BIN Certificate</label>
                            <div>
                                <input type="file" name="bin_file" id="bin_file"
                                    class="form-control py-2 small-text-12 d-none remove-d-none @error('bin_file') is-invalid @enderror"
                                    accept="application/pdf" />
                                <label class="upload-signature form-control input-style py-2 small-text-12 add-d-none">
                                    @if (@Auth::user()->customerDetail->bin_file)
                                        <a href="{{ route('customer.details.download', ['type' => 'bin']) }}"
                                            class="file__btn">
                                            <i class="fa-solid fa-arrow-up-from-bracket me-2"></i>
                                            <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                                            <span>{{ Auth::user()->customerDetail->bin_file }}</span>

                                        </a>
                                    @else
                                        <span class="ms-2">N/A</span>
                                    @endif
                                </label>

                                @error('bin_file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif


                <div id="editBtnShow" class="search-btn mt-4 d-none">
                    <button type="submit" class="small-text-12">
                        Update and Save
                    </button>
                </div>
            </form>
            <!-- customer-form end -->
        </div>
    </div>
    <!-- main body content end -->

    <!--Profile image upload modal start-->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Update profile</h5>
                </div>
                <div class="modal-body">
                    <div class="" style="width: 100%;" id="modal_body">
                        <form action="{{ route('profile.image.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group mb-3 col-12 login-field">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <input type="file" id="file" name="image" data-height="150"
                                        class="dropify @error('image') is-invalid @enderror" autocomplete="off"
                                        data-default-file="{{ @Auth::user()->avatar ? asset('upload/profile/' . Auth::user()->avatar) : '' }}"
                                        accept="image/*" />
                                    @error('image')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!--submit btn start-->
                                <div class="form-group mb-2 mb-3 d-flex justify-content-between">
                                    <div>
                                        <button type="submit" name="action" value="upload"
                                            class="btn btn-primary waves-effect waves-light px-4 fw-medium">
                                            {{ @Auth::user()->avatar ? 'Update' : 'Upload' }}
                                        </button>
                                        {{-- <button type="submit" name="action" value="remove"
                                            class="btn btn-danger waves-effect waves-light px-4 fw-medium">
                                            Remove
                                        </button> --}}
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>

                                </div>
                                <!--submit btn end-->
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Profile image upload modal end-->
@endsection

@push('js')
    {{-- <script src="{{ asset('/') }}backend/js/editProfile.js"></script> --}}
    <script src="{{ asset('/') }}backend/js/uploadImg.js"></script>
    {{-- <script src="{{ asset('/') }}backend/js/uploadFile.js"></script> --}}
    <script script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {

            $('body').on('click', '.profile-upload', function() {
                $("#showModal").modal('show');
            });

            // $("#file").dropify();

            $('body').on('click', '.edit', function() {
                $.get("profile/edit", function(data) {
                    // console.log(data); // Check the data in the console
                    $('.modal-body').html(data);
                    // $('.dropify').dropify();
                });
            });

            $('.dropify').dropify();


        });

        $('#division').change(function() {
            let divisionId = $(this).find('option:selected').val();
            let districtId = $('#district').empty();
            // console.log(divisionId);

            $.ajax({
                url: "{{ url('register/get-district') }}",
                type: "get",
                data: {
                    division_id: divisionId,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    console.log(result)
                    var html = '<option selected disabled>Select District</option>'
                    $.each(result, function(key, value) {
                        html += `<option value="` + value.id + `">` + value.name + `(` + value
                            .bn_name + `)` + `</option>`
                        districtId.empty();
                        districtId.append(html);
                    });
                },
                error: function(error) {

                }
            });
        });


        function editProfile() {
            let editedProfile = document.querySelectorAll(".profile-edited");

            for (let profile of editedProfile) {
                if (profile.disabled) {
                    profile.disabled = false;
                    profile.classList.add("bg-white");
                    document.getElementById("editBtnShow").classList.remove("d-none");
                }else{
                    profile.disabled = true;
                    profile.classList.remove("bg-white");
                    document.getElementById("editBtnShow").classList.add("d-none");
                }
            }


            document.querySelector(".profile-camera-icon").classList.remove("d-none");
            document.getElementById("profile-img").removeAttribute("data-bs-target");
            document.getElementById("profile-img").removeAttribute("data-bs-toggle");
            document.getElementById("profile").classList.remove("profile-upload");
            document.getElementById("signature").removeAttribute("disabled");

            var addElements = document.querySelectorAll(".add-d-none");
            for (var i = 0; i < addElements.length; i++) {
                addElements[i].classList.add("d-none");
            }

            var removeElements = document.querySelectorAll(".remove-d-none");
            for (var i = 0; i < removeElements.length; i++) {
                removeElements[i].classList.remove("d-none");
            }

        }
    </script>
@endpush
