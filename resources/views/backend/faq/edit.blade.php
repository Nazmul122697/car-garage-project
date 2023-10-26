@extends('backend.master')

@section('content')
    <!-- main body content start -->
    <div class="main-container">
        <div class="d-flex justify-content-end mb-5">
            <a href="{{ route('faq.index') }}" class="btn btn-application">
                <i class="fa-regular fa-eye puls-app"></i>
                View
            </a>
        </div>
        <div class="mx-5 p-4 shadow">
            <h6 class="text-uppercase fw-semibold text-center">Update tutorial</h6>
            <form action="{{ route('faq.update',@$faq->id) }}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <!--title start-->
                    <div class="col-12 mb-3 login-field">
                        <label for="title" class="mb-2">Title <abbr class="required text-danger">*</abbr></label>
                        <input type="text" name="title" id="title" value="{{@$faq->title ?? old('title') }}"
                            placeholder="Enter tutorial title"
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
                        <label for="description" class="mb-2">Description <abbr class="required text-danger">*</abbr></label>
                        <input type="text" name="description" id="description" value="{{@$faq->description ?? old('description') }}"
                               placeholder="Enter tutorial description"
                               class="form-control py-2 small-text-12 @error('description') is-invalid @enderror" />
                        @error('description')
                        <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--description end-->

                    <!--status start-->
                    <div class="form-check form-switch d-flex align-items-center gap-2 languge-content mb-3">
                        <div>
                            <input class="form-check-input language-btn ms-0 mt-0" name="status" type="checkbox"
                                role="switch" {{@$faq->status == 1 ? 'checked' : ''}}/>
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


