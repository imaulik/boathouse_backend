@extends('general.layout')
@section('content')
@include('general.header')
<div class="main" id="main">
    <div class="my_box3 breadcrumb-wrap">
        <div class="box_title" style="font-weight: bold; font-size:23px; padding-left:10px;">FORM FOR POTENTIAL AUCTION INCLUSION</div>
        <div class="box_content">
            <div class="login-submit-form">
                <div id="error_div"></div>

                <form class="form-horizontal" id="vesselForm" method="post" action="javascript:void(0);">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">

                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <p>
                            <label class="gfield_label" for="input_2_1">First Name:<span class="gfield_required">*</span></label>

                            <input id="first_name" required type="text" class="do_input" name="first_name" value="{{ old('first_name') }}">

                            @if ($errors->has('first_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                            @endif
                        </p>
                    </div>
                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <p>
                            <label class="gfield_label" for="input_2_1">Last Name:<span class="gfield_required">*</span></label>

                            <input id="last_name" required type="text" class="do_input" name="last_name" value="{{ old('last_name') }}" >

                            @if ($errors->has('last_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                            @endif
                        </p>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <p>
                            <label class="gfield_label" for="input_2_1">Email:<span class="gfield_required">*</span></label>

                            <input id="email" required type="email" class="do_input" name="email" value="{{ old('email') }}" >

                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </p>
                    </div>

                    <div class="form-group{{ $errors->has('mobile_no') ? ' has-error' : '' }}">
                        <p>
                            <label class="gfield_label" for="input_2_1">Cell:<span class="gfield_required">*</span></label>

                            <input id="mobile_no" required  type="text" class="do_input" name="mobile_no">

                            @if ($errors->has('mobile_no'))
                            <span class="help-block">
                                <strong>{{ $errors->first('mobile_no') }}</strong>
                            </span>
                            @endif
                        </p>
                    </div>
                    <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                        <p>
                            <label class="gfield_label" for="input_2_1">Year:<span class="gfield_required">*</span></label>

                            <input id="year" required  type="text" class="do_input" name="year" >

                            @if ($errors->has('year'))
                            <span class="help-block">
                                <strong>{{ $errors->first('year') }}</strong>
                            </span>
                            @endif
                        </p>
                    </div>
                    <div class="form-group{{ $errors->has('make') ? ' has-error' : '' }}">
                        <p>
                            <label class="gfield_label" for="input_2_1">Make:<span class="gfield_required">*</span></label>

                            <input id="make" required type="text" class="do_input" name="make" >

                            @if ($errors->has('make'))
                            <span class="help-block">
                                <strong>{{ $errors->first('make') }}</strong>
                            </span>
                            @endif
                        </p>
                    </div>
                    <div class="form-group{{ $errors->has('length') ? ' has-error' : '' }}">
                        <p>
                            <label class="gfield_label" for="input_2_1">Length:<span class="gfield_required">*</span></label>

                            <input id="length" required  type="text" class="do_input" name="length">

                            @if ($errors->has('length'))
                            <span class="help-block">
                                <strong>{{ $errors->first('length') }}</strong>
                            </span>
                            @endif
                        </p>
                    </div>
                    <div class="form-group{{ $errors->has('broker_check') ? ' has-error' : '' }}">
                        <p>
                            <label class="gfield_label" for="input_2_1">Are You A Broker:<span class="gfield_required">*</span></label>

                            <input id="broker_check" required type="radio" value="1" name="broker_check" >Yes
                            <input id="broker_check" required type="radio" value="0" name="broker_check" >No

                            @if ($errors->has('broker'))
                            <span class="help-block">
                                <strong>{{ $errors->first('broker_check') }}</strong>
                            </span>
                            @endif
                        </p>
                    </div>
                    <div style="display: none;" class="broker_name form-group{{ $errors->has('brokerage_name') ? ' has-error' : '' }}">
                        <p>
                            <label class="gfield_label" for="input_2_1">Brokerage Name:<span class="gfield_required">*</span></label>

                            <input id="brokerage_name"   type="text" class="do_input" name="brokerage_name">

                            @if ($errors->has('brokerage_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('brokerage_name') }}</strong>
                            </span>
                            @endif
                        </p>
                    </div>
                    <p class="submit">
                        <label class="z1xcva" for="submitbtn">&nbsp;</label>
                        <input type="submit" class="submit_bottom" value="SUBMIT VESSEL >>" id="submits" name="submits">
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

@include('general.footer')
<script>
    $(document).ready(function ()
    {

    $("input[name$='broker_check']").click(function ()
    {
    var test = $(this).val();
    if (test == '1')
    {
    $('.broker_name').css("display", "block");
    } else
    {
    $('.broker_name').css("display", "none");
    }
    });
    });
    $('#vesselForm').submit(function ()
    {
    var APP_URL = {!! json_encode(url('/')) !!}
    $.ajax({
    type: "POST",
            url: APP_URL + '/submitNewVessel',
            data: $(this).serialize(),
            success: function (response)
            {
            document.getElementById("vesselForm").reset();
            Swal.fire({
            title: "Success",
                    text: "Created successfully",
                    type: "success"
            }).then(function() {
            window.location = '/post_new_auction';
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