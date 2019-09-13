<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"> <!--320-->
        <title>Boathouse</title>

        <!--css-->
        <link rel="stylesheet" type="text/css" href="{{asset(config('url').'/public/css/bootstrap.min.css')}}"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
        <link rel="stylesheet" type="text/css" href="{{asset(config('url').'/public/css/bootstrap-theme.min.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset(config('url').'/public/css/style_ver_4_9.css?ver=4.9.10')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset(config('url').'/public/css/style_ver_5_1.css?ver=5.1.3.50')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset(config('url').'/public/css/style_ver_155.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset(config('url').'/public/css/font-awesome.min.css')}}"/>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
        <link rel="stylesheet" type="text/css" href="{{asset(config('url').'/public/css/3_4_bootstrap.min.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset(config('url').'/public/css/slick.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset(config('url').'/public/css/slick-theme.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset(config('url').'/public/css/jquery.fancybox.min.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset(config('url').'/public/css/custom.css')}}"/>

        <!--font-->
        <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic&amp;subset=cyrillic-ext,greek,vietnamese,latin-ext,cyrillic,latin,greek-ext" rel="stylesheet" type="text/css"><style>#ulp-UTWE9uIRedkDJBoe .ulp-submit,#ulp-UTWE9uIRedkDJBoe .ulp-submit:visited{border-radius: 2px !important; background: #000000;border:1px solid #000000;background-image:linear-gradient(#000000,#000000);}#ulp-UTWE9uIRedkDJBoe .ulp-submit:hover,#ulp-UTWE9uIRedkDJBoe .ulp-submit:active{border-radius: 2px !important; background: #000000;border:1px solid #000000;background-image:linear-gradient(#000000,#000000);}#ulp-UTWE9uIRedkDJBoe, #ulp-UTWE9uIRedkDJBoe .ulp-content{width:600px;height:540px;}#ulp-UTWE9uIRedkDJBoe .ulp-input,#ulp-UTWE9uIRedkDJBoe .ulp-input:hover,#ulp-UTWE9uIRedkDJBoe .ulp-input:active,#ulp-UTWE9uIRedkDJBoe .ulp-input:focus,#ulp-UTWE9uIRedkDJBoe .ulp-checkbox{border-width: 1px !important; border-radius: 2px !important; border-color:#4f4f4f;background-color:#ffffff !important;background-color:rgba(255,255,255,0.5) !important;}#ulp-UTWE9uIRedkDJBoe-overlay{background:rgba(66,66,66,0.8);}#ulp-layer-210{width:600px;height:540px;}#ulp-layer-210{background-color:#000000;background-color:rgba(0,0,0,01);background-image:url(http://www.taskgrids.com/boathouse2/wp-content/uploads/2019/02/111.jpg);background-repeat:repeat;background-size:auto;border-radius:0px;z-index:1000003;text-align:left;padding:0px 0px;box-shadow: rgba(32,32,32,1) 0 4px 20px; border-radius: 3px;;}#ulp-layer-210:hover{background-color:#000000;background-color:rgba(0,0,0,01);}#ulp-layer-217{width:350px;}#ulp-layer-217,#ulp-layer-217 * {text-align:left;font-family:'arial',arial;font-weight:400;color:#000000;font-size:14px;}#ulp-layer-217 .ulp-checkbox label:after{background:#000000}#ulp-layer-217{border-radius:0px;z-index:1000004;text-align:left;padding:0px 0px;;}#ulp-layer-211{width:440px;}#ulp-layer-211,#ulp-layer-211 * {text-align:center;font-family:'Open Sans',arial;font-weight:400;color:#ffffff;font-size:16px;}#ulp-layer-211 .ulp-checkbox label:after{background:#ffffff}#ulp-layer-211{border-radius:0px;z-index:1000005;text-align:center;padding:0px 0px;;}#ulp-layer-212{width:440px;height:50px;}#ulp-layer-212,#ulp-layer-212 * {text-align:justify;text-shadow: #ffffff 10px 10px 10px;font-family:'arial',arial;font-weight:400;color:#ffffff;font-size:16px;}#ulp-layer-212:hover,#ulp-layer-212:focus,#ulp-layer-212:active,#ulp-layer-212 *:hover,#ulp-layer-212 *:focus,#ulp-layer-212 *:active {color:#f2f2f2;}#ulp-layer-212 .ulp-checkbox label:after{background:#ffffff}#ulp-layer-212{background-color:#0c0c0c;background-color:rgba(12,12,12,.9);border-radius:0px;z-index:1000006;text-align:justify;padding:0px 0px;;}#ulp-layer-212:hover{background-color:#000000;background-color:rgba(0,0,0,.9);}#ulp-layer-213{width:440px;height:38px;}#ulp-layer-213,#ulp-layer-213 * {text-align:center;text-shadow: #000000 1px 1px 1px;font-family:'arial',arial;font-weight:400;color:#ffffff;font-size:16px;}#ulp-layer-213 .ulp-checkbox label:after{background:#ffffff}#ulp-layer-213{background-color:#000000;background-color:rgba(0,0,0,0.9);border-radius:0px;z-index:1000007;text-align:center;padding:0px 0px;;}#ulp-layer-214{width:480px;height:17px;}#ulp-layer-214,#ulp-layer-214 * {text-align:left;font-family:'arial',arial;font-weight:400;color:#ffffff;font-size:12px;}#ulp-layer-214 .ulp-checkbox label:after{background:#ffffff}#ulp-layer-214{border-radius:0px;z-index:1000008;text-align:left;padding:0px 0px;;}#ulp-layer-215{width:90px;height:30px;}#ulp-layer-215,#ulp-layer-215 * {text-align:right;font-family:'arial',arial;font-weight:400;color:#ffffff;font-size:24px;}#ulp-layer-215:hover,#ulp-layer-215:focus,#ulp-layer-215:active,#ulp-layer-215 *:hover,#ulp-layer-215 *:focus,#ulp-layer-215 *:active {color:#757575;}#ulp-layer-215 .ulp-checkbox label:after{background:#ffffff}#ulp-layer-215{border-radius:0px;z-index:1000009;text-align:right;padding:0px 0px;;}#ulp-layer-216{width:440px;}#ulp-layer-216,#ulp-layer-216 * {text-align:justify;font-family:'Open Sans',arial;font-weight:400;color:#ffffff;font-size:36px;}#ulp-layer-216 .ulp-checkbox label:after{background:#ffffff}#ulp-layer-216{border-radius:0px;z-index:1000010;text-align:justify;padding:0px 0px;;}</style>
        <link href="https://fonts.googleapis.com/css?family=Bitter:400,700" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,700" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,500,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,300" rel="stylesheet" type="text/css">


        <!--script-->
        <script type="text/javascript" src="{{asset(config('url').'/public/js/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset(config('url').'/public/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset(config('url').'/public/js/popper.min.js')}}"></script>
        <script type="text/javascript" src="{{asset(config('url').'/public/js/slick.min.js')}}"></script>
        <script type="text/javascript" src="{{asset(config('url').'/public/js/jquery.fancybox.min.js')}}"></script>
        <script type="text/javascript" src="{{asset(config('url').'/public/js/custom.js')}}"></script>
        <script type="text/javascript" src="{{asset(config('url').'/public/js/moment.min.js')}}"></script>
        @include('sweetalert::alert')
    </head> 
    <body>
        @yield('content')
    </body>
</html>