@extends('general.layout')
@section('content')
@include('general.header')
<div class="main" id="main">
    <div class="inner-banner" style="background-image: url(&quot;{{asset(config('url').'/public/images/website_images/films.jpg')}}&quot;);">
        <div class="container">
            <h1>Films</h1>
        </div>
    </div>
    <div class="page-content-wrap">
        <div class="about-section-wrap">
            <div class="container">
                <div class="about-content">
                    {!! Helper::getCMSpageContent(5) !!}
                    <p>
                        <iframe src="https://player.vimeo.com/video/321563970" width="740" height="460" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
                    </p>
                    <p>&nbsp;</p>
                    {!! Helper::getCMSpageContent(10) !!}
                    <p>
                    <iframe src="https://player.vimeo.com/video/296872587" width="740" height="460" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
@include('general.footer')
@endsection