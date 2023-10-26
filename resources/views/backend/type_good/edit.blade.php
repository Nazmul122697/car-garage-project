@extends('backend.master')

@section('content')
    <!-- main body content start -->
    <div class="main-container">
        <div class="d-flex justify-content-end mb-5">
            <a href="{{ route('type-goods.index') }}" class="btn btn-application">
                <i class="fa-regular fa-eye puls-app"></i>
                View
            </a>
        </div>
        <div class="mx-5 p-4 shadow">
            <h6 class="text-uppercase fw-semibold text-center">Update Type of Good</h6>

            <form action="{{ route('type-goods.update', $typeGood->id) }}" method="post">
                @csrf
                @method('put')

                <div class="row">
                    <!--name start-->
                    <div class="col-12 mb-3 login-field">
                        <label for="name" class="mb-2">Name <abbr class="required text-danger">*</abbr></label>
                        <input type="text" name="name" id="name" value="{{ $typeGood->name ?? old('name') }}"
                            placeholder="Enter name"
                            class="form-control py-2 small-text-12 @error('name') is-invalid @enderror" />
                        @error('name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--name end-->

                    <!--status start-->
                    <div class="form-check form-switch d-flex align-items-center gap-2 languge-content mb-3">
                        <div>
                            <input class="form-check-input language-btn ms-0 mt-0" name="status" type="checkbox"
                                role="switch" {{ $typeGood->status == 1 ? 'checked' : '' }} />
                        </div>
                        <p class="">Status</p>
                    </div>
                    <!--status end-->

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


