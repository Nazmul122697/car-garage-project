@extends('frontend.master')

@section('title')
    Blog
@endsection

@section('content')
    <main>
        <section class="about-container container">
            <div class="title-content container">
                <h1 class="title">All <span class="title-color"> Blogs</span></h1>
            </div>
            <div class="blog-grid">
                @foreach ($blogs as $blog)
                    <div class="blog-card shadow">
                        <div class="blog-img">
                            <img src="{{@$blog->image ? asset('upload/blogs/'.$blog->image) : ''}}" alt="" />
                        </div>
                        <div class="date-time">
                            <p class="d-flex align-items-center gap-1">
                                <i class="fa-regular fa-calendar"></i>
                                <span>{{@$blog->created_at ? $blog->created_at->format('F d, Y') : ''}}</span>
                            </p>
                            <p class="d-flex align-items-center gap-1">
                                <i class="fa-regular fa-clock"></i> <span>{{ $blog->created_at->diffForHumans() }}</span>
                            </p>
                        </div>
                        <hr />
                        <div class="blog-content">
                            <h4>{{@$blog->title ? Str::limit($blog->title,40,'....') : ''}}</h4>
                            <p>
                                {{@$blog->description ? Str::substr(strip_tags($blog->description),0,180) : ''}}
                            </p>
                            <a href="{{route('front.blog.single',$blog->slug)}}" class="btn-view d-flex align-items-center gap-1">Read More <i
                                    class="fa-solid fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>
    </main>
@endsection
