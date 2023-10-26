@extends('frontend.master')

@section('title')
 User Manual
@endsection

@section('content')
    <main>
        <!-- banner start -->
        <div class="banner-container">
            <div class="container">
                <h1 class="banner-title">{{ __('User Manual') }}</h1>
            </div>
        </div>
        <section class="about-container container">
            <!--user manual pdf start-->
            @if (count($userManuals) > 0)
                <div class="single-blog-container bg-white rounded shadow p-5">
                    <h2 class="title">{{ __('User Manual') }}</h2>

                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <tbody>
                                @foreach ($userManuals as $userManual)
                                    <tr>
                                        <td class="table-td">

                                            <span title="{{ Str::limit(@$userManual->title, 60, ' .....') }}">
                                                {{ Str::limit(@$userManual->title, 60, ' ...Pdf') }}
                                            </span>
                                            @if($userManual->title)
                                                <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                                            @endif
                                        </td>
                                        <td class="table-td text-center">
                                            <form action="{{ route('front.user-manual.download') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ @$userManual->id }}">
                                                <button type="submit" class="btn rounded-5 btn-callNow">Download</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    @if (count($userManuals) >= 3)
                        <div class="mt-3 text-center">
                            <a href="{{ route('front.user-manual.all') }}">
                                <button class="btn rounded-5 btn-callNow">{{ __('View More') }}</button>
                            </a>
                        </div>
                    @endif

                </div>
            @endif

            <!--user manual pdf end-->

            <!--Tutorial start-->
            <div class="tutorial-contanier">
                <h3 class="title">{{ __('Tutorial') }}</h3>
                <!--Video grid start-->
                <div id="dataContainer" class="vedio-grid">

                </div>
                <!--Video grid end-->

                <div class="mt-5 text-center">
                    <button id="loadMoreButton" class="btn rounded-5 btn-callNow">
                        {{ __('Load More') }}</button>
                </div>
            </div>
            <!--Tutorial end-->
        </section>
    </main>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var offset = 0;
            var limit = 3;

            function formatDate(dateString) {
                var options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                return new Date(dateString).toLocaleDateString('en-US', options);
            }

            function loadMore() {
                $.ajax({
                    url: '{{ route('front.load-more.tutorial') }}',
                    type: 'GET',
                    data: {
                        offset: offset,
                        limit: limit
                    },
                    success: function(response) {
                        var dataContainer = $('#dataContainer');
                        response.forEach(function(item) {
                            var formattedDate = formatDate(item.created_at);
                            dataContainer.append(`
                        <div class="vedio-card shadow rounded">
                            <iframe width="100%" height="200" class="rounded-top" src="` + item.url + `"
                                title="How to Identify and Scout for Fall Armyworm in Bangla (accent from Bangladesh)"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                            <div class="vedio-content">
                                <p class="online-card-text blog-text">
                                    ` + item.title + `
                                </p>
                                <div class="date-times">
                                    <p>
                                        <i class="fa-regular fa-clock"></i>
                                        <span>` + formattedDate + `</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        `);
                        });

                        offset += response.length;

                        if (response.length < limit) {
                            $('#loadMoreButton').hide();
                        }
                    }
                });
            };

            loadMore();

            $('#loadMoreButton').click(function() {
                loadMore();
            })
        });
    </script>
@endpush
