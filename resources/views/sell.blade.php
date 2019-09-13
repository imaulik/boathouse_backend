@extends('general.layout')
@section('content')
@include('general.header')
<div class="main" id="main">
    <div class="inner-banner" style="background-image: url(&quot;{{asset(config('url').'/public/images/website_images/view_our_auction.jpg')}}&quot;);">
        <div class="container">
            <h1>SELL</h1>
        </div>
    </div>
    <div class="clearfix"></div>
     <div class="container sell_intro_text">
         {!! Helper::getCMSpageContent(20) !!}
    </div> 

    <div class="services-custom">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="services-custom-cell">
                        <figure><i class="fa fa-usd"></i></figure>
                        <h6>COST</h6>
                        {!! Helper::getCMSpageContent(3) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="services-custom-cell">
                        <figure><i class="fa fa-calendar"></i></figure>
                        <h6>TIME</h6>
                        {!! Helper::getCMSpageContent(16) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="services-custom-cell">
                        <figure><i class="fas fa-check-double"></i></figure>
                        <h6>CONTROL</h6>
                        {!! Helper::getCMSpageContent(17) !!}
                    </div>
                </div>
            </div>
        </div>	
    </div>
    <div class="how-work-types-outer">
        <div class="container" >
            {!! Helper::getCMSpageContent(19) !!}
        </div>
    </div>
    <div class="sell-custom-outer">
        <div class="container">
            <h3>What Our Clients Have to Say About Boathouse Auctions</h3>
            <div class="about-auction-custom">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="services-custom-cell">
                            <strong>75' Molokai Strait 2006</strong>
                            <p>As a seller, the lack of a pending event plus the extended due diligence a buyer requires creates a buyer-advantaged process. Boathouse Auctions has successfully and politely modified the approach to bring this archaic process into the 21st century. I am thrilled with the result.</p>
                            <span>Ed Lipkin, Former owner</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="services-custom-cell">
                            <strong>106' Broward 2006</strong>
                            <p>As the carrying costs of larger yachts can be significant, days on market are costly. By offering Altitude Adjustment II through Boathouse Auctions, the finite timeline of the auction process serves as a motivation to prospective buyers and as an asset to owners in terms of time and cost savings.</p>
                            <span>Craig Morris, Former owner</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="services-custom-cell">
                            <strong>58' Vicem 2004</strong>
                            <p>I praise Boathouse Auctions for leading me to the successful close of the boat I'd never before considered.</p>
                            <span>Rick Gard, Buyer</span>
                        </div>
                    </div>
                </div>
            </div>    
        </div>


    </div>

</div>
@include('general.footer')
<style>



    .sell-custom-outer {float: left; width: 100%; text-align: center; padding: 32px 0 20px; }
    .about-auction-custom .services-custom-cell {box-shadow: 0px 6px 10px 0px rgba(0 ,0 ,0 ,0.3); padding: 40px 20px; max-width: 100%; margin-bottom: 0; height: 100%; }
    .about-auction-custom .col-sm-4 {margin-bottom: 40px; } 
    .about-auction-custom{text-align: center;} .sell-custom-outer h3 ,.how-work-outer h3{font-size: 26px; font-weight: 400; text-align: center; line-height: 1.4em; margin-bottom: 32px; padding: 0 16px; }
    .about-auction-custom-cell {outline: none; } 
    .about-auction-custom-cell strong {font-size: 16px; margin-bottom: 12px; display: block; }


    .about-auction-custom p{margin: 0 auto 22px; max-width: 851px;}  
    .sell-custom-outer ul.slick-dots {position: static; text-align: center; transform: translate(0); } 
    .sell-custom-outer ul.slick-dots li button {background: #000; } 
    .sell-custom-outer ul.slick-dots li.slick-active button {background: #a19158; } 
    .sell-custom-outer ul.slick-dots li button:before {color: transparent; }
    .services-custom {float: left; width: 100%; padding: 70px 0 0; }
    .services-custom-cell figure {height: 70px; width: 70px; text-align: center; margin: 0 auto; background: #a19158; border-radius: 100%; line-height: 70px; color: #fff; font-size: 32px; }
    .services-custom-cell {text-align: center; position: relative; z-index: 2; margin-bottom: 40px; } 
    .services-custom-cell h6 {font-size: 24px; margin: 22px 0;}
    .how-work-outer h4 ,.how-work-types-outer h4{font-size: 22px; font-weight: 400; text-align: left; line-height: 1.4em; margin-bottom: 32px; padding: 0 0;}
    .how-work-types-outer h4{text-align: center;}
    .how-work-types-outer {background: url(http://boathouse.taskgrids.biz/storage/public/Uploads/images/i6AFlcUbTFAVjSdfl2LSWwHZS.jpg); background-attachment: fixed; position: relative; background-position: center; padding: 52px 0; float: left; width: 100%; } 




    .how-work-types-outer:after {position: absolute; content: ""; background: rgba(0 ,0 ,0 ,0.5); top: 0; left: 0; right: 0; bottom: 0; }
    .how-work-types-outer h4 ,.how-work-types-outer p ,.how-work-types-outer ul li{color: #fff; position: relative; z-index: 2;}
    .how-work-outer {float: left; width: 100%; padding-bottom: 52px; } 
    .how-work-outer p {margin-bottom: 26px; } 
    .how-work-outer li, .how-work-types-outer li {list-style-type: disc; margin-bottom: 12px; margin-left: 15px; }




    .how-work-types-outer li {list-style-type: decimal;font-size: 16px;} 
    .how-work-types-outer p {margin-bottom: 24px; }
    .about-auction-custom strong {margin-bottom: 22px;font-size: 22px; display: inline-block; } 
    .about-auction-custom .services-custom-cell > p {position: relative; } 
    .about-auction-custom .services-custom-cell > p:after {color: #808080; position: absolute; left: 0; top: -20px; content: "\f10d"; font-family: fontAwesome; font-size: 21px; } 
    .about-auction-custom .services-custom-cell > p:before {color: #808080; position: absolute; right: 0; bottom: -20px; font-family: fontAwesome; font-size: 22px; content: "\f10e"; }
    .about-auction-custom .services-custom-cell span {
        text-align: right;
        display: block;
        font-weight: 700;
        margin-top: 30px;
    }

</style>
<!-- <script>
    $('.about-auction-custom').slick({
        arrows: false,
        dots: true,
        autoplay: true,
        autoplaySpeed: 9000

    });
</script> -->
@endsection
