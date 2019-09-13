@extends('general.layout')
@section('content')
@include('general.header')
<div class="main" id="main">
    <div class="acution-content-wrap">
        <h1 class="the-pst-title">{{$data['title']}}</h1>
        <div class="ev1ev2">
            <ul class="auction-details1a">
                <li>
                    @if(\Illuminate\Support\Facades\Auth::user())
                    <p>OPENING PRICE: <strong class="stff">${{$data['auction_start_price']}}</strong> </p>
                    @else
                    <p>OPENING PRICE: <strong class="stff"><span class="blurr-cls"></span></strong> </p>
                    @endif
                </li>
                @if(!$data['auction_closed'])
                <li>
                    <p>
                        <b>ENDS IN: &nbsp;&nbsp;</b>
                    <p id="clockdiv_{{$data['id']}}" style="color:#FF0000">
                        <span class="days"></span>
                        <span class="hours"></span>
                        <span class="minutes"></span>
                        <span class="seconds"></span>
                    </p>
                    </p>
                </li>
                @endif
                <li class="hhhhjjjj hjj22">
                    <a class="button button-narrow button-white" href="{{url('/how-it-works')}}">How It Works</a>
                    <a class="button button-narrow button-white2 " href="#comment_bid">BID &amp; COMMENT</a>
                </li>
            </ul>
        </div>

        <div class="main_img" style="text-align: center;">
            @if($data['feature_image'])
            <img src="{{asset('storage/app/public/Uploads/images/'.$data['feature_image'])}}" title="{{$data['title']}}"><style>body { background: #fff }</style>
            @else
            <img src="{{asset('storage/app/public/Uploads/images/Hbp3TOkk0cmxbaRkvfW2rMuTe.jpg')}}" title="{{$data['title']}}"><style>body { background: #fff }</style>
            @endif

        </div>
        
        <div class="card-section">
            
            <div class="col-md-4 px-1 py-5">
                <div class="card">
                    <div class="inner">
                        <h1>Auction Details</h1>
                        <div class="inner-box">
                            <div class="buyer-premium">{{$data['title']}}</div>
                            <div class="dates">
                                <p><span>Starts on:</span>{{$data['auction_begins']}}</p>
                                    <p><span>Ends on:</span>{{$data['auction_ends']}}</p>
                            </div>
                             
                                <input name="Subscribe" type="submit" id="submit" class="reg-bid" value=" Register to Bid"> 
                           
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-md-4 px-1 py-5">
                <div class="card">
                    <div class="inner">
                        <h1>Fees & Rebates</h1>
                            <div class="inner-box">
                                <div class="buyer-premium">Buyer's Premium: <span>5%</span> </div>
                                <div class="buyer-premium">Buyers Rebate: <span> Yes </span>
                                </div>
                                <div class="buyer-premium"> Co Brokerage Commission: <span> Yes </span></div>
                            </div>
                    </div>
                </div>
            </div>
             <div class="col-md-4 px-1 py-5">
                <div class="card">
                    <div class="inner">
                        <h1>Agreements</h1>
                            <div class="inner-box agree">
                                @if($data['bidders_agreement'])
                                <a href="{{$data['bidders_agreement']}}">Bidders agreement</a>
                                @else
                                <a>Bidders agreement</a>
                                @endif
                                @if($data['opening_bid_incentive'])
                                <a href="{{$data['opening_bid_incentive']}}">Opening Bid Incentive</a>
                                @else
                                <a>Opening Bid Incentive</a>
                                @endif
                            </div>
                    </div>
                </div>
            </div>
            
             
                
        </div>
      
        
        <div class="col-xs-12 col-sm-8 col-lg-8 xs-nospc">
            <div class="my-main-desc">
                @if($data['description'])
                {!! $data['description'] !!}
                @endif
            </div>
            <div class="my-photo-gal-desc">
                <div class="photo-gal-ttl">PHOTO GALLERY</div>

                <div class="gal-gal-gal">
                    <div class="grid-images-section">
                        @foreach($galleryimages as $gall)
                        <div class="col-sm-4">
                            <figure>
                                <a  data-fancybox="gallery" href="{{asset('storage/app/public/Uploads/images/'.$gall['image_name'])}}" >
                                    <img  class="img-fluid" src="{{asset('storage/app/public/Uploads/images/'.$gall['image_name'])}}">
                                </a>
                            </figure>
                        </div>
                        @endforeach
                    </div> 
                </div>
            </div>
            <div class="my_box3" id="comment_bid">
                <div class="col-xs-12 col-sm-12 col-lg-12" style="padding:0; margin: 0">
                    <div class="bid_panel" name="bid_panelaa" id="bid_panelaa">
                        <div class="padd10vv">
                            <div class="bid-on-this">BID ON THIS VESSEL</div>
                            <form method="post" id="my_bid_form_1" action="">
                                <input type="hidden" value="1" name="bid_now_cc">
                                <ul class="auction-details">
                                    <li>
                                        <h3>Opening Bid:</h3>
                                        @if(\Illuminate\Support\Facades\Auth::user())
                                        <p >${{$data['auction_start_price']}}</p>
                                        @else
                                        <p ><span class="blurr-cls"></span></p>
                                        @endif
                                    </li>
                                    <li>
                                        <h3>Current Bid:</h3>
                                        @if(\Illuminate\Support\Facades\Auth::user())
                                        <p >${{$data['last_bid_price']}}</p>
                                        @else
                                        <p ><span class="blurr-cls"></span></p>
                                        @endif
                                    </li>
                                    <li>
                                        <h3>Starts On:</h3>
                                        <p>{{$data['auction_begins']}}</p>
                                    </li>
                                    <li>
                                        <h3>Ends on:</h3>
                                        <p>{{$data['auction_ends']}}</p>
                                    </li>
                                     @if(!$data['auction_closed'])
                                    <li>
                                        <h3>Time left:</h3>
                                        <p id="clockdiv_{{$data['id']}}" style="color:#FF0000">
                                            <span class="days"></span>
                                            <span class="hours"></span>
                                            <span class="minutes"></span>
                                            <span class="seconds"></span>
                                        </p>
                                    </li>
                                    @endif
                                    <li>
                                        <h3>Bids:</h3>
                                        @if(\Illuminate\Support\Facades\Auth::user())
                                        <p>{{$data['bid_count']}}</p>
                                         @else
                                        <p ><span class="blurr-cls"></span></p>
                                        @endif
                                    </li>
                                       @if(!$data['auction_closed'])
                                    <li>
                                        <h3>Place Bid (Bid increment: ${{$data['incremental_bid']}} minimum)</h3>
                                        <p>
                                            @if(\Illuminate\Support\Facades\Auth::user() && isset($user_details['id']) && $data['auction_begins'] <= now())

                                            <input  type="hidden" value="{{$data['incremental_bid']}}"  id="incremental_bid" name="incremental_bid" >
                                            <input  type="text"  id="bid_amount" name="bid_price"  placeholder="Bid Amount">
                                            <input class="submit_bottom" type="button" onclick="PlaceBidForm({{\Illuminate\Support\Facades\Auth::user()->id}}, {{$data['id']}})"  id="place_bid" name="bid_now" value="Place Bid">
                                        <p id="required_bid_amount" style="display: none;color:red;font-weight: 100;">Please Enter Bid Amount.</p>
                                        <p id="minimum_bid_amount" style="display: none;color:red;font-weight: 100;">Your bid must be higher than ${{$data['last_bid_price']+$data['incremental_bid']}} .</p>
                                        <p id="alredy_bid_amount" style="display: none;color:red;font-weight: 100;">Your bid is already the highest bid.</p>

                                        @elseif(\Illuminate\Support\Facades\Auth::user() && $data['auction_begins'] <= now())

                                        <input class="submit_bottom" type="button" onclick="DepositForm()" id="deposit_form" name="bid_now" value="Deposit Required, Click Here">

                                        @elseif(\Illuminate\Support\Facades\Auth::user())

                                        <div class="boat-agreement-main">
                                            <span class="label">Auction is Not Open</span>
                                        </div>

                                        @else

                                        <a class="" href="{{url('/register')}}">
                                            <input class="submit_bottom" type="button" id="place_bid" name="bid_now" value="Register to Bid">
                                        </a>

                                        @endif
                                        </p>

                                        @if(\Illuminate\Support\Facades\Auth::user() && isset($user_details['id']) && $data['auction_begins'] <= now())

                                        <span></span>

                                        @elseif(\Illuminate\Support\Facades\Auth::user() && $data['auction_begins'] <= now())

                                        <div class="boat-agreement-main">
                                            <label class="check_box">
                                                <input type="checkbox" name="agreement_check" id="bidders-sales-agreement"><span>I agree to the</span>  
                                                <span class="checkbox_check" id="checkbox_check" style="display: none;color:red;font-weight: 100;">Please check that you agree to the Bidders Sales Agreement.</span>
                                            </label>
                                            <a class="seller-document" style="display: block; text-decoration: underline;" href="" target="_blank">Bidders Sales Agreement</a>
                                        </div>
                                        @endif
                                    </li>
                                    @endif
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            @if($data['allowed_comment'] == 1 || $data['allowed_comment'] == true)
<!--            <div class="my_box3" id="comment_bid">
                <div class="clear10"></div>
                <form action="javascript:void(0);" method="post" id="commentform" class="comment-form">
                    {{ csrf_field() }}
                    <input type="hidden" name="vessel_id" value="{{$data['id']}}" id="vessel_id">
                    <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::id()}}" id="user_id">
                    <p class="comment-form-comment"> 
                        <textarea class="rzvrzv" required id="comment" name="comment_message" cols="45" rows="5" aria-required="true" placeholder="Add a Comment"></textarea>
                    </p>
                    <p class="form-submit">
                        @if(\Illuminate\Support\Facades\Auth::user())
                        <input name="submit" type="submit" id="submit" class="submit" value="Submit"> 
                        @else
                        <a href="{{url('/register')}}">
                            <input name="submit" type="button" id="submit" class="submit" value="Submit"> 
                        </a>
                        @endif
                    </p>			
                </form>
                @if($data['commentselect'])
                <div id="comments">
                    <ol class="commentlist">
                        @foreach($data['commentselect'] as $comment)
                        <li class="comment byuser comment-author-matt540 even thread-even depth-1" id="comment-1">       
                            <div id="div-comment-1" class="comment-body">
                                <div class="date-comms">
                                    <a href="#">{{$comment['created_at']}}</a>
                                </div>
                                <div class="commes-comms">
                                    <div class="comment-author vcard">
                                        <cite class="fn">{{$comment['userdetails']['email']}}</cite>  
                                    </div>         
                                    <div class="comment-meta commentmetadata">
                                    </div>
                                    <p>{{$comment['comment_message']}}</p>
                                </div> 
                            </div>
                        </li>
                        @endforeach
                    </ol>
                </div>
                @endif
            </div>-->
            @endif
        </div>

        <div id="right-sidebar" class="page-sidebar col-xs-12 col-sm-4 col-lg-4">
            <ul class="xoxo">           
                <li id="boat_details">
                    <div class="boat_title_details">Vessel Details</div>
                    <div class="cc_cont_cc">
                        <ul class="boat-info-sidebar">
                            <li><strong>Location: </strong>{{$data['location']}}</li>
                            <li><strong>Year: </strong>{{$data['year']}}</li>
                            <li><strong>Make: </strong>{{$data['make']}}</li>
                            <li><strong>Model: </strong>{{$data['model']}}</li>
                            <li><strong>LOA: </strong>{{$data['loa']}}</li>
                            <li><strong>Beam: </strong>{{$data['beam']}}</li>
                            <li><strong>Draft: </strong>{{$data['draft']}}</li>
                            <li><strong>Co-Brokerage: </strong>
                                @if($data['location'] == 1)
                                Yes
                                @else
                                No
                                @endif
                                <hr>
                            </li>
                            <li><strong>Preview Period: </strong>{{$data['preview_period']}}</li>
                            <li><strong>Haul Out: </strong>{{$data['haul_out']}}</li>
                            <li><strong>Sea Trial: </strong>{{$data['sea_trial']}}</li>
                            <li><strong>Opening Bid Incentive: </strong></li>
                            <li><strong>Auction Begins: </strong>{{$data['auction_begins']}}</li>
                            <li><strong>Auction Ends: </strong>{{$data['auction_ends']}}</li>
                            <li><hr><strong>Broker Name: </strong>{{$data['broker_name']}}</li>
                            <li><strong>Broker Email: </strong>{{$data['broker_email']}}</li>
                            <!--<li><strong>Broker Cell Phone: </strong></li>-->
                        </ul>
                    </div>
                </li>
