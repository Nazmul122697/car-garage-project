@extends('backend.master')

@section('title')
 User Manual View
@endsection

@push('css')
@endpush

@section('content')
<div class="main-container">
    <div class="d-flex justify-content-end mb-5">
        <a href="{{ route('user-manuals.index') }}" class="btn btn-application">
            <i class="fa-regular fa-eye puls-app"></i>
            View
        </a>
    </div>
    <!-- end page-title -->
    <div class="mx-5 p-4 shadow">
        <h6 class="text-uppercase fw-semibold text-center">User Manual Details</h6>
        <div class="card m-b-30 mt-3">
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-md-12 mx-auto">
                        <div class="">
                            <embed src="{{ asset('upload/user-manual/' . @$user_manual->file) }}"
                                style="width:100%; height:800px;" frameborder="0">
                            <p>{{ @$user_manual->title }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
