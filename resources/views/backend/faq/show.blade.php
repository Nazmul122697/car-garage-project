@extends('backend.master')

@push('css')
@endpush

@section('content')
 <!-- main body content start -->
 <div class="main-container">
    <div class="d-flex justify-content-end mb-5">
        <a href="{{ route('tutorials.index') }}" class="btn btn-application">
            <i class="fa-regular fa-eye puls-app"></i>
            View
        </a>
    </div>
    <div class="mx-5 p-4 shadow">
        <h6 class="text-uppercase fw-semibold text-center">Tutorial Show</h6>
        <div class="card m-b-30 mt-3">
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-md-12 mx-auto">
                        <div class="">
                            <iframe width="100%" height="400" src={{ $tutorial->url }} title="Video Title"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                            <p>{{ $tutorial->title }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- main body content end -->


@endsection

@push('js')
@endpush
