@extends('general.layout')
@section('content')
@include('general.header')
<div class="main" id="main">
    <div class="my_box3 breadcrumb-wrap">
        <div class="box_title" style="font-weight: bold; font-size:23px; padding-left:10px;">Register</div>
        <div class="box_content">
            <div class="login-submit-form">
                <div id="error_div"></div>
                <div style="padding-left:10px; padding-bottom:18px">If you are already registered 
                    <a  href="{{url('/login')}}" class="click-link btn-link" style="text-decoration: underline;">
                        click here
                    </a>.
                </div>
                <div style="padding-left:10px">Please note, the Username you choose will be your screen name.</div>
                <br><br>
                <div class="box_title" style="font-weight: bold; display: none; font-size:19px; padding-left:10px;">
                    MEMBER BENEFITS
                </div>
                <div style="font-size:16px; line-height:25px;  display: none; padding-left:12px;">
                    1. First to know about new listings <br>
                    2. Comment on vessels <br>
                    3. Set watchlists and alerts <br>
                    4. Download/View diligence documents <br>
                    5. Register to bid <br><br>
                </div>
                <form class="form-horizontal" id="registrationForm" method="post" action="javascript:void(0);">
                    {{ csrf_field() }}
                    <input type="hidden" name="action" value="register">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <p>
                            <label for="register-email">E-Mail Address:</label>
                            <input id="email" type="email" class="do_input" name="email" value="{{ old('email') }}"
                                   required>
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </p>
                    </div>
                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <p>
                            <label for="register-username">Username:</label>
                            <input id="username" type="text" class="do_input" name="username"
                                   value="{{ old('username') }}" required>
                            @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                        </p>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <p>
                            <label for="register-email">Password:</label>
                            <input id="password" minlength="6" type="password" class="do_input" name="password"
                                   required>
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </p>
                    </div>

                    <div class="form-group">
                        <p>
                            <label for="register-email">Confirm Password:</label>
                            <input id="password_confirmation" onkeyup="passwordChecker()" minlength="6" type="password"
                                   class="do_input" name="password_confirmation" required>
                        </p>
                    </div>
                    <div id="message"></div>

                    <div class="form-group{{ $errors->has('broker') ? ' has-error' : '' }}">
                        
                            
                        <div class="radio-wrap-inner">
                         <p> 
                            <label class="z1xcva" for="register-email"></label>
                            <div class="radio-wrap">
                                <input type="radio" value="1" name="broker" required="">Broker
                            </div>
                            <div class="radio-wrap">
                                <input type="radio" value="0" name="broker" required="">Not a Broker
                            </div>
                         </p>

                        </div>
                            @if ($errors->has('broker'))
                            <span class="help-block">
                                <strong>{{ $errors->first('broker') }}</strong>
                            </span>
                            @endif
                    </div>

                    <div class="form-group{{ $errors->has('accept_terms') ? ' has-error' : '' }}">
                     
                            
                         <div class="checkbox-wrap"> 
                             <p>
                             <label class="z1xcva" for="register-email"></label>
                             <input type="checkbox" value="1" name="accept_terms" required=""> I accept the <a
                                href="/terms-of-service"><b>Terms of Service</b></a> and <a href="/privacy-policy/"><b>Privacy
                                    Policy</b></a>
                            @if ($errors->has('accept_terms'))
                            <span class="help-block">
                                <strong>{{ $errors->first('accept_terms') }}</strong>
                            </span>
                            @endif
                            </p>
                         </div>
                        
                    </div>

                    <p class="submit">
                        <label class="z1xcva" for="submitbtn">&nbsp;</label>
                        <input type="submit" class="submit_bottom" value="Register" id="submits" name="submits">
                    </p>
                    <p class="submit"></p>
                    <p class="submit">
                        <label class="z1xcva" for="submitbtn">&nbsp;</label>
                        <a class="green_btn" href="{{url('/forgot_password')}}"
                           title="Password Lost?">Lost your password?</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

</div>


@include('general.footer')
<script>

    function passwordChecker()
    {
    if ($('#password').val() == $('#password_confirmation').val())
    {
    $('#message').html('');
    } else
    {
    $('#message').html('Password Not Matching').css('color', 'red');
    return false;
    }

    }
    $('#registrationForm').submit(function ()
    {
    var APP_URL = {!! json_encode(url('/')) !!}
    $.ajax({
    type: "POST",
            url: APP_URL + '/user_registration',
            data: $(this).serialize(),
            success: function (response)
            {
            document.getElementById("registrationForm").reset();
            Swal.fire({
            title: "Success",
                    text: "Register and Login successfully",
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


</script>
@endsection