<!--                <li>
                    <div class="sharethis-inline-share-buttons st-center st-has-labels  st-inline-share-buttons st-animated" id="st-1">
                        <div class="st-btn st-first" data-network="facebook" style="display: inline-block;">
                            <span class="st-label"><i class="fa fa-facebook"></i></span>
                        </div>
                        <div class="st-btn st-remove-label" data-network="twitter" style="display: inline-block;">
                            <span class="st-label"><i class="fa fa-twitter"></i></span>
                        </div>
                        <div class="st-btn st-remove-label" data-network="messenger" style="display: inline-block;">
                            <span class="st-label"><i class="fa fa-comment"></i></span>
                        </div>
                        <div class="st-btn st-last st-remove-label" data-network="email" style="display: inline-block;">
                            <span class="st-label"><i class="fa fa-envelope"></i></span>
                        </div>
                    </div>
                </li>-->
                <li class="widget-container latest-posted-auctions" style="padding-bottom:0; font-size:14px; font-weight:bold">
                    <ul class="bagaz">
<!--                        <li><a href="{{url('/how-it-works#buyers')}}">How it works for buyers</a></li>
                        <li><a href="{{url('/how-it-works#owners')}}">How it works for owners</a></li>
                        <li><a href="{{url('/how-it-works#brokers')}}">How it works for brokers</a></li>
                        <li><a href="{{url('/')}}">Sign-up for listings e-mail updates</a></li>
                        <li>         
                            @if(\Illuminate\Support\Facades\Auth::user())
                            <a href="{{url('/post_new_auction')}}" class="">Submit your vessel</a>
                            @else
                            <a href="{{url('/register')}}" class="">Submit your vessel</a>
                            @endif   
                        </li>  -->
                    @if(isset($data['additional_fields']))
                    @foreach($data['additional_fields'] as $fields)
                        @if(\Illuminate\Support\Facades\Auth::user())
                            <li>
                            <a href="{{asset('storage/app/public/Uploads/pdf_files/'.$fields['field_filename'])}}" target="_blank">
                                {{$fields['title']}}
                            </a>
                            </li>    
                            @else
                            <li>
                            <a  href="http://boathouse.eworkdemo.com/register">
                                {{$fields['title']}}
                            </a>
                            </li>
                        @endif
                    @endforeach
                    @endif
                    </ul>
                </li>

