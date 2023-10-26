<img class="card-img-top" src="{{ asset('upload/blogs/' . $blog->image) }}" alt="Card image cap">
<div class="card-body">
    <div class="d-flex aling-items-center justify-content-between">
        <div class="fs-6">
            <i class="fa fa-calendar"></i>
            <span>{{ date('d M Y', strtotime($blog->date)) }}</span>
        </div>
        <div>
            @if ($blog->status == 1)
                <span class="badge bg-success">Active</span>
            @else
                <span class="badge bg-warning">InActive</span>
            @endif
        </div>
    </div>
    <h5 class="card-title">{{ $blog->title }}</h5>
    <p class="card-text">{!! $blog->description !!}</p>
</div>
