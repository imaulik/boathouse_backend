@extends('general.layout')
@section('content')
@include('general.header')
<div class="main" id="main">

    <div class="inner-banner" style="background-image: url(&quot;{{asset(config('url').'/public/images/website_images/view_our_auction.jpg')}}&quot;);">
        <div class="container">
            <h1>Current Vessels</h1>
        </div>
    </div>

    <div class="email-subscription-outer email-subscription-outer-inner">
        @include('general.subscribe_background')
    </div>

    <div class="container listing-section">
        <div class="text-center listing_title">
            <h2>Current Vessels</h2>
        </div>
        <div class="auction-list-wrap row" style="margin-top:15px;margin-bottom:15px;">
            
            @foreach($current_datas as $current_data)
            <div class="col-md-6">
                <div class="prev-auct-outer">        
                    <div class="prev-auct-cell">
                        <div class="images">
                            <a href="{{url('/view-our-auctions/'.$current_data['slug'])}}">
                                @if($current_data['feature_image'])
                                <img src="{{asset('storage/app/public/Uploads/images/'.$current_data['feature_image'])}}">
                                @else
                                <img src="{{asset('storage/app/public/Uploads/images/Hbp3TOkk0cmxbaRkvfW2rMuTe.jpg')}}">
                                @endif
                            </a>
                            @if($current_data['auction_begins'] < now())
                            <span>Auction in Progress</span>
                            @endif
                        </div>
                        <div class="prev-auct-cell-inner">
                            <div class="prev-auct-cell-left">
                                <div class="content-wrapper">
                                    <a href="{{url('/view-our-auctions/'.$current_data['slug'])}}">
                                        <h4>{{$current_data['title']}}</h4>
                                    </a>
                                    <h5>{{$current_data['location']}}</h5>
                                    <div class="counry_wrp">
                                        @if($current_data['auction_begins'] > now())
                                        <div class="time-zone">
                                            <h5>Bidding Opens:</h5> <span class="bidding-opens-date">{{date("M d, Y", strtotime($current_data['auction_begins']))}}</span>
                                            <div style="display:none;" id="clockdiv_{{$current_data['id']}}" class="clock_countdown">
                                                <span class="days"></span>
                                                <span class="hours"></span>
                                                <span class="minutes"></span>
                                                <span class="seconds"></span>
                                            </div>
                                        </div>
                                        @else
                                        <div class="time-zone">
                                            <h5>Ends IN:</h5> 
                                            <div id="clockdiv_{{$current_data['id']}}" class="clock_countdown">
                                                <span class="days"></span>
                                                <span class="hours"></span>
                                                <span class="minutes"></span>
                                                <span class="seconds"></span>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
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
@include('general.footer')
<script>

    function getTimeRemaining(endtime)
    {
        var t = Date.parse(endtime) - Date.parse(new Date());
        var seconds = Math.floor((t / 1000) % 60);
        var minutes = Math.floor((t / 1000 / 60) % 60);
        var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
        var days = Math.floor(t / (1000 * 60 * 60 * 24));
        return {
            'total': t,
            'days': days,
            'hours': hours,
            'minutes': minutes,
            'seconds': seconds
        };
    }

    function initializeClock(id, endtime)
    {
        var clock = document.getElementById(id);
        var daysSpan = clock.querySelector('.days');
        var hoursSpan = clock.querySelector('.hours');
        var minutesSpan = clock.querySelector('.minutes');
        var secondsSpan = clock.querySelector('.seconds');
        function updateClock()
        {
            var t = getTimeRemaining(endtime);
            if (t.days != 0)
            {
                daysSpan.innerHTML = t.days + "<span class='label'> Days</span>";
            } else
            {
                hoursSpan.innerHTML = ('0' + t.hours).slice(-2) + "<span class='label'><b> : </b></span>";
                minutesSpan.innerHTML = ('0' + t.minutes).slice(-2) + "<span class='label'><b> : </b></span>";
                secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
            }
            if (t.total <= 0)
            {
                clearInterval(timeinterval);
            }
        }


        updateClock();
        var timeinterval = setInterval(updateClock, 1000);
    }

    var deadline = new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000);
    var auction_clocks =<?php echo json_encode($current_datas); ?>;
    for (var i = 0; i < auction_clocks.length; i++)
    {
        initializeClock('clockdiv_' + auction_clocks[i].id, auction_clocks[i].auction_ends);
    }


</script>
<style>
    .auction-list-wrap .col-md-6 {
        margin-bottom: 30px;
    }  
    .label {
        font-size: 16px;
        color: #f00;
        padding: 0px;
        font-weight: 500;
    }
    .clock_countdown
    {
        color: #f00;
    }
    .news-detail-content p
    {
        margin-top: 0px;
    }
    span.bidding-opens-date {
        color: red;
        font-size: 16px;
        line-height: 26px;
        font-weight: 200;
    }
    .counry_wrp .time-zone .clock_countdown > span {
        display: inline-flex;
        align-items: center;
        line-height: initial;
    }

    .counry_wrp .time-zone .clock_countdown > span > span {
        margin-left: 5px;
    }
</style>
@endsection
