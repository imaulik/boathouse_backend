@extends('general.layout')
@section('content')
<header style="background-color: #000;color: #fff">
    <div class="limiter">
        <h3 style="color: #fff">Bidding Authorization To Participate In Auction</h3>
    </div>
</header>
<div class="main" id="main">
    <div class="creditCardForm">
        <div style="width:100%; text-align:center;">
            <a href="{{url('/')}}">
            <img src="{{asset(config('url').'/public/images/header/new_logo.jpg')}}">
            </a>
        </div>
        <div class="heading">
            <h1 style="font-size:25px">Authorization to Bid</h1>
        </div>
        <div class="payment">

            Bidding on this vessel requires a $10,000 deposit and the name of your broker. Please fill out the credit card form below. 
            An <q>authorization hold</q> will be placed on all bidders’ cards. 
            At the conclusion of the auction, the winning bidder’s hold is converted to a $10,000 charge, while all other bidder holds are released. 

            <br><br>

            <form method="post" name="depositform" action="javascript:void(0);" id="depositform">
                @if($data)
                <input type="hidden" name="vessel_id" value="{{$data['id']}}">
                @endif
                <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                Do you work with a broker? &nbsp;  &nbsp;   
                <input type="radio" value="broker" name="check_broker" required=""> Yes &nbsp; 
                <input type="radio" value="non_broker" required="" name="check_broker"> No <br><br>

                If yes: 

                <br> <br> 
                Broker Name <input type="text" class="form-control" name="broker_name"><br>
                Brokerage Name <input type="text" class="form-control"  name="brokerage_name"><br><br> 
                Amount ($) <input type="text" class="form-control" value="{{$data['deposit_amount']}}" readonly  name="deposit_amount"><br><br>

            
                <div class="form-group" id="pay-now">
                    <button type="submit" class="btn btn-default test" id="confirm-purchase" name="confa">Confirm</button>
                </div>
            </form>
            <div class="after_cnf_btn_text">
                If you have any questions, please contact us at  support@boathouseauctions.com  or  203-405-5550.
            </div>
        </div>



    </div>
</div>
@include('general.footer')
<script>
    $('#depositform').submit(function ()
    {
        console.log('hi');
                var APP_URL = {!! json_encode(url('/')) !!}
        $.ajax({
            type: "POST",
            url: APP_URL + '/save_deposit_form',
            data: $(this).serialize(),
            success: function (response)
            {   var vessel_slug = "<?php echo $data['slug']; ?>";
                document.getElementById("depositform").reset();
                Swal.fire({
                    title: "Success",
                    text: "Deposit successfully Paid",
                    type: "success"
                }).then(function ()
                {
                   window.location = APP_URL + '/view-our-auctions/' + vessel_slug;
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