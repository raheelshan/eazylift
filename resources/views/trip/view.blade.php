@extends('layouts.app')

@section('content')

<style type="text/css">
    .profile-info-list {
        padding: 0;
        margin: 0;
        list-style-type: none;
    }
    .friend-list,
    .img-grid-list {
        margin: -1px;
        list-style-type: none;
    }
    .profile-info-list > li.title {
        font-size: 0.625rem;
        font-weight: 700;
        color: #8a8a8f;
        padding: 0 0 0.3125rem;
    }
    .profile-info-list > li + li.title {
        padding-top: 1.5625rem;
    }
    .profile-info-list > li {
        padding: 0.625rem 0;
    }
    .profile-info-list > li .field {
        font-weight: 700;
    }
    .profile-info-list > li .value {
        color: #666;
    }
    .profile-info-list > li.img-list a {
        display: inline-block;
    }
    .profile-info-list > li.img-list a img {
        max-width: 2.25rem;
        -webkit-border-radius: 2.5rem;
        -moz-border-radius: 2.5rem;
        border-radius: 2.5rem;
    }
    .coming-soon-cover img,
    .email-detail-attachment .email-attachment .document-file img,
    .email-sender-img img,
    .friend-list .friend-img img,
    .profile-header-img img {
        max-width: 100%;
    }
    .table.table-profile th {
        border: none;
        color: #000;
        padding-bottom: 0.3125rem;
        padding-top: 0;
    }
    .table.table-profile td {
        border-color: #c8c7cc;
    }
    .table.table-profile tbody + thead > tr > th {
        padding-top: 1.5625rem;
    }
    .table.table-profile .field {
        color: #666;
        font-weight: 600;
        width: 25%;
        text-align: right;
    }
    .table.table-profile .value {
        font-weight: 500;
    }
    .profile-header {
        position: relative;
        overflow: hidden;
    }
    .profile-header .profile-header-cover {
        background: url(https://bootdey.com/img/Content/bg1.jpg) center no-repeat;
        background-size: 100% auto;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }
    .profile-header .profile-header-cover:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.25) 0, rgba(0, 0, 0, 0.85) 100%);
    }
    .profile-header .profile-header-content,
    .profile-header .profile-header-tab,
    .profile-header-img,
    body .fc-icon {
        position: relative;
    }
    .profile-header .profile-header-tab {
        background: #fff;
        list-style-type: none;
        margin: -1.25rem 0 0;
        padding: 0 0 0 8.75rem;
        border-bottom: 1px solid #c8c7cc;
        white-space: nowrap;
    }
    .profile-header .profile-header-tab > li {
        display: inline-block;
        margin: 0;
    }
    .profile-header .profile-header-tab > li > a {
        display: block;
        color: #000;
        line-height: 1.25rem;
        padding: 0.625rem 1.25rem;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.75rem;
        border: none;
    }
    .profile-header .profile-header-tab > li.active > a,
    .profile-header .profile-header-tab > li > a.active {
        color: #007aff;
    }
    .profile-header .profile-header-content:after,
    .profile-header .profile-header-content:before {
        content: "";
        display: table;
        clear: both;
    }
    .profile-header .profile-header-content {
        color: #000;
        padding: 1.25rem;
    }
    body .fc th a,
    body .fc-ltr .fc-basic-view .fc-day-top .fc-day-number,
    body .fc-widget-header a {
        color: #000;
    }
    .profile-header-img {
        float: left;
        width: 7.5rem;
        height: 7.5rem;
        overflow: hidden;
        z-index: 10;
        margin: 0 1.25rem -1.25rem 0;
        padding: 0.1875rem;
        -webkit-border-radius: 0.25rem;
        -moz-border-radius: 0.25rem;
        border-radius: 0.25rem;
        background: #fff;
    }
    .profile-header-info h4 {
        font-weight: 500;
        margin-bottom: 0.3125rem;
    }
    .profile-container {
        padding: 1.5625rem;
    }
    @media (max-width: 967px) {
        .profile-header-img {
            width: 5.625rem;
            height: 5.625rem;
            margin: 0;
        }
        .profile-header-info {
            margin-left: 6.5625rem;
            padding-bottom: 0.9375rem;
        }
        .profile-header .profile-header-tab {
            padding-left: 0;
        }
    }
    @media (max-width: 767px) {
        .profile-header .profile-header-cover {
            background-position: top;
        }
        .profile-header-img {
            width: 3.75rem;
            height: 3.75rem;
            margin: 0;
        }
        .profile-header-info {
            margin-left: 4.6875rem;
            padding-bottom: 0.9375rem;
        }
        .profile-header-info h4 {
            margin: 0 0 0.3125rem;
        }
        .profile-header .profile-header-tab {
            white-space: nowrap;
            overflow: scroll;
            padding: 0;
        }
        .profile-container {
            padding: 0.9375rem 0.9375rem 3.6875rem;
        }
        .friend-list > li {
            float: none;
            width: auto;
        }
    }
    .profile-info-list {
        padding: 0;
        margin: 0;
        list-style-type: none;
    }
    .friend-list,
    .img-grid-list {
        margin: -1px;
        list-style-type: none;
    }
    .profile-info-list > li.title {
        font-size: 0.625rem;
        font-weight: 700;
        color: #8a8a8f;
        padding: 0 0 0.3125rem;
    }
    .profile-info-list > li + li.title {
        padding-top: 1.5625rem;
    }
    .profile-info-list > li {
        padding: 0.625rem 0;
    }
    .profile-info-list > li .field {
        font-weight: 700;
    }
    .profile-info-list > li .value {
        color: #666;
    }
    .profile-info-list > li.img-list a {
        display: inline-block;
    }
    .profile-info-list > li.img-list a img {
        max-width: 2.25rem;
        -webkit-border-radius: 2.5rem;
        -moz-border-radius: 2.5rem;
        border-radius: 2.5rem;
    }
    .coming-soon-cover img,
    .email-detail-attachment .email-attachment .document-file img,
    .email-sender-img img,
    .friend-list .friend-img img,
    .profile-header-img img {
        max-width: 100%;
    }
    .table.table-profile th {
        border: none;
        color: #000;
        padding-bottom: 0.3125rem;
        padding-top: 0;
    }
    .table.table-profile td {
        border-color: #c8c7cc;
    }
    .table.table-profile tbody + thead > tr > th {
        padding-top: 1.5625rem;
    }
    .table.table-profile .field {
        color: #666;
        font-weight: 600;
        width: 25%;
        text-align: right;
    }
    .table.table-profile .value {
        font-weight: 500;
    }

    .friend-list {
        padding: 0;
    }
    .friend-list > li {
        float: left;
        width: 50%;
    }
    .friend-list > li > a {
        display: block;
        text-decoration: none;
        color: #000;
        padding: 0.625rem;
        margin: 1px;
        background: #fff;
    }
    .friend-list > li > a:after,
    .friend-list > li > a:before {
        content: "";
        display: table;
        clear: both;
    }
    .friend-list .friend-img {
        float: left;
        width: 3rem;
        height: 3rem;
        overflow: hidden;
        background: #efeff4;
    }
    .friend-list .friend-info {
        margin-left: 3.625rem;
    }
    .friend-list .friend-info h4 {
        margin: 0.3125rem 0;
        font-size: 0.875rem;
        font-weight: 600;
    }
    .friend-list .friend-info p {
        color: #666;
        margin: 0;
    }    
