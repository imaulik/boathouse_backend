@extends('general.layout')
@section('content')
@include('general.header')
<div class="main" id="main">
    <div class="inner-banner" style="background-image: url(&quot;{{asset(config('url').'/public/images/website_images/about_us.jpg')}}&quot;);">
        <div class="container">
            <h1>About us</h1>
        </div>
    </div>
    <div class="page-content-wrap">
        <div class="team-wrap">
            <div class="container">
                @if(isset($member_abouts) && $member_abouts > 0)
                @foreach($member_abouts as $member_about)
                <div class="team-single-wrap">
                    <div class="team-img-wrap">
                        <img src="{{asset('storage/app/public/Uploads/images/'.$member_about['member_image'])}}">
                    </div>
                    <div class="team-content-wrap">
                        <h3>{{$member_about['member_name']}}</h3>          
                        <span class="member-desg">{{$member_about['member_designation']}}</span>                                                      
                        <div class="team-detail">
                            {!! $member_about['member_description'] !!}
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@include('general.footer')
@endsection