<!--                <li id="latest-posted-auctions-3" class="widget-container latest-posted-auctions">
                    <h3 class="widget-title">OTHER AUCTIONS</h3>
                    <div class="my-only-widget-content">
                        @foreach($other_autions as $other_aution)
                        <div class="post post-va-va small-padd-top">
                            <a href="{{url('/view-our-auctions/'.$other_aution['slug'])}}">
                                <img width="235" height="159" src="{{asset('storage/app/public/Uploads/images/'.$other_aution['feature_image'])}}" class="whpna" alt="" srcset="" sizes="(max-width: 235px) 100vw, 235px">
                            </a>
                        </div>
                        @endforeach
                        <div class="TEXT-ALIGN-CENTER">
                            @if(\Illuminate\Support\Facades\Auth::user())
                            <a href="{{url('/post_new_auction')}}" class="button button-red">SUBMIT YOUR VESSEL</a>
                            <button class="button button-red">SUBMIT YOUR VESSEL</button>
                            @else
                            <a href="{{url('/register')}}" class="button button-red">SUBMIT YOUR VESSEL</a>
                            <button class="button button-red">SUBMIT YOUR VESSEL</button>
                            @endif 
                        </div>
                    </div>
                </li>-->
            </ul>
        </div>
    </div>
</div>
@include('general.footer')


