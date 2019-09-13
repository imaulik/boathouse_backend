@extends('general.layout')
@section('content')
@include('general.header')
<div class="main" id="main">
    <div class="my_box3 ">
        <div class="box_title">MY LATEST ACTIVE AUCTIONS</div>
        @foreach($latest_active_auction as $active_auction)
        <div class="box_content">
            <div class="post" id="post-ID-2810">
                <div class="col-xs-4 col-sm-2 col-lg-2 imag_imag">
                    <a href="{{url('/view-our-auctions/'.$active_auction['slug'])}}">
                        @if($active_auction['feature_image'])
                        <img src="{{asset('storage/app/public/Uploads/images/'.$active_auction['feature_image'])}}">
                        @else
                        <img src="{{asset('storage/app/public/Uploads/images/Hbp3TOkk0cmxbaRkvfW2rMuTe.jpg')}}">
                        @endif
                    </a>
                </div>
                <div class="col-xs-8 col-sm-4 col-lg-5">
                    <h2 class="title-hold">
                        <a href="" rel="bookmark" title="">
                            {{$active_auction['title']}}
                        </a>
                    </h2>
                    <p class="mypostedon">
                        Posted on {{date("M d, Y", strtotime($active_auction['created_at']))}} by 
                        <a href="#">
                            {{$active_auction['userselect']['email']}}
                        </a>
                        <br>
                        Posted in 
                    </p>
                    <div>
                        <a href="{{url('/view-our-auctions/'.$active_auction['slug'])}}" class="post_bid_btn">
                            Read More
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-lg-5">
                    <ul class="auction-details1">
                        <li>
                            <i class="zaza fa fa-money"></i>
                            <h3>Price:</h3>
                            <p> @if(isset($active_auction['last_bid_price']))
                                ${{$active_auction['last_bid_price']}} 
                                @endif
                            </p>
                        </li>
                        <li>
                            <i class="zaza fa fa-eye"></i>
                            <h3>Bids:</h3>
                            <p>
                                @if(isset($active_auction['bid_count']))
                                {{$active_auction['bid_count']}}
                                @endif
                            </p>
                        </li>
                        <li>
                            <i class="zaza fa fa-calendar"></i>
                            <h3>Posted on:</h3>
                            <p>{{date("M d, Y H:i A", strtotime($active_auction['created_at']))}}</p>
                        </li>                       
                    </ul>
                </div>
            </div>
        </div>
        @endforeach 
        @if(count($latest_active_auction) <= 0)
        <div class="box_content">
            <div class="padd10">There are no auctions yet.</div>
        </div>
        @endif
    </div>
    <div class="my_box3 ">
        <div class="box_title">MY UNPAID/PENDING AUCTIONS</div>
        @foreach($latest_paid_unpaid_auction as $paid_unpaid_auction)
        <div class="box_content">
            <div class="post" id="post-ID-2810">
                <div class="col-xs-4 col-sm-2 col-lg-2 imag_imag">
                    <a href="{{url('/view-our-auctions/'.$paid_unpaid_auction['slug'])}}">
                        @if($paid_unpaid_auction['feature_image'])
                        <img src="{{asset('storage/app/public/Uploads/images/'.$paid_unpaid_auction['feature_image'])}}">
                        @else
                        <img src="{{asset('storage/app/public/Uploads/images/Hbp3TOkk0cmxbaRkvfW2rMuTe.jpg')}}">
                        @endif
                    </a>
                </div>
                <div class="col-xs-8 col-sm-4 col-lg-5">
                    <h2 class="title-hold">
                        <a href="" rel="bookmark" title="">
                            {{$paid_unpaid_auction['title']}}
                        </a>
                    </h2>
                    <p class="mypostedon">
                        Posted on {{date("M d, Y", strtotime($paid_unpaid_auction['created_at']))}} by 
                        <a href="#">
                            {{$paid_unpaid_auction['userselect']['email']}}
                        </a>
                        <br>
                        Posted in 
                    </p>
                    <div>
                        <a href="{{url('/view-our-auctions/'.$paid_unpaid_auction['slug'])}}" class="post_bid_btn">
                            Read More
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-lg-5">
                    <ul class="auction-details1">
                    </ul>
                </div>
            </div>
        </div>
        @endforeach 
        @if(count($latest_paid_unpaid_auction) <= 0)
        <div class="box_content">
            <div class="padd10">There are no auctions yet.</div>
        </div>
        @endif
    </div>
    <div class="my_box3 ">
        <div class="box_title">MY LATEST CLOSED AUCTIONS</div>
        @foreach($latest_closed_auction as $closed_auction)
        <div class="box_content">
            <div class="post" id="post-ID-2810">
                <div class="col-xs-4 col-sm-2 col-lg-2 imag_imag">
                    <a href="{{url('/view-our-auctions/'.$closed_auction['slug'])}}">
                        @if($closed_auction['feature_image'])
                        <img src="{{asset('storage/app/public/Uploads/images/'.$closed_auction['feature_image'])}}">
                        @else
                        <img src="{{asset('storage/app/public/Uploads/images/Hbp3TOkk0cmxbaRkvfW2rMuTe.jpg')}}">
                        @endif
                    </a>
                </div>
                <div class="col-xs-8 col-sm-4 col-lg-5">
                    <h2 class="title-hold">
                        <a href="" rel="bookmark" title="">
                            {{$closed_auction['title']}}
                        </a>
                    </h2>
                    <p class="mypostedon">
                        Posted on {{date("M d, Y", strtotime($closed_auction['created_at']))}} by 
                        <a href="#">
                            {{$closed_auction['userselect']['email']}}
                        </a>
                        <br>
                        Posted in 
                    </p>
                    <div>
                        <a href="{{url('/view-our-auctions/'.$closed_auction['slug'])}}" class="post_bid_btn">
                            Read More
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-lg-5">
                    <ul class="auction-details1">
                    </ul>
                </div>
            </div>
        </div>
        @endforeach 
        @if(count($latest_closed_auction) <= 0)
        <div class="box_content">
            <div class="padd10">There are no auctions yet.</div>
        </div>
        @endif
    </div>
    <div class="my_box3 ">
        <div class="box_title">MY LATEST BIDS</div>
        @foreach($latest_bids as $latest_bid)
        <div class="box_content">
            <div class="post" id="post-ID-2810">
                <div class="col-xs-4 col-sm-2 col-lg-2 imag_imag">
                    <a href="{{url('/view-our-auctions/'.$latest_bid['slug'])}}">
                        @if($latest_bid['feature_image'])
                        <img src="{{asset('storage/app/public/Uploads/images/'.$latest_bid['feature_image'])}}">
                        @else
                        <img src="{{asset('storage/app/public/Uploads/images/Hbp3TOkk0cmxbaRkvfW2rMuTe.jpg')}}">
                        @endif
                    </a>
                </div>
                <div class="col-xs-8 col-sm-4 col-lg-5">
                    <h2 class="title-hold">
                        <a href="" rel="bookmark" title="">
                            {{$latest_bid['title']}}
                        </a>
                    </h2>
                    <p class="mypostedon">
                        Posted on {{date("M d, Y", strtotime($latest_bid['created_at']))}} by 
                        <a href="#">
                            {{$latest_bid['userselect']['email']}}
                        </a>
                        <br>
                        Posted in 
                    </p>
                    <div>
                        <a href="{{url('/view-our-auctions/'.$latest_bid['slug'])}}" class="post_bid_btn">
                            Read More
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-lg-5">
                    <ul class="auction-details1">
                        <li>
                            <i class="zaza fa fa-money"></i>
                            <h3>Price:</h3>
                            <p>
                                @if(isset($latest_bid['last_bid_price']))
                                ${{$latest_bid['last_bid_price']}}    
                                @endif
                            </p>
                        </li>
                        <li>
                            <i class="zaza fa fa-eye"></i>
                            <h3>Bids:</h3>
                            <p>
                                @if(isset($latest_bid['bid_count']))
                                {{$latest_bid['bid_count']}}
                                @endif
                            </p>
                        </li>
                        <li>
                            <i class="zaza fa fa-calendar"></i>
                            <h3>Posted on:</h3>
                            <p>{{date("M d, Y H:i A", strtotime($latest_bid['created_at']))}}</p>
                        </li>
                        @if($latest_bid['auction_ends'] >= now())
                        <li>
                            <i class="zaza fa fa-clock-o"></i>
                            <h3>Expires in:</h3>
                            <span>
                                <div id="clockdiv_{{$latest_bid['id']}}" style="margin-top: -7px;" class="clock_countdown">
                                    <span class="days" style="font-size: 12px;"></span>
                                    <span class="hours" style="font-size: 12px;"></span>
                                    <span class="minutes" style="font-size: 12px;"></span>
                                    <span class="seconds" style="font-size: 12px;"></span>
                                </div>
                            </span>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        @endforeach 
        @if(count($latest_bids) <= 0)
        <div class="box_content">
            <div class="padd10">There are no bids.</div>
        </div>
        @endif
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

            daysSpan.innerHTML = t.days + "<span class='label'>D</span>";
            hoursSpan.innerHTML = ('0' + t.hours).slice(-2) + "<span class='label'>H</span>";
            minutesSpan.innerHTML = ('0' + t.minutes).slice(-2) + "<span class='label'>M</span>";
            secondsSpan.innerHTML = ('0' + t.seconds).slice(-2) + "<span class='label'>S</span>";
            if (t.total <= 0)
            {
                clearInterval(timeinterval);
            }
        }


        updateClock();
        var timeinterval = setInterval(updateClock, 1000);
    }

    var deadline = new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000);
    var auction_clocks =<?php echo json_encode($latest_bids); ?>;
    for (var i = 0; i < auction_clocks.length; i++)
    {
        if (auction_clocks[i].auction_ends >= moment().format('YYYY-MM-DD H:m:s'))
        {
            initializeClock('clockdiv_' + auction_clocks[i].id, auction_clocks[i].auction_ends);
        }
    }


</script>
<style>
    .label {
        font-size: 12px;
        color: #f00;
        padding-left: 2px;
        font-weight: 500;
    }
    .clock_countdown
    {
        color: #f00;
    }

    .auction-details1 li h3{
        margin-top: -16px;
    }
    .auction-details1 li p{
        margin-top: -2px;
    }
</style>
@endsection