@extends('general.layout')
@section('content')
@include('general.header')

<div class="main" id="main">
    <div class="banner-section">
        <div  class="slider single-item">
          @foreach($home_sliders as $key=>$home_slider)
            <div class="banner-images" style="background-image: url({{asset(config('url').'/storage/public/Uploads/images/'.$home_slider['slider_image'])}});">
                <div class="banner-caption">
                    <h2 class="banner-slick-slider-font">
                        {{$home_slider['description']}}          
                    </h2>
                    @if($key == 0)
                    <h4>Brokers, Owners, Buyers</h4>
                    <div class="section-content">
                        <div class="btn-wrap">
                            <a href="{{url('/view-our-auctions')}}" class="primary-btn" target="">View Auctions</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
      <div class="photos-by">
        <div class="">
            <div class="subscribe-top-desc" style="color: #fff;width: 100%;float: right; text-align: right; padding-right: 26px;">Photos by Billy Black</div>
        </div>
    </div>
    </div>
   
    <div class="welcome-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 left-part">
                    {!! Helper::getCMSpageContent(2) !!}
                </div>
<!--                <div class="col-md-4 right-part">
                    <div class="latest-new-box">
                        <div class="section-title txtC">
                            <h3>Latest News</h3>
                        </div>
                        @foreach($latest_news as $latestnews)
                        <a href="{{$latestnews['link']}}" target="_blank">{{$latestnews['title']}}</a>
                        <p>{{$latestnews['description']}} {{date("m/d/Y", strtotime($latestnews['created_at']))}}</p>
                        @endforeach
                    </div>
                </div>-->
            </div>
        </div>
    </div>
    <div class="how-work-types-outer">
        <div class="container" >
     <div class="testimonial-section">
            
                @foreach($home_testimonials as $test_key => $test_val)
                <div class="testimonial_inner">
                    {{$test_val['description']}}
                    <br>
                    <div class="testimonial-wrap mt-3">
                        <span class="testimonial_author">
                    {{$test_val['author'] .', '. $test_val['designation']}}
                    </span>
                    <br>
                    <span>
                    {{$test_val['title']}}
                    </span>
                    </div>
                </div>
                @endforeach
            
       </div>
        </div>
    </div>
    <div class="timeline-section">
        <div class="container">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="timeline-box">
                    <div class="section-title txtC">
                        <h3>Sample Auction Timeline</h3>
                    </div>
                    <div class="section-desc">
                        {!! Helper::getCMSpageContent(4) !!}
                    </div>
                    <div class="timeline-image">
                        <img src="{{asset(config('url').'/public/images/website_images/auction-timeline.jpg')}}">
                    </div>
                </div>    
            </div>
        </div>
    </div>
    <div class="listing-section">
        <div class="container">
            <div class="section-title txtC">
                <div class="auction-list-wrap">
                    @if(isset($data) && $data > 0)
                    <div class="section-title"><h3>Listings</h3></div>  
                    <div class="auction-list-wrap" style="margin-top:15px;margin-bottom:15px;">
                        @foreach($data as $dt)
                        
                        <div class="col-md-6">
                            <div class="prev-auct-outer">        
                                <div class="prev-auct-cell">
                                    <div class="images">
                                        <a href="{{url('/view-our-auctions/'.$dt['slug'])}}">
                                            @if($dt['feature_image'])
                                            <img src="{{asset('storage/app/public/Uploads/images/'.$dt['feature_image'])}}">
                                            @else
                                            <img src="{{asset('storage/app/public/Uploads/images/Hbp3TOkk0cmxbaRkvfW2rMuTe.jpg')}}">
                                            @endif
                                        </a>
                                        @if($dt['auction_begins'] < now())
                                        <span>Auction in Progress</span>
                                        @endif
                                    </div>
                                    <div class="prev-auct-cell-inner">
                                        <div class="prev-auct-cell-left">
                                            <div class="content-wrapper">
                                                <a href="{{url('/view-our-auctions/'.$dt['slug'])}}">
                                                    <h4>{{$dt['title']}}</h4>
                                                </a>
                                                <h5>{{$dt['location']}}</h5>
                                                <div class="counry_wrp">
                                                    @if($dt['auction_begins'] > now())
                                                    <div class="time-zone">
                                                        <h5>CURRENT BID:</h5> <span class="bidding-opens-date">{{$dt['auction_buy_now_price']}}</span>
                                                        <div style="display:none;" id="clockdiv_{{$dt['id']}}" class="clock_countdown">
                                                            <span class="days"></span>
                                                            <span class="hours"></span>
                                                            <span class="minutes"></span>
                                                            <span class="seconds"></span>
                                                        </div>
                                                        <h5>Bidding Opens:</h5> <span class="bidding-opens-date">{{date("M d, Y", strtotime($dt['auction_begins']))}}</span>
                                                        <div style="display:none;" id="clockdiv_{{$dt['id']}}" class="clock_countdown">
                                                            <span class="days"></span>
                                                            <span class="hours"></span>
                                                            <span class="minutes"></span>
                                                            <span class="seconds"></span>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="time-zone">
                                                        @if(\Illuminate\Support\Facades\Auth::user())
                                                        <h5>CURRENT BID:</h5> <span class="bidding-opens-date">${{$dt['auction_buy_now_price']}}</span>
                                                        @else
                                                        <h5>CURRENT BID:</h5> <span class="blurr-cls"></span>
                                                        @endif
                                                        <h5>Ends IN:</h5> 
                                                        <div id="clockdiv_{{$dt['id']}}" class="clock_countdown">
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
                        @else
                        <h3>No Current Auctions</h3>
                        @endif
                    </div>
                </div>
            </div>
            <div class="section-content">
                <div class="btn-wrap">
                    <a href="{{url('/view-our-auctions')}}" class="primary-btn" target="">view all listings</a>
                </div>
            </div>
        </div>
    </div>
    <div class="video-section">
        <div class="container">
            <div class="video-section-wrap">
                <div class="vd-message">
                    {!! Helper::getCMSpageContent(1) !!}
                </div>
                <div class="vd-box">
                    <iframe src="https://player.vimeo.com/video/321563970" width="640" height="360" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe> 
                </div>
                <div class="vd-box">
                    <iframe src="https://player.vimeo.com/video/296872587" width="640" height="360" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div>
    <!--    <div class="partner-section bg-img">
            <div class="container">
                <div class="section-title txtC">
                    <h3>In partnership with</h3>
                </div>
                <div class="section-content">
                     logo-slider 
                    <div class="partner-logo-wrap">
                        <div class="single-slide">
                            <img src="{{asset(config('url').'/public/images/website_images/home_logo_1.jpg')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
