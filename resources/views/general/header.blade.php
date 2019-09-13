<header id="header">
    <!--    <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">                  
                    </div>
                    <div class="col-sm-6">
                        <ul class="acc-meta">
                            <li>
                                @if(\Illuminate\Support\Facades\Auth::user())
                                <a href="{{url('/post_new_auction')}}" class="">Submit Vessel</a>
                                @endif                               
                            </li>
                            <li>
                                @if(\Illuminate\Support\Facades\Auth::user())
                                <a href="" class=""> My Account</a>
                                @else
                                <a href="{{url('/login')}}" class=""> My Account</a>
                                @endif
    
                            </li>
                            @if(\Illuminate\Support\Facades\Auth::user())
                            <li><a class="" href="{{url('/logout')}}">Logout</a></li>
                            @else
                            <li><a href="{{url('/login')}}" class="">Login</a> </li>
                            <li><a class="" href="{{url('/register')}}">Register</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>-->
    <div class="header-main">
        <div class="container">
            <div class="row header-in">
                <div class="col-sm-3 logo">
                    <a href="{{ url('/') }}">
                        <img id="logo" height="50" alt="Boathouse Auctions Brokers, Owners, Sellers, Buyers" src="{{asset(config('url').'public/images/header/new_logo.jpg')}}">
                    </a>
                </div>
                <div class="col-sm-9 nav-menu">
                    <a class="menulinks"><i></i></a>
                    <ul id="menu-primary-menu" class="mainmenu">
                        <li id="menu-item-1498" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1498 menu_dropdown_submenu">
                            <a class="menu_dropdown_submenu" href="#">Buy</a>
                            <ul>
                                <li><a href="{{url('/view-our-auctions')}}">Current Vessels</a></li>
                                <li><a href="{{url('/sold-our-auctions')}}">Sold Vessels</a></li>
                            </ul>
                        </li>
                        <li id="menu-item-3577" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3577">
                            <a href="{{url('/sell')}}">Sell</a>
                        </li>                        
                        <li id="menu-item-1935" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1935">
                            <a href="{{url('/how-it-works')}}">How it Works</a>
                        </li>
                        <li id="menu-item-3577" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3577">
                            <a href="{{url('/films')}}">Film</a>
                        </li>
                        <li id="menu-item-3577" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3577 menu_dropdown_submenu">
                            <a class="menu_dropdown_submenu" href="#">Company</a>
                            <ul>
                                <li><a href="{{url('/about-us')}}">About Us</a></li>
                                <li><a href="{{url('/contact')}}">Contact</a></li>
                            </ul>
                        </li>                        
                        <li id="menu-item-3577" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3577">
                            <a href="{{url('/cost-calculator')}}">Calculator</a>
                        </li>
                        @if(\Illuminate\Support\Facades\Auth::user())
                        <li>
                            <a class="" href="{{url('/my_activity')}}">My Account</a>
                        </li>
                        <li>
                            <a class="" href="{{url('/logout')}}">Logout</a>
                        </li>
                        @else
                        <li>
                            <a href="{{url('/login')}}" class="">Login</a> <b style="color:#fff;font-size: 19px;">|</b> <a class="" href="{{url('/register')}}">Register</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
