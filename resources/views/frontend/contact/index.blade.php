@extends('frontend.master')

@section('title')
    Contact us
@endsection

@section('content')
    <main>
        <!-- banner start -->
        <div class="banner-container">
            <div class="container">
                <h1 class="banner-title">{{__('Contact Us')}}</h1>
            </div>
        </div>
        <section class="about-container contact-container bg-white rounded shadow">
            <h3 class="contact-title">{{__('Contact Us')}}</h3>
            <hr />
            <div>
                <h5 class="contact-smTitle">{{__('Contact Number')}}</h5>
                <div class="contact-info">
                    <p>{{@$website->phone1}}</p>
                    <a href="tel:{{@$website->phone1}}" class="btn rounded-5 btn-callNow">{{__('Call Now')}}</a>
                </div>
                <div class="contact-info">
                    <p>{{@$website->phone2}}</p>
                    <a href="tel:{{@$website->phone2}}" class="btn rounded-5 btn-callNow">{{__('Call Now')}}</a>
                </div>
            </div>
            <div class="mt-4">
                <h5 class="contact-smTitle">{{__('Send Email')}}</h5>
                <div class="contact-info">
                    <p>{{@$website->email}}</p>
                    <a href="mailto:{{@$website->email}}" class="btn rounded-5 btn-callNow">{{__('Send Email')}}</a>
                </div>
            </div>
            <div class="mt-4">
                <h5 class="contact-smTitle">{{__('Reporting Purpose')}}</h5>
                <div class="contact-info">
                    <p>{{@$website->reporting_email}}</p>
                    <a href="mailto:{{@$website->reporting_email}}" class="btn rounded-5 btn-callNow">{{__('Send Email')}}</a>
                </div>
            </div>
            <div class="mt-4">
                <h5 class="contact-smTitle">{{__('Complain / Feedback')}}</h5>
                <div class="contact-info">
                    <p>{{@$website->feedback_email}}</p>
                    <a href="mailto:{{@$website->feedback_email}}" class="btn rounded-5 btn-callNow">{{__('Send Email')}}</a>
                </div>
            </div>
        </section>
    </main>
@endsection
