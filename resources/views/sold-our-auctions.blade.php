@extends('general.layout')
@section('content')
@include('general.header')
<div class="main" id="main">

    <div class="inner-banner" style="background-image: url(&quot;{{asset(config('url').'/public/images/website_images/view_our_auction.jpg')}}&quot;);">
        <div class="container">
            <h1>Sold Vessels</h1>
        </div>
    </div>

    <div class="email-subscription-outer email-subscription-outer-inner">
        @include('general.subscribe_background')
    </div>

    <div class="container listing-section">
        <div class="text-center listing_title">
            <h2>Sold Vessels</h2>
        </div>
        <div class="auction-list-wrap row" style="margin-top:15px;margin-bottom:15px;">
            <!-- <center><h2>Sold Vessels</h2></center> -->
            @foreach($data as $dt)
            <div class="col-md-6">
                <div class="prev-auct-outer">        
                    <div class="prev-auct-cell">
                        <div class="images">
                            <span class="sold-item">Sold</span>
                            <a href="{{url('/view-our-auctions/'.$dt['slug'])}}">
                                @if($dt['feature_image'])
                                <img src="{{asset('storage/app/public/Uploads/images/'.$dt['feature_image'])}}">
                                @else
                                <img src="{{asset('storage/app/public/Uploads/images/Hbp3TOkk0cmxbaRkvfW2rMuTe.jpg')}}">
                                @endif
                            </a>
                        </div>
                        <div class="prev-auct-cell-inner">
                            <div class="prev-auct-cell-left">
                                <div class="content-wrapper" style="width: 100%;">
                                    <a href="{{url('/view-our-auctions/'.$dt['slug'])}}">
                                        <h4>{{$dt['title']}}</h4>
                                    </a>
                                    <h5>{{$dt['location']}}</h5>
                                </div>
                                <div class="time-zone">

                                </div>
                            </div>
<!--                            <div class="button-wrapper">
                                <a href="#" class="btn">Auction Ends:<span> {{date("M d, Y", strtotime($dt['auction_ends']))}}</span></a>
                                <a href="#" class="btn">Bidding Opens:<span>  {{date("M d, Y", strtotime($dt['auction_begins']))}}</span></a>
                            </div>-->
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


</script>
<style>
    .auction-list-wrap .col-md-6 {
        margin-bottom: 30px;
    }  
    .label {
        font-size: 16px;
        color: #f00;
        padding-left: 0px;
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
</style>
@endsection