</style>
<div class="container-fluid">
    <h1 class="mt-4">{{ __('trip.trips') }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item">{{ __('trip.trips') }}</li>
        <li class="breadcrumb-item active">#{{ $trip->trip_id }}</li>
    </ol>

    <div id="content" class="content p-0">


        <div class="profile-container">
            <div class="row row-space-20">
                <div class="col-md-12">
                    <div class="tab-content p-0">
                        <div class="tab-pane active show" id="profile-about">
                            <table class="table table-profile">
                                <thead>
                                    <tr>
                                        <th colspan="2">TRIP INFORMATION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="value">Trip ID</td>
                                        <td class="value">
                                            #{{ $trip->trip_id }}
                                        </td>
                                        <td class="value">Intra City</td>
                                        <td class="value">
                                            Yes
                                        </td>                                        
                                    </tr>
                                    <tr>
                                        <td class="value">Origin</td>
                                        <td class="value">
                                            {{ $trip->origin }}
                                        </td>
                                        <td class="value">Trip Duration</td>
                                        <td class="value">
                                            {{ $trip->trip_time }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="value">Destination</td>
                                        <td class="value">
                                            {{ $trip->destination }}
                                        </td>
                                        <td class="value">Amount</td>
                                        <td class="value">
                                            {{ $trip->currency }} {{ $trip->amount_collected }}
                                        </td>
                                    </tr>                                    
                                </tbody>
                            </table>                        
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3 profile-header">
                        <div class="card-header">Captain</div>
                        <div class="card-body">
                            <div class="profile-header-content">
                                <div class="profile-header-img">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">
                                </div>
                                <div class="profile-header-info">
                                    <h4 class="m-t-sm">{{ $trip->captain->name }}</h4>
                                    <span class="card-text">{{ $trip->captain->primary_cell }}</span>
                                    <span class="card-text">{{ $trip->captain->secondary_cell }}</span>
                                    <p class="card-text">Rating 4.5</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3 profile-header">
                        <div class="card-header">Vehical</div>
                        <div class="card-body">
                            <div class="profile-header-content">
                                <div class="profile-header-img">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">
                                </div>
                                <div class="profile-header-info">
                                    <h4 class="m-t-sm">{{ $trip->vehical->color }} {{ $trip->vehical->brand }}, {{ $trip->vehical->model }}</h4>
                                    <span class="card-text">Plate: {{ $trip->vehical->plate }}</span>
                                    <span class="card-text">Condition: {{ $trip->vehical->condition }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        @foreach($trip->reservations as $reservation)
                        <div class="col-md-6">
                            <div class="card mb-3 profile-header">
                                <div class="card-header">Commuter {{ $loop->index + 1 }} </div>
                                <div class="card-body">
                                    <div class="profile-header-content">
                                        <div class="profile-header-img">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">
                                        </div>
                                        <div class="profile-header-info">
                                            <h4 class="m-t-sm">{{ $reservation->customer->name }}</h4>
                                            <span class="card-text">{{ $reservation->customer->primary_cell }}</span>
                                            <span class="card-text">{{ $reservation->customer->secondary_cell }}</span>
                                            <p class="card-text">Rating 4.5</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')


@endsection