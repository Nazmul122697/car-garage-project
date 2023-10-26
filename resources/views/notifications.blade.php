@extends('backend.master')

@push('css')
<style>
    .content {
        padding: 0 15px 10px 15px;
    }
    .page-title-box {
        padding: 40px 0 20px;
    }
    .card {
        border: 0 !important;
    }
    .card-body {
        padding: 20px !important;
    }
    .main-section-area {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .sub-section-area {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .single-notification {
        display: grid;
        grid-template-columns: 0.5fr 10fr 1fr;
        gap: 20px;
        background: transparent;
        padding: 12px;
        /* background: #9ca8b341; */
    }
    .notify-lab-logo img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    .notify-text h6 {
        margin-top: 0;
        margin-bottom: 5px;
    }
    .notify-text p:nth-child(2) {
        color: #9ca8b3;
        font-size: 12px;
        margin-top: 0;
        margin-bottom: 0;
    }
    .notify-text p:nth-child(3) {
        color: #9ca8b3;
        font-size: 10px;
        margin-top: 0;
        margin-bottom: 0;
    }
    .view-btn {
        display: flex;
        align-items: center;
    }
    .view-btn a {
        font-size: 13px;
    }
    .unread {
        background: #9ca8b341;
    }
</style>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <h4 class="page-title">All Notifications</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="main-section-area">
                                @foreach ($notifications as $notificationByDate)
                                <section>
                                    <h6 class="mb-3 border-bottom pb-1">
                                         @if(date('Y-m-d', strtotime($notificationByDate[0]->created_at)) == date("Y-m-d", strtotime("today")))
                                            Today
                                         @elseif(date('Y-m-d', strtotime($notificationByDate[0]->created_at)) == date("Y-m-d", strtotime("yesterday")))
                                            Yesterday
                                         @else
                                            {{ date('M d, Y',strtotime($notificationByDate[0]->created_at)) }}
                                        @endif
                                    </h6>
                                    <div class="sub-section-area">
                                        @foreach ($notificationByDate as $notification)
                                        <div class="single-notification">
                                            <div class="notify-lab-logo">
                                                <img src="{{ asset('assets/barcode/barcode-png.png') }}" alt="Lab Logo"/>
                                            </div>
                                            <div class="notify-text">
                                                <h6>{{ $notification->data['title'] }}</h6>
                                                <p>{{ $notification->data['description'] }}</p>
                                                <p>{{ date('h:i:a', strtotime($notification->createed_at)) }}</p>
                                            </div>
                                            <div class="view-btn">
                                                <a href="{{ $notification->data['route'] }}" class="btn btn-primary">View</a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </section>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