<script>
    $(document).ready(function() {
    $(window).keydown(function(event){
    if (event.keyCode == 13) {
    event.preventDefault();
    return false;
    }
    });
    
    $(".reg-bid").on('click',function(){
			window.location = "#comment_bid";
		});
    });
    var APP_URL = {!! json_encode(url('/')) !!}
    $('#commentform').submit(function ()
    {
    $.ajax({
    type: "POST",
            url: APP_URL + '/vessel_comment/save_vessel_comment',
            data: $(this).serialize(),
            success: function (response)
            {
            document.getElementById("commentform").reset();
            Swal.fire({
            title: "Success",
                    text: "Comment Add successfully",
                    type: "success"
            }).then(function ()
            {
            location.reload();
            });
            },
            error: function (error)
            {
            console.log(error);
            Swal.fire('Error', 'Something went wrong!', 'error')
            }
    });
    });
    function DepositForm()
    {
    var checkbox_check = document.getElementById("bidders-sales-agreement").checked;
    $('#checkbox_check').css("display", "none");
    if (checkbox_check)
    {
    var vessel_slug = "<?php echo $data['slug']; ?>";
    window.location = APP_URL + '/bid_deposit_form/' + vessel_slug;
    } else
    {
    $('#checkbox_check').css("display", "block");
    }
    }

    function PlaceBidForm(user_id, vessel_id)
    {
    var APP_URL = {!! json_encode(url('/')) !!}
    var first_bid =<?php echo $data['last_bid']; ?>;
    var bid_amount = document.getElementById("bid_amount").value;
    if (first_bid)
    {
    var minimum_bid_amount = <?php echo $data['last_bid_price']; ?>;
    var incremental_bid = 0;
    } else
    {
    var minimum_bid_amount = <?php echo $data['last_bid_price'] + $data['incremental_bid']; ?>;
    var incremental_bid = document.getElementById("incremental_bid").value;
    }

    if (bid_amount && bid_amount != '')
    {

    $('#required_bid_amount').css("display", "none");
    if (bid_amount >= minimum_bid_amount)
    {

    $('#minimum_bid_amount').css("display", "none");
    Swal.fire({
    title: 'Bid Confirmation',
            text: "Your bid amount: $" + bid_amount,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Place BID'
    }).then((result) => {
    if (result.value) {
    $.ajax({
    type: "POST",
            url: APP_URL + '/vessel_bid/save_vessel_bid',
            data: {
            'bid_amount':bid_amount,
                    'vessel_id':vessel_id,
                    'user_id':user_id,
                    'incremental_bid':incremental_bid
            },
            success: function (response)
            {
            document.getElementById("bid_amount").value = '';
            Swal.fire({
            title: "Success",
                    text: "Bid Add successfully",
                    type: "success"
            }).then(function ()
            {
            location.reload();
            });
            },
            error: function (error)
            {
            Swal.fire('Error', error.responseJSON, 'error')
            }
    });
    }
    });
    } else
    {
    $('#minimum_bid_amount').css("display", "block");
    }
    } else
    {
    $('#required_bid_amount').css("display", "block");
    }
    }


    function getTimeRemaining(endtime)
    {
    var t = Date.parse(endtime.replace(/\s/, 'T')) - Date.parse(new Date());
    
    var seconds = Math.floor((t / 1000) % 60);
    var minutes = Math.floor((t / 1000 / 60) % 60);
    var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    
    return {
    'total': t,
            'days': days,
            'hours': hours,
            'minutes': minutes,
            'seconds': seconds
    };
    }

    function initializeClock(id, endtime)
    {
    var clock = document.getElementById(id);
    var daysSpan = clock.querySelector('.days');
    var hoursSpan = clock.querySelector('.hours');
    var minutesSpan = clock.querySelector('.minutes');
    var secondsSpan = clock.querySelector('.seconds');
    function updateClock()
    {
    var t = getTimeRemaining(endtime);
    if (t.days != 0)
    {
    daysSpan.innerHTML = t.days + "<span class='label'> Days</span>";
    } else
    {
    hoursSpan.innerHTML = ('0' + t.hours).slice( - 2) + "<span class='label'><b> : </b></span>";
    minutesSpan.innerHTML = ('0' + t.minutes).slice( - 2) + "<span class='label'><b> : </b></span>";
    secondsSpan.innerHTML = ('0' + t.seconds).slice( - 2);
    }
    if (t.total <= 0)
    {
    clearInterval(timeinterval);
    }
    }


    updateClock();
    var timeinterval = setInterval(updateClock, 1000);
    }

    var deadline = new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000);
    var auction_clocks =<?php echo json_encode($data); ?>;
    
    initializeClock('clockdiv_' + auction_clocks.id, auction_clocks.auction_ends);


 




