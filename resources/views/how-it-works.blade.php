@extends('general.layout')
@section('content')
@include('general.header')
<div class="main" id="main">
    <div class="inner-banner" style="background-image: url(&quot;{{asset(config('url').'/public/images/website_images/how-it-works.jpg')}}&quot;);">
        <div class="container">
            <h1>HOW IT WORKS</h1>
        </div>
    </div>
    <div class="howitworks-content">
        <div class="container">
            <div class="faq-wrap">
                <div class="faq-single-new-wrap">
                    <ul class="tabs-nav"> 
                        <li id="brokers_tab" class="">
                            <a href="javascript:void(0);" onclick="tabChange('brokers')" data-tabid="#brokers" rel="nofollow">BROKERS</a>
                        </li>
                        <li id="owners_tab" class="">
                            <a href="javascript:void(0);" onclick="tabChange('owners')" data-tabid="#owners" rel="nofollow">OWNERS</a>
                        </li>
                        <li id="buyers_tab" class="tab_active">
                            <a href="javascript:void(0);" onclick="tabChange('buyers')" data-tabid="#buyers" rel="nofollow">BUYERS</a>
                        </li>
                    </ul>
                    <div class="tabs-content">
                        <div id="brokers" style="display: none;">
                            {!! Helper::getCMSpageContent(7) !!}
                        </div>
                        <div id="owners" style="display: none;">
                            {!! Helper::getCMSpageContent(6) !!}
                        </div>
                        <div id="buyers" style="">
                            {!! Helper::getCMSpageContent(8) !!}
                        </div>
                    </div>
                </div>
                <div class="faq-intro-text">
                    <p>See below for details on HOW IT WORKS and FAQ’s</p>
                </div>
            </div>
        </div>
    </div>

    <div class="email-subscription-outer" style="background-image: url(&quot;{{asset(config('url').'/public/images/website_images/subscribe_background.jpg')}}&quot;); width: 100%; display: inline-block; background-size: cover; background-position: center; position: relative  ">
        @include('general.subscribe_background')
        <p>Do you and your client have a vessel you would like to consider for auction?</p>
        <div class="col-md-5 gform_footer top_label subscribe-btn-bottom"> 
            @if(\Illuminate\Support\Facades\Auth::user())
            <a href="{{url('/post_new_auction')}}" class=""> <input name="Subscribe" type="button" id="submit" class="Subscribe" value="Submit a Vessel"></a>
            @else
            <a href="{{url('/register')}}" class=""> <input name="Subscribe" type="button" id="submit" class="Subscribe" value="Submit a Vessel"></a>
            @endif 
        </div>
    </div>
    <div class="container">
        <div class="main-faq">
            <h3><span class="faq-title">{{Helper::getCMSfaqContent(11)['title']}}</span></h3>
            @foreach(Helper::getCMSfaqContent(11)['description'] as $description)
            <div>
                <li class="faq-question">
                    {{$description->question}}
                </li>
                <li class="faq-answer">
                    {!! $description->answer !!}
                </li>
            </div>
            @endforeach
        </div>
        <div class="main-faq">
            <h3><span class="faq-title">{{Helper::getCMSfaqContent(12)['title']}}</span></h3>
            @foreach(Helper::getCMSfaqContent(12)['description'] as $description)
            <div>
                <li class="faq-question">
                    {{$description->question}}
                </li>
                <li class="faq-answer">
                    {!! $description->answer !!}
                </li>
            </div>
            @endforeach
        </div>
        <div class="main-faq">
            <h3><span class="faq-title">{{Helper::getCMSfaqContent(13)['title']}}</span></h3>
            @foreach(Helper::getCMSfaqContent(13)['description'] as $description)
            <div>
                <li class="faq-question">
                    {{$description->question}}
                </li>
                <li class="faq-answer">
                    {!! $description->answer !!}
                </li>
            </div>
            @endforeach
        </div>
    </div>
    <div class="container">
        <div class="main-faq">
            <h3><span class="faq-title">{{Helper::getCMSfaqContent(14)['title']}}</span></h3>
            @foreach(Helper::getCMSfaqContent(14)['description'] as $description)
            <div>
                <li class="faq-question">
                    {{$description->question}}
                </li>
                <li class="faq-answer">
                    {!! $description->answer !!}
                </li>
            </div>
            @endforeach
        </div>
        <div class="main-faq">
            <h3><span class="faq-title">{{Helper::getCMSfaqContent(15)['title']}}</span></h3>
            @foreach(Helper::getCMSfaqContent(15)['description'] as $description)
            <div>
                <li class="faq-question">
                    {{$description->question}}
                </li>
                <li class="faq-answer">
                    {!! $description->answer !!}
                </li>
            </div>
            @endforeach
        </div>
    </div>
</div>
@include('general.footer')
<script>
    $(document).ready(function ()
    {
        if (window.location.hash)
        {
            $('#brokers').css("display", "none");
            $('#owners').css("display", "none");
            $('#buyers').css("display", "none");
            $('#brokers_tab').removeClass("tab_active");
            $('#owners_tab').removeClass("tab_active");
            $('#buyers_tab').removeClass("tab_active");
            $(window.location.hash + '_tab').addClass("tab_active");
            $(window.location.hash).css("display", "block");
            $(window).scrollTop(0);
        }
    });
    function tabChange(tabid)
    {
        $('#brokers').css("display", "none");
        $('#owners').css("display", "none");
        $('#buyers').css("display", "none");
        $('#brokers_tab').removeClass("tab_active");
        $('#owners_tab').removeClass("tab_active");
        $('#buyers_tab').removeClass("tab_active");
        if (tabid)
        {
            $('#' + tabid + '_tab').addClass("tab_active");
            $('#' + tabid).css("display", "block");
        }
    }
</script>
@endsection



