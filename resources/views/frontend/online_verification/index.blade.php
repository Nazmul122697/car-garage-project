@extends('frontend.master')

@section('title')
    Online Verification
@endsection

@section('content')
    <main>
        <!-- banner start -->
        <div class="banner-container">
            <div class="container">
                <h1 class="banner-title">{{ __('Online Verification') }}</h1>
            </div>
        </div>
        <section class="contact-container">
            <div>
                <form action="{{ route('front.online-verification.view') }}" method="post">
                    @csrf
                    <div class="contact-info">
                        <div class="input-group mb-3">

                            <input type="text" name="reference_no" class="form-control"
                                placeholder="Enter certificate reference number">
                            <button type="submit" class="input-group-text" id="basic-addon2">Search</button>

                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