</script>

<script>
 
function equalheight(container){
              
var currentTallest = 0,
     currentRowStart = 0,
     rowDivs = new Array(),
     $el,
     topPosition = 0;
 $(container).each(function() {

   $el = $(this);
   $($el).height('auto')
   topPostion = $el.position().top;

   if (currentRowStart != topPostion) {
     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
       rowDivs[currentDiv].height(currentTallest);
     }
     rowDivs.length = 0; // empty the array
     currentRowStart = topPostion;
     currentTallest = $el.height();
     rowDivs.push($el);
   } else {
     rowDivs.push($el);
     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
  }
   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
     rowDivs[currentDiv].height(currentTallest);
   }
 });
}   
    
$(window).on('load', function(){ 
  equalheight('.card-section .card');
});


$(window).on('resize', function(){
  equalheight('.card-section .card');
});
</script>
<style>
    .label {
        font-size: 14px;
        color: #f00;
        padding-left: 2px;
        font-weight: 500;
    }
    .clock_countdown
    {
        color: #f00;
    }

    
    
    
    .card-section .inner h1 {
    font-size: 24px;
    line-height: 29px;
    color: rgba(0, 0, 0, 0.87);
}

.card-section .inner {
    padding: 0 30px 30px;
}

.card-section .inner .inner-box {
    padding-left: 15px;
}

