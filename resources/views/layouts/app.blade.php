<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>belook</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

<!--===============================================================================================done-->
<link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.png') }}"/>
<!--===============================================================================================done-->
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================done-->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================done-->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/themify/themify-icons.css') }}">
<!--===============================================================================================done-->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================done-->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/elegant-font/html-css/style.css') }}">
<!--===============================================================================================done-->
    <link rel="stylesheet" type="text/css" href="{{ asset('animate/animate.css') }}">
<!--===============================================================================================done-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================done-->
    <link rel="stylesheet" type="text/css" href="{{ asset('animsition/css/animsition.min.css') }}">
<!--===============================================================================================done-->
    <link rel="stylesheet" type="text/css" href="{{ asset('select2/select2.min.css') }}">
<!--=============================================================================================== done -->
    <link rel="stylesheet" type="text/css" href="{{ asset('daterangepicker/daterangepicker.css') }}">
<!--=============================================================================================== done -->
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}">
<!--=============================================================================================== done -->
    <link rel="stylesheet" type="text/css" href="{{ asset('lightbox2/css/lightbox.min.css') }}">
<!--=============================================================================================== done-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app-laravel.css') }}">

<!--===============================================================================================-->
    <style>
        @media (max-width: 992px){
            body{
                margin-top: 118px !important;
            }
        }

        .tomato{
            background-color: #e65540;
        }
        .square_img{
            height: auto;
            width: 100%;
        }
        .square {
            height: 0;
            padding-bottom: 100%;
            width: 100%;
        }
        .rectangle{
            height: 0;
            padding-bottom: 120%;
            width: 100%;   
        }

        .green {
            background-color: #80c950;
        }

        .mylabel{
            background-color: #e65540;
            z-index: 100;
            font-family: Montserrat-Regular;
            font-size: 14px;
            color: white;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 22px;
            border-radius: 11px;
            position: absolute;
            top: 12px;
            left: 12px;
        }

        .search-product{
            margin-left: 25%;
        }
    </style>
 @yield('head')

