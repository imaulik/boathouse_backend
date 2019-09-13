@extends('general.layout')
@section('content')
@include('general.header')
<div class="main" id="main">
<div class="my_box3 breadcrumb-wrap">
    <div class="box_title">Retrieve Password - Boathouse Auctions</div>
    <div class="box_content">



        <div class="login-submit-form">
            <form name="lostpass" action="" method="post" id="loginform">


                <p>Please enter your information here. We will send you a new password.</p>
                <input type="hidden" name="action" value="retrievepassword">


                <p>
                    <label>Username or Email:</label>
                    <input type="text" class="do_input" name="user_login" id="user_login" value="" size="30" tabindex="1">
                </p>



                <p><label>&nbsp;</label>
                    <input type="submit" name="submit" id="submit" value="Retrieve Password" class="submit_bottom" tabindex="3">
                </p>

            </form>

        </div>


        <ul id="logins">
            <li><a class="green_btn" href="{{url('/')}}" title="Are you lost?">« Home</a></li>
            <li><a class="green_btn" href="{{url('/register')}}">Register</a></li>
            <li><a class="green_btn" href="{{url('/login')}}">Login</a></li>
        </ul>



    </div>
</div>
</div>

@include('general.footer')
@endsection