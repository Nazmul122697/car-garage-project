@extends('frontend.master')

@section('title')
    Blog
@endsection

@section('content')
    <main>
        <section class="about-container container">
            <div class="single-blog-container bg-white rounded shadow p-5">
                <h2 class="title">
                    {{@$blog->title}}
                </h2>
                <div class="single-blog-img">
                    <img src="{{asset('upload/blogs/'.@$blog->image)}}" alt="blog-image" />
                </div>
                <div class="date-time">
                    <p class="d-flex align-items-center gap-1">
                        <i class="fa-regular fa-calendar"></i>
                        <span>{{@$blog->created_at->format('F d, Y')}}</span>
                    </p>
                    <p class="d-flex align-items-center gap-1">
                        <i class="fa-regular fa-clock"></i> <span>{{ $blog->created_at->diffForHumans() }}</span>
                    </p>
                </div>
                <div class="single-blog-content">
                    <p>
                        {!!@$blog->description!!}
                    </p>
                </div>
            </div>
        </section>
    </main>
@endsection
