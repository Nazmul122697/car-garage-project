@extends('backend.master')

@section('content')
    <!-- main body content start -->
    <div class="main-container">
        <div class="d-flex justify-content-end mb-5">
            <a href="{{ route('fee-structures.index') }}" class="btn btn-application">
                <i class="fa-regular fa-eye puls-app"></i>
                View
            </a>
        </div>
        <div class="mx-5 p-4 shadow">
            <h6 class="text-uppercase fw-semibold text-center">Update Fee</h6>
            <form action="{{ route('fee-structures.update',$feeStructure->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <!--Min start-->
                    <div class="col-4 mb-3 login-field">
                        <label for="min" class="mb-2">Min <abbr class="required text-danger">*</abbr></label>
                        <input type="number" name="min" id="min" value="{{@$feeStructure->min ??  old('min') }}"
                            placeholder="Enter minimum value"
                            class="form-control py-2 small-text-12 @error('min') is-invalid @enderror" />
                        @error('min')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Min end-->

                    <!--Max start-->
                    <div class="col-4 mb-3 login-field">
                        <label for="max" class="mb-2">Min <abbr class="required text-danger">*</abbr></label>
                        <input type="number" name="max" id="max" value="{{@$feeStructure->max ?? old('max') }}"
                            placeholder="Enter maximum value"
                            class="form-control py-2 small-text-12 @error('max') is-invalid @enderror" />
                        @error('max')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Max end-->

                    <!--Fee start-->
                    <div class="col-4 mb-3 login-field">
                        <label for="fee" class="mb-2">Fee <abbr class="required text-danger">*</abbr></label>
                        <input type="number" name="fee" id="fee" value="{{@$feeStructure->fee ?? old('fee') }}"
                            placeholder="Enter fee amount"
                            class="form-control py-2 small-text-12 @error('fee') is-invalid @enderror" />
                        @error('fee')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--Fee end-->

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