</div>
@include('general.footer')
<script>
    $(document).ready(function ()
    {
        $('.single-item').slick({
            dots: true,
            speed: 1000,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 3000
        });
        $('.testimonial-section').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                
              });
    });
    
    function getTimeRemaining(endtime)
    {
        var t = Date.parse(endtime.replace(/\s/, 'T')) - Date.parse(new Date());
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
    var auction_clocks =<?php echo json_encode($data); ?>;
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


    .counry_wrp .time-zone .clock_countdown > span > span {
        margin-left: 5px;
    }
    .how-work-types-outer h4{font-size: 22px; font-weight: 400; text-align: left; line-height: 1.4em; margin-bottom: 32px; padding: 0 0;}
    .how-work-types-outer h4{text-align: center;}
    .how-work-types-outer {background: url(http://boathouse.taskgrids.biz/storage/public/Uploads/images/i6AFlcUbTFAVjSdfl2LSWwHZS.jpg); background-attachment: fixed; position: relative; background-position: center; padding: 52px 0; float: left; width: 100%; } 




    .how-work-types-outer:after {position: absolute; content: ""; background: rgba(0 ,0 ,0 ,0.5); top: 0; left: 0; right: 0; bottom: 0; }
    .how-work-types-outer h4 ,.how-work-types-outer p ,.how-work-types-outer ul li{color: #fff; position: relative; z-index: 2;}
    .how-work-types-outer li {list-style-type: disc; margin-bottom: 12px; margin-left: 15px; }
    .how-work-types-outer li {list-style-type: decimal;font-size: 16px;} 
    .how-work-types-outer p {margin-bottom: 24px; }
    
    .photos-by { width: 100%; display: inline-block;  position: absolute; left: 0;bottom: -60px;}
    .photos-by .subscribe-top-desc { padding: 10px 0;}
    .banner-section {  position: relative;}
.banner-caption {
    display: inline-block;
}

.banner-caption h4 {
    color: #ffff;
    font-size: 35px;
    padding: 20px 0;
    text-transform: uppercase;
    font-weight: 500;
}

.banner-caption .btn-wrap a {
    text-decoration: none;
}

.banner-caption .btn-wrap a:hover {
    /* background-color: #a5914f; */
    /* color: #fff  !important; */
}

.banner-caption h2 {
    text-transform: uppercase;
     font-weight: 700;
}

.banner-caption .btn-wrap a:hover {
    /* background-color: #000; */
}
.photos-by {
    display: inline-block;
    position: absolute;
    right: 0;
    bottom: 0px;
    z-index: 1;
    width: 30%;
    float: right;
    left: auto;
}
.testimonial-section ul.slick-dots { bottom: -80px;}
.banner-caption .btn-wrap a:hover { background-color: #fff; color: #A5914F !important;}
.testimonial_inner {
    font-size: 20px;
    outline: none !important;
}

.testimonial-section {
    padding: 30px;
    max-width: 700px;
    margin: 0 auto;
}
.counry_wrp .time-zone span.blurr-cls {position: relative;padding-left: 20px;}

.counry_wrp .time-zone span.blurr-cls:after {    content: '';
    position: absolute;
    width: 20px;
    height: 10px;
    background-color: #000;
    top: 15px;
    transform: translate(-50%,-50%);
    left: 10px;}
.testimonial-wrap{font-size: medium;}
.testimonial-wrap .testimonial_author{font-style: italic;}
</style>
@endsection
