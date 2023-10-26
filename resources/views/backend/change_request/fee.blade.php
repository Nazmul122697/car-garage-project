@extends('backend.master')

@section('title')
    Change Request Fee
@endsection

@section('content')
    <!-- main body content start -->
    <div class="main-container">
        <div class="mx-5 p-4 shadow">
            <h6 class="text-uppercase fw-semibold text-center mb-3">{{@$changeRequestFee ? 'Update' : 'Create'}} Change Request Fee</h6>
            <form action="{{ route('change-request-fees.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!--Fee start-->
                    <div class="col-4 mb-3 login-field">
                        <label for="fee" class="mb-2">Fee <abbr class="required text-danger">*</abbr></label>
                        <input type="number" name="fee" id="fee" value="{{ @$changeRequestFee->fee }}"
                            placeholder="Enter fee amount"
                            class="form-control py-2 small-text-12 @error('fee') is-invalid @enderror" />
                        @error('fee')
                            <span class="text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror
                    </div>
                    <!--Fee end-->

                    <!--Vat start-->
                    <div class="col-4 mb-3 login-field">
                        <label for="vat" class="mb-2">Vat <abbr class="required text-danger">(%)*</abbr></label>
                        <input type="number" name="vat" id="vat" value="{{ @$changeRequestFee->vat }}"
                            placeholder="Enter vat percentage"
                            class="form-control py-2 small-text-12 @error('vat') is-invalid @enderror" />
                        @error('vat')
                            <span class="text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror
                    </div>
                    <!--Vax end-->

                    <!--Tax start-->
                    <div class="col-4 mb-3 login-field">
                        <label for="tax" class="mb-2">Tax <abbr class="required text-danger">(%)*</abbr></label>
                        <input type="number" name="tax" id="tax" value="{{ @$changeRequestFee->tax }}"
                            placeholder="Enter tax parcentage"
                            class="form-control py-2 small-text-12 @error('tax') is-invalid @enderror" />
                        @error('tax')
                            <span class="text-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror
                    </div>
                    <!--Tax end-->

                    <!--submit btn start-->
                    <div class="form-group mb-2 mb-3 text-end">
                        <button type="submit" class="btn btn-primary waves-effect waves-light px-4 fw-medium">
                            Save
                        </button>
                    </div>
                    <!--submit btn end-->
                </div>
            </form>
        </div>
    </div>

    <!-- main body content end -->
@endsection