.card-section .inner-box .title {
    padding: 15px 0;
    font-size: 15px;
    line-height: 25px;
    color: rgba(0, 0, 0, 0.87);
}

.card-section .inner-box .dates p {font-size: 15px;line-height: 25px;color: rgba(0, 0, 0, 0.87);}
.card-section .inner-box .dates p span {
    font-weight: 700;
    padding-right: 10px;
}

.card-section .inner-box .dates {
    padding-bottom: 17px;
}

.card-section .inner-box .dates {
    padding-bottom: 18px;
}

.card-section .inner .inner-box input#submit {
    padding: 8px 103px;
    height: 32px;
}

 
.card-section .inner .inner-box .buyer-premium {
       padding: 8px 0;
    font-size: 18px;
    line-height: 23px;
}

.card-section .inner .inner-box .buyer-premium  span {font-weight:700;}


.card-section .inner .inner-box a {
    display: inherit;
    font-size: 18px;
    padding: 5px  0;
    color: #333333;
}

.card-section .inner .inner-box.agree {
    padding-top: 2px;
}
.card-section .card {
    box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.22);
}
.card-section .inner .inner-box input#submit {
height: 32px;
max-width: 306px;
width: 100%;
text-align: center;
}
.boat-agreement-main label.check_box {
    margin: 0;
    padding-top: 18px;
}

.boat-agreement-main label.check_box input {
    display: inline-block;
    vertical-align: middle;
    margin: 0;
    height: 25px;
}

.boat-agreement-main label.check_box span {
    display: inline-block;
    vertical-align: middle;
    padding-left: 10px;
}

  span.blurr-cls {position: relative;    padding: 4px 22px 0px;}
.prev-auct-cell-inner .time-zone h5:first-child {
    padding-right: 25px;
}
 span.blurr-cls:after {        content: '';
    position: absolute;
    width: 20px;
    height: 10px;
    background-color: #000;
    top: 50%;
    transform: translateY(-50%);
    left: 15px;}

</style>

@endsection