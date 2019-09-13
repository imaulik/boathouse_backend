<div class="subscribe-cta">
    <div class="container">
        <p class="white-font">Interested in new listings of high-quality brokerage and donated yachts?</p>
        <div class="subscribe-form-wrap">
            <div class="gf_browser_chrome gform_wrapper" id="gform_wrapper_1">
                <form action="javascript:void(0);" method="post" id="subscribeform" class="subscribe-form">
                    {{ csrf_field() }}
                    <div class="col-md-7"> 
                        <input type="email" required id="subscriber" name="email" placeholder="Enter Email Address">
                    </div>
                    <div class="col-md-5 gform_footer top_label"> 
                        <input name="Subscribe" type="submit" id="submit" class="Subscribe" value="Subscribe"> 
                    </div>
                    <div class="col-md-12 boat-house-form-checkbox"> 
                        <div class="col-md-4" style="color:#fff;"> 
                            <input style="width:15px" type="radio" required id="subscriber_broker" value="broker" name="check_broker" required>Broker
                        </div>
                        <div class="col-md-4" style="color:#fff;"> 
                            <input  style="width:15px" type="radio" required id="subscriber_broker" value="non_broker" name="check_broker">Non Broker
                        </div>
                        <div class="col-md-4"> </div>
                    </div>
                </form>
            </div>
     
        </div>
    </div>
</div>

<script>
    $('#subscribeform').submit(function ()
    {
    var APP_URL = {!! json_encode(url('/')) !!}
    $.ajax({
    type: "POST",
            url: APP_URL + '/subscribe_email/save_subscribe_email',
            data: $(this).serialize(),
            success: function (response)
            {
            document.getElementById("subscribeform").reset();
            Swal.fire('Success', 'Email Subscribe Successfully', 'success')
            },
            error: function (error)
            {   
            Swal.fire('Error',error.responseJSON, 'error')
            }
    });
    });

</script>