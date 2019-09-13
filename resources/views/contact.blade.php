@extends('general.layout')
@section('content')
@include('general.header')
<div class="main" id="main">
    <div class="inner-banner" style="background-image: url(&quot;{{asset(config('url').'/public/images/website_images/view_our_auction.jpg')}}&quot;);">
        <div class="container">
            <h1>CONTACT US</h1>
        </div>
    </div>
    <div class="contact-section">
        <div class="container"> 
            <div class="col-md-3">
                <div class="info">
                    <div>
                        <b>Customer Service:</b> 
                        <a href="tel:203-405-5550"><span>203-405-5550</a></span></a>
                    </div>
                    <div>
                        <b>Email: </b>
                        <a href="mailto:support@boathouseauctions.com"><span>support@boathouseauctions.com</span></a>
                    </div>
                    <div>
                        <b>Address:</b> <br>
                        <div style="padding-left: 15px;" >
                            1175 Bronson Road, <br>
                            Fairfield, CT 06824
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="form_main">
                    <h4 class="heading">Send Us a Message<span></span></h4>
                    <div class="form">
                        <form name="contactform"  action="javascript:void(0);" method="post" id="contactform" >
                            <input type="text" required="" placeholder="Name" name="name" class="txt">
                            <input type="email" required="" placeholder="Email" name="email" class="txt">
                            <input type="text" required="" placeholder="Mobile No" name="mobile_no" class="txt">
                            <textarea rows="3" required="" placeholder="Message" name="comment_message" class="txt_3"></textarea>
                            <input type="submit" value="submit" name="submit" class="txt2">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@include('general.footer')

<script>

    $('#contactform').submit(function ()
    {
    var APP_URL = {!! json_encode(url('/')) !!}
    $.ajax({
    type: "POST",
            url: APP_URL + '/front/save_contact_form',
            data: $(this).serialize(),
            success: function (response)
            {
            document.getElementById("contactform").reset();
            Swal.fire({
            title: "Success",
                    text: "Your Deatils successfully send.",
                    type: "success"
            }).then(function() {
//            window.location = '/';
               window.location.reload();
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
