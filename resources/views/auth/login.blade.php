@extends('general.layout')
@section('content')
@include('general.header')
<div class="main" id="main">
    <div class="my_box3 breadcrumb-wrap">
        <div class="box_title" style="font-weight: bold; font-size:23px">Log In</div>
        <div class="box_content">
            <div class="error_div" id="error_div">
            </div>
            <div class="login-submit-form">
                <form name="loginform" action="javascript:void(0);" id="loginform" method="post">
                    <p>
                        <label>Username:</label>
                        <input class="do_input" type="text" required name="username" id="username" value="" size="30"  />
                    </p>
                    <p>
                        <label>Password:</label>
                        <input class="do_input" type="password" required name="password" id="password" value="" size="30"  />
                    </p>
                    <p>
                        <label>&nbsp;</label>
                        <input class="do_input" name="rememberme" type="checkbox" id="rememberme" value="true" tabindex="3" />
                        Keep me logged in
                    </p>
                    <p>
                        <label>&nbsp;</label>
                        <input type="submit" class="submit_bottom" value="log in" tabindex="4" />
                        <input type="hidden" name="redirect_to" value="" />
                    </p>
                </form>
                <ul id="logins" style="margin-left:106px">
                    <li>
                        <a class="green_btn" href="{{url('/register')}}">NOT YET REGISTERED</a>
                    </li>
                    <li>
                        <a class="green_btn" href="{{url('/forgot_password')}}"
                           title="Password Lost and Found">Lost your password?</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@include('general.footer')

<script>

    $('#loginform').submit(function ()
    {
    var APP_URL = {!! json_encode(url('/')) !!}
    $.ajax({
    type: "POST",
            url: APP_URL + '/user_login',
            data: $(this).serialize(),
            success: function (response)
            {
            document.getElementById("loginform").reset();
            Swal.fire({
                    title: "Success",
                    text: "Login successfully",
                    type: "success"
            }).then(function() {
            window.location = '/';
            });
            },
            error: function (error)
            {
            Swal.fire('Error', error.responseJSON, 'error')
            }
    });
    });
//    
//    
//    $('#loginform').submit(function (e)
//    {
//    var APP_URL = {!! json_encode(url('/')) !!}
//    $.ajax({
//    type: "POST",
//            url: APP_URL + '/user_login',
//            data: $(this).serialize(),
//            success: function (response){
//            window.location = '/'
//            },
//            error: function (error){
//            $('#error_div').html(error.responseJSON).
//                    css({"border": "1px solid #BE4C5A",
//                            "background": "#FCDCEC",
//                            "color": "red",
//                            "padding": "12px",
//                            "border-radius": "5px",
//                            "margin-top": "15px"
//                    });
//            }
//    });
//    });
</script>

@endsection