</head>
<body>
    <!-- header fixed -->
    <div class="wrap_header fixed-header2 trans-0-4" id="wrap_header">
        <!-- Logo -->
        <a href="index.html" class="logo">
            <img src="{{asset('images/logo/logo.jpg')}}" alt="IMG-LOGO" style="max-height: 63px;">
        </a>
        <!-- Menu -->
        <div class="wrap_menu">
            <nav class="menu">
                <ul class="main_menu">
                    @yield('nav')
                   <li style="margin-right: 120px; padding-right: 0;">
                        <form action="{{route('searchgood')}}" method="POST" stylr="border: 1px solid #e2dede;">
                            {{csrf_field()}}
                            <input class="s-text7 size4 p-l-23 p-r-50 form-control" type="text" name="searchgood" placeholder="@if(empty($searchgood))Поиск товаров...@else{{$searchgood}}@endif">
                            @if(!empty($currentCat))
                            <input type="hidden" value="{{$currentCat->id}}" name="currentCat">
                            @endif
                            <button type="submit" class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4" style="width: 65px !important;">
                                <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
        
        <!-- Header Icon -->
        <div class="header-icons">
            @if (Auth::guest())
                <a class="header-wrapicon1 dis-block m-l-30" href="{{ route('login') }}"><span class="muted">Личный кабинет</span></a>
                <a class="header-wrapicon1 dis-block m-l-30" href="{{ route('register') }}"><span class="muted">Регистрация</span></a>
            @else
                <a href="{{ url('profile/' . Auth::user()->id) }}" class="header-wrapicon1 dis-block m-l-30" >
                    <span class="muted">{{Auth::user()->name}}</span>
                </a>
                <a  class="header-wrapicon1 dis-block m-l-30" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    <span class="muted">Выйти</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            @endif
           <!--  <a href="#" class="header-wrapicon1 dis-block">
                    <img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
                </a>
             -->
            <span class="linedivide1"></span>

            <div class="header-wrapicon2">
                @if(!Auth::guest())
                @if(Auth::user()->role == 'seller' || Auth::user()->role == 'candidate')
                <a href="{{ route('office') }}" class="header-icon1" title="настройки">
                    <img src="{{asset('images/icons/cog.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                </a>
                <?php $carts = null; ?>
                @else
                <img src="{{asset('images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                <?php
                    if(!Auth::guest()){
                        $carts = App\Cart::where('buyer_id', Auth::user()->id)->get(); 
                    } ?>
                
                <!-- Header cart noti -->
                @if($carts != null && count($carts) > 0)
                <span class="header-icons-noti">{{count($carts)}}</span>
                <div class="header-cart header-dropdown">
                    <ul class="header-cart-wrapitem">
                       <?php $total = 0; ?>
                        @foreach($carts as $cart)
                        <li class="header-cart-item">
                            <a href="{{route('deleteCart', $cart->id)}}">
                                <div class="header-cart-item-img">
                                    <?php $avatars = App\GoodPhoto::where('good_id', $cart->good_id)->get();
                                    if(count($avatars)>0){
                                        $avatar = $avatars->first()->filename;
                                    }else{
                                      $avatar='default';  
                                    } ?>
                                    @if($avatar == 'default')
                                    <img src="{{asset('images/item-cart-01.jpg')}}" alt="IMG">
                                    @else
                                    <img class="square_img" src="{{asset('resources/images') . '/' . $cart->good_id . '/' . $avatar}}" alt="фото товара">
                                    @endif
                                </div>
                            </a>

                            <div class="header-cart-item-txt">
                                <a href="{{url('good/' . $cart->good_id)}}" class="header-cart-item-name">
                                    {{App\Good::find($cart->good_id)->title}}
                                </a>

                                <span class="header-cart-item-info">
                                    {{$cart->price}} Тг.
                                    <?php $total = $total + $cart->price; ?>
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                    <div class="header-cart-total">
                        Итого: {{$total}} Тг.
                    </div>

                    <div class="header-cart-buttons">
                        <div class="header-cart-wrapbtn">
                            <a href="{{route('cart')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                Корзина
                            </a>
                        </div>

                        {{--<div class="header-cart-wrapbtn">--}}
                            {{--<a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">--}}
                                {{--Оплатить--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    </div>
                </div>
                @else
                <span class="header-icons-noti">0</span>
                @endif
                @endif
                @endif
            </div>
        </div>

        
    </div>

    <!-- Header -->
    <header class="header2">
        <!-- Header desktop -->
        <div class="container-menu-header-v2 p-t-26">
            <div class="topbar2">
                <div class="topbar-social">
                    <!-- <p class="muted">Региструйтесь с помощью</p>
                    <a href="#" class="topbar-social-item fa fa-facebook"></a>
                    <a href="#" class="topbar-social-item fa fa-instagram"></a>
                    <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                    <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a> -->
                    
                </div>

                <!-- Logo2 -->
                <a href="{{route('home')}}" class="logo2">
                    <img src="{{ asset('images/logo/logo.jpg') }}" alt="IMG-LOGO" style="max-height: 80px;">
                </a>


                <div class="topbar-child2">
                   <!--  <div class="topbar-language rs1-select2">
                        <select class="selection-1" name="time">
                            <option>USD</option>
                            <option>EUR</option>
                        </select>
                    </div> -->

                    <!--  -->
                    @if (Auth::guest())
                        <a class="header-wrapicon1 dis-block m-l-30" href="{{ route('login') }}"><span class="muted">Личный кабинет</span></a>
                        <a class="header-wrapicon1 dis-block m-l-30" href="{{ route('register') }}"><span class="muted">Регистрация</span></a>                 
                    @else       
                        <a href="{{ url('profile/' . Auth::user()->id) }}" class="header-wrapicon1 dis-block m-l-30" >
                            <span class="muted">{{Auth::user()->name}}</span>
                        </a>
                        <a  class="header-wrapicon1 dis-block m-l-30" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            <span class="muted">Выйти</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @endif
                    <span class="linedivide1"></span>
                    
                    <div class="header-wrapicon2 m-r-13">
                        @if(!Auth::guest())
                        @if( Auth::user()->role == 'seller' || Auth::user()->role == 'candidate')
                        <a href="{{ route('office') }}" class="header-icon1" title="настройки">
                            <img src="{{asset('images/icons/cog.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                        </a>
                        @else
                        <img src="{{asset('images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                        

                        <!-- Header cart noti -->
                        @if($carts != null && count($carts) > 0)
                        <span class="header-icons-noti">{{count($carts)}}</span>
                        <div class="header-cart header-dropdown">
                            <ul class="header-cart-wrapitem">
                                <?php $total = 0; ?>
                                @foreach($carts as $cart)
                                <li class="header-cart-item">
                                    <a href="{{route('deleteCart', $cart->id)}}">
                                    <div class="header-cart-item-img">
                                        <?php $avatars = App\GoodPhoto::where('good_id', $cart->good_id)->get();
                                        if(count($avatars)>0){
                                            $avatar = $avatars->first()->filename;
                                        }else{
                                          $avatar='default';  
                                        } ?>
                                        @if($avatar == 'default')
                                        <img src="{{asset('images/item-cart-01.jpg')}}" alt="IMG">
                                        @else
                                        <img class="square_img" src="{{asset('resources/images') . '/' . $cart->good_id . '/' . $avatar}}" alt="фото товара">
                                        @endif
                                    </div>
                                    </a>
                                    <div class="header-cart-item-txt">
                                        <a href="{{url('good/' . $cart->good_id)}}" class="header-cart-item-name">
                                            {{App\Good::find($cart->good_id)->title}}
                                        </a>

                                        <span class="header-cart-item-info">
                                            {{$cart->price}} Тг.
                                            <?php $total = $total + $cart->price; ?>
                                        </span>
                                        
                                    </div>
                                </li>
                                @endforeach
                            </ul>

                            <div class="header-cart-total">
                                Итого: {{$total}} Тг.
                            </div>

                            <div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <a href="{{route('cart')}}" class="flex-c-m size2 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Корзина
                                    </a>
                                </div>

                                {{--<div class="header-cart-wrapbtn">--}}
                                    {{--<a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">--}}
                                        {{--Оплатить--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                        @else
                        <span class="header-icons-noti">0</span>
                        @endif
                        @endif
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="wrap_header">
                <!-- Menu -->
                <div class="wrap_menu">
                    <nav class="menu">
                        <ul class="main_menu">
                            @yield('nav2')
                        </ul>
                    </nav>
                </div>
                
                <!-- Header Icon -->
                <div class="header-icons">

                </div>
            </div>

            <div class="row search-row">
            <div class="col-md-6 m-b-10 search-product pos-relative bo4 of-hidden" style="padding: 0px !important;">
                <form action="{{route('searchgood')}}" method="POST" stylr="border: 1px solid #e2dede;">
                    {{csrf_field()}}
                <input class="s-text7 size4 p-l-23 p-r-50 form-control" type="text" name="searchgood" placeholder="@if(empty($searchgood))Поиск товаров...@else{{$searchgood}}@endif">
                @if(!empty($currentCat))
                <input type="hidden" value="{{$currentCat->id}}" name="currentCat">
                @endif
                <button type="submit" class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4" style="width: 65px !important;">
                    <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                </button>
                </form>
            </div>
            </div>
        </div>

                <!-- Header Mobile -->
        <div class="wrap_header_mobile">
            <!-- Logo moblie -->
            <a href="{{route('home')}}" class="logo-mobile">
                <img src="{{ asset('images/logo/logo.jpg') }}" alt="IMG-LOGO" style="max-height: 65px;">
            </a>
            <!-- Button show menu -->
            <div class="btn-show-menu">
                <!-- Header Icon mobile -->
                <div class="header-icons-mobile">
                    <!-- 
                    <a href="#" class="header-wrapicon1 dis-block">
                        <img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
                    </a> -->
                    @if(!Auth::guest())
                    @if(Auth::user()->role == 'seller')
                    <a href="{{ url('profile/' . Auth::user()->id) }}" class="header-wrapicon1 dis-block" >
                        <span class="muted">Профиль</span>
                    </a>
                    @else
                    <span class="s-text7 header-wrapicon1 muted">{{Auth::user()->name}}</span>
                    @endif
                    <span class="linedivide1"></span>
                    @endif    
                    <div class="header-wrapicon2">
                        @if(!Auth::guest())
                        @if(Auth::user()->role == 'seller' || Auth::user()->role == 'candidate')
                        <a href="{{ route('office') }}" class="header-icon1" title="настройки">
                            <img src="{{asset('images/icons/cog.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                        </a>
                        @else
                        <img src="{{asset('images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    

                                <!-- Header cart noti -->
                        @if($carts != null && count($carts) > 0)
                        <span class="header-icons-noti">{{count($carts)}}</span>
                        <div class="header-cart header-dropdown">
                            <ul class="header-cart-wrapitem">
                                <?php $total = 0; ?>
                                @foreach($carts as $cart)
                                <li class="header-cart-item">
                                    <a href="{{route('deleteCart', $cart->id)}}">
                                        <div class="header-cart-item-img">
                                            <?php $avatars = App\GoodPhoto::where('good_id', $cart->good_id)->get();
                                            if(count($avatars)>0){
                                                $avatar = $avatars->first()->filename;
                                            }else{
                                              $avatar='default';  
                                            } ?>
                                            @if($avatar == 'default')
                                            <img src="{{asset('images/item-cart-01.jpg')}}" alt="IMG">
                                            @else
                                            <img class="square_img" src="{{asset('resources/images') . '/' . $cart->good_id . '/' . $avatar}}" alt="фото товара">
                                            @endif
                                        </div>
                                    </a>

                                    <div class="header-cart-item-txt">
                                        <a href="{{url('good/' . $cart->good_id)}}" class="header-cart-item-name">
                                            {{App\Good::find($cart->good_id)->title}}
                                        </a>

                                        <span class="header-cart-item-info">
                                            {{$cart->price}} Тг.
                                            <?php $total = $total + $cart->price; ?>
                                        </span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>

                            <div class="header-cart-total">
                                Итого: {{$total}} Тг.
                            </div>

                            <div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <a href="{{route('cart')}}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Корзина
                                    </a>
                                </div>

                                {{--<div class="header-cart-wrapbtn">--}}
                                    {{--<a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">--}}
                                        {{--Оплатить--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                        @else
                        <span class="header-icons-noti">0</span>
                        @endif
                        @endif
                        @endif
                    </div>
                </div>
                
                <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </div>
            </div>
             <div class="row" style="width: 100%;">
                <div class="col-md-4 col-md-offset-4 m-b-10 m-l-10 search-product pos-relative bo4 of-hidden" style="padding: 0px !important;">
                    <form action="{{route('searchgood')}}" method="POST" stylr="border: 1px solid #e2dede;">
                        {{csrf_field()}}
                    <input class="s-text7 size4 p-l-23 p-r-50 form-control" type="text" name="searchgood" placeholder="@if(empty($searchgood))Поиск товаров...@else{{$searchgood}}@endif">
                    @if(!empty($currentCat))
                    <input type="hidden" value="{{$currentCat->id}}" name="currentCat">
                    @endif
                    <button type="submit" class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4" style="width: 65px !important;">
                        <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                    </button>
                    </form>
                </div>
            </div>
        </div>
            <!-- Menu Mobile -->
            <div class="wrap-side-menu" style="margin-top: 80px;">
                <nav class="side-menu">
                    <ul class="main-menu">
                        <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                            <span class="topbar-child1">
                                @if (Auth::guest())
                                    <a class="header-wrapicon1 dis-block" href="{{ route('login') }}"><span class="muted">Личный кабинет</span></a>
                                    <a class="header-wrapicon1 dis-block" href="{{ route('register') }}"><span class="muted">Регистрация</span></a><li class="item-topbar-mobile p-l-10">
                                    <div class="topbar-social-mobile">
                                        <a href="#" class="topbar-social-item fa fa-facebook"></a>
                                        <a href="#" class="topbar-social-item fa fa-instagram"></a>
                                        <a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
                                        <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
                                    </div>
                                </li>
                                @else
                                <a  class="header-wrapicon1 dis-block" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <span class="muted">Выйти</span>
                                </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                @endif
                            </span>
                        </li>
    <!-- 
                        <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                            <div class="topbar-child2-mobile">
                                <span class="topbar-email">
                                    fashe@example.com
                                </span>

                                <div class="topbar-language rs1-select2">
                                    <select class="selection-1" name="time">
                                        <option>USD</option>
                                        <option>EUR</option>
                                    </select>
                                </div>
                            </div>
                        </li> -->
                        @yield('mobileNav')
                    </ul>
                </nav>
            </div>
    </header>
        
    @yield('content')
    <footer class="bg6 p-t-20 p-b-15 p-l-45 p-r-20">
        <div class="t-center p-l-15 p-r-15">
            <div class="t-center s-text8">
                Copyright © 2018
            </div>
        </div>
    </footer>



    <!-- Back to top -->
    <div class="btn-back-to-top bg0-hov" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="fa fa-angle-double-up" aria-hidden="true"></i>
        </span>
    </div>

    <!-- Container Selection1 -->
    <div id="dropDownSelect1"></div>
    <!--===============================================================================================-->
    <!-- <script src="{{ asset('jquery/jquery-3.2.1.min.js') }}"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<!--===============================================================================================-->
    <script src="{{ asset('bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
    
<!--===============================================================================================-->
    <script src="{{ asset('select2/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(".selection-1").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect1')
        });
    </script>
<!--===============================================================================================-->
    <script src="{{ asset('slick/slick.min.js') }}"></script>
    <script src="{{ asset('js/slick-custom.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('lightbox2/js/lightbox.min.js') }}"></script>
<!--===============================================================================================-->
    <!-- alert on good click effect -->
    <script src="{{ asset('sweetalert/sweetalert.min.js') }}"></script>
    @yield('script')
    <script>
        $('.block2-btn-addcartBtn').each(function(){
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "добавлен в корзину !", "success");
            });
        });

        $('.block2-btn-addwishlist').each(function(){
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "добавлен в избранное !", "success");
            });
        });
    </script>
 
<!--===============================================================================================-->
    <script src="{{ asset('parallax100/parallax100.js') }}"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
<!--===============================================================================================-->
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        function addToCart(good_id){
            $.ajax({
                type: "GET",
                // local
                url: "http://belook.local/addToCart/" + good_id,
                // prod
                // url: "https://belook.kz/addToCart/" + good_id,
            });
        }
    </script>
    <script>
        function deleteCart(cart_id){
            alert("delete cart");
            $.ajax({
                type: "GET",
                //local
                url: "http://belook.local/deleteCart/" + cart_id,
                // prod
                // url: "https://belook.kz/deleteCart/" + cart_id,
            });   
        }
    </script>    
</body>
</html>