@extends('layouts.shopLayout')
@section('head')
<link href="http://cdn-na.infragistics.com/igniteui/2017.2/latest/css/themes/infragistics/infragistics.theme.css" rel="stylesheet" />
<link href="http://cdn-na.infragistics.com/igniteui/2017.2/latest/css/structure/infragistics.css" rel="stylesheet" />

    <!-- Owl Stylesheets -->
<link rel="stylesheet" href="{{asset('carousel/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('carousel/owl.theme.default.min.css')}}">

<style>
 @media (max-width: 992px){
    .cat-title {
        font-size: 11px;    
    }
}
</style>
<!-- javascript -->
<script src="{{asset('carousel/jquery.min.js')}}"></script>
<script src="{{asset('carousel/owl.carousel.js')}}"></script>

@endsection
@section('nav')
<li>
    <a href="{{route('shop')}}">Поиск</a>
</li>

<li class="sale-noti">
    <a href="{{route('home')}}">Главная</a>
</li>

<li>
    <a href="about.html">О нас</a>
</li>

<li>
    <a href="contact.html">Контакты</a>
</li>
@endsection

@section('nav2')
<li>
    <a href="{{route('shop')}}">Поиск</a>
</li>

<li class="sale-noti">
    <a href="{{route('home')}}">Главная</a>
</li>

<li>
    <a href="about.html">О нас</a>
</li>

<li>
    <a href="contact.html">Контакты</a>
</li>
@endsection

@section('content')
<div class="container" >
    <div class="sec-title mob-m-t m-b-10">
        <h3 class="m-text15 t-center" style="font-size: 40px !important;">
            Категории
        </h3>
    </div>
   
    <div class="large-12 columns" style="margin-right: -30px">
      <div class="owl-carousel">
        @foreach($categories as $category)
        @if($category->data_level == 0)
        <div>
            <a href="{{url('category/' . $category->id)}}"><img src="{{asset('images/icons/' . $category->code . '.png')}}" alt=""></a>
            <h3 class="text-center m-t-5 p-b-5"><a class="m-text15 cat-title" href="{{url('category/' . $category->id)}}">{{$category->title}}</a></h4>
        </div> 
        @endif
        @endforeach
      </div>
    </div>   
    <script>
      var owl = $('.owl-carousel');
      owl.owlCarousel({
        margin: 10,
        loop: true,
        autoplay:true,
        autoplayTimeout:2000,
        autoplayHoverPause:true,
        autoplaySpeed: 1500,
        responsive: {
          0: {
            items: 4.5
          },
          600: {
            items: 5.5
          },
          1000: {
            items: 6.5
          }
        }
      })
    </script>
    <div class="sec-title p-b-25 m-t-30">
        <h3 class="m-text15 t-center" style="font-size: 40px !important;">
            Распродажа
        </h3>
    </div>
    <div class="row" style="margin-right: -35px">
        <div class="col-sm-12 col-sm-offset owl-carousel">
            @if(count($sales) > 0)
            @foreach($sales as $sale)
                <!-- Block2 -->
                <div class="block2">
                    <div class="block2-img square pos-relative wrap-pic-w of-hidden">
                        <span class = "mylabel">-{{ $sale->sale }}%</span>
                        <?php $avatars = App\GoodPhoto::where('good_id', $sale->id)->get();
                        if(count($avatars)>0){
                            $avatar = $avatars->first()->filename;
                        }else{
                          $avatar='default';  
                        } ?>
                        @if($avatar == 'default')
                        <img class="square_img" src="images/item-02.jpg" alt="IMG-PRODUCT">
                        @else
                        <img class="square_img" src="{{asset('resources/images') . '/' . $sale->id . '/' . $avatar}}" alt="фото товара">
                        @endif
                        <div class="block2-overlay trans-0-4">
                            @if(!Auth::guest() && Auth::user()->token == null)
                            <div class="block2-btn-addcart block2-btn-addcartBtn w-size1 trans-0-4 text-center m-b-20">
                                <!-- Button -->
                                <a onclick="addToCart({{$sale->id}})" href="#" class="btn btn-lg bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                    в корзину
                                </a>
                                <br><br>
                            </div>
                                @endif
                            <div class="block2-btn-addcart w-size1 trans-0-4 text-center">
                                <a href="{{url('good/' . $sale->id)}}" class="btn btn-lg bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                   купить
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="block2-txt p-t-20 text-center">
                        <a href="{{url('good/' . $sale->id)}}" class="block2-name dis-block s-text3 p-b-5">
                            {{$sale->title}}
                        </a>
                        
                        <span class="block2-price m-text7 p-r-5">
                            {{$sale->oldprice}} Тг.
                        </span>

                        <span class="block2-newprice m-text8 p-r-5">
                            {{$sale->price}} Тг.
                        </span>
                    </div>
                </div>
            @endforeach
            @else
                <div class="col-xs-12 text-center">
                    <p class="m-text17">Нет товаров со скидкой.</p>
                </div>
            @endif
        </div>
    </div>
    <script>
      var owl = $('.owl-carousel');
      owl.owlCarousel({
        margin: 10,
        loop: true,
        autoplay:true,
        autoplayTimeout: 2000,
        autoplayHoverPause:true,
        autoplaySpeed: 1500,
        responsive: {
          0: {
            items: 2.5
          },
          600: {
            items: 3.5
          },
          1000: {
            items: 6.5
          }
        }
      })
    </script>
        <!-- end sale -->

    <!-- news carousel -->

    <div class="sec-title p-b-25 m-t-30">
        <h3 class="m-text15 t-center" style="font-size: 40px !important;">
            Новинки
        </h3>
    </div>
    <div class="row" style="margin-right: -35px">
        <div class="owl-carousel">
        @foreach($news as $new)
            @if(count($news) > 0)
            <div class="block2">
                <div class="block2-labelnew square block2-img wrap-pic-w of-hidden pos-relative">
                    <?php $avatars = App\GoodPhoto::where('good_id', $new->id)->get();
                    if(count($avatars)>0){
                        $avatar = $avatars->first()->filename;
                    }else{
                      $avatar='default';  
                    } ?>
                    @if($avatar == 'default')
                    <img class="square_img" src="images/item-02.jpg" alt="IMG-PRODUCT">
                    @else
                    <img class="square_img" src="{{asset('resources/images') . '/' . $new->id . '/' . $avatar}}" alt="фото товара">
                    @endif
                    <div class="block2-overlay trans-0-4">
                        @if(!Auth::guest() && Auth::user()->token == null)
                        <div class="block2-btn-addcart block2-btn-addcartBtn w-size1 trans-0-4 text-center m-b-20">
                            <!-- Button -->
                            <a onclick="addToCart({{$new->id}})" href="#" class="btn btn-lg bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                в корзину
                            </a>
                            <br><br>
                        </div>
                        @endif
                        <div class="block2-btn-addcart w-size1 trans-0-4 text-center">
                            <a href="{{url('good/' . $new->id)}}" class="btn btn-lg bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                               купить
                            </a>
                        </div>
                    </div>
                </div>

                <div class="block2-txt bg-light">
                    <a href="{{url('good/' . $new->id)}}" class="block2-name dis-block s-text3 p-b-5"  style="padding: 3px 0px 0px 15px">
                        {{ $new->title }}
                    </a>
                    @if($new->oldprice != NULL)
                    <span class="block2-price m-text7 p-r-5" style="padding: 3px 0px 4px 15px">
                        {{$new->oldprice}} Тг.
                    </span>
                    @endif
                    <span class="block2-newprice m-text8 p-r-5" style="padding: 3px 0px 4px 15px">
                        {{$new->price}} Тг.
                    </span><br><br>
                </div>
            </div>
            @else
            <h3 class="muted text-center">Нет новинок</h3>
            @endif
        @endforeach
        </div>
    </div>
    <script>
      var owl = $('.owl-carousel');
      owl.owlCarousel({
        margin: 10,
        loop: true,
        autoplay:true,
        autoplayTimeout: 2000,
        autoplayHoverPause:true,
        autoplaySpeed: 1500,
        responsive: {
          0: {
            items: 2.5
          },
          600: {
            items: 3.5
          },
          1000: {
            items: 6.5
          }
        }
      })
    </script>
    
    <!-- end news carousel -->

    <!-- best goods carousel -->
    
    <div class="sec-title p-b-25 m-t-30">
        <h3 class="m-text15 t-center" style="font-size: 30px !important;">
            Лучшие товары
        </h3>
    </div>
    <div class="row" style="margin-right: -35px">
        <div class="owl-carousel">
        @foreach($bGoods as $bGood)
        <div class="block2">
            <div class="block2-img wrap-pic-w of-hidden pos-relative">
                @if($bGood->sale != 0)
                <span class = "mylabel">-{{ $bGood->sale }}%</span>
                @endif
                <?php $avatars = App\GoodPhoto::where('good_id', $bGood->id)->get();
                if(count($avatars)>0){
                    $avatar = $avatars->first()->filename;
                }else{
                  $avatar='default';  
                } ?>
                @if($avatar == 'default')
                <img class="square_img" src="images/item-02.jpg" alt="IMG-PRODUCT">
                @else
                <img class="square_img" src="{{asset('resources/images') . '/' . $bGood->id . '/' . $avatar}}" alt="фото товара">
                @endif
                <div class="block2-overlay trans-0-4">
                    @if(!Auth::guest() && Auth::user()->token == null)
                    <div class="block2-btn-addcart block2-btn-addcartBtn w-size1 trans-0-4 text-center m-b-20">
                        <!-- Button -->
                        <a onclick="addToCart({{$sale->id}})" href="#" class="btn btn-lg bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                            в корзину
                        </a>
                        <br><br>
                    </div>
                        @endif
                    <div class="block2-btn-addcart w-size1 trans-0-4 text-center">
                        <a href="{{url('good/' . $sale->id)}}" class="btn btn-lg bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                           купить
                        </a>
                    </div>
                </div>
            </div>

            <div class="block2-txt p-t-20 text-center">
                <img src="{{asset('/resources/images/star' . $bGood->rating . '.jpg')}}" alt="" style="width: 70%; height: auto;">
                <a href="{{url('good/' . $bGood->id)}}" class="block2-name dis-block s-text3 p-b-5">
                    {{$bGood->title}}
                </a>
                @if($bGood->oldprice != NULL)
                <span class="block2-price m-text7 p-r-5">
                    {{$bGood->oldprice}} Тг.
                </span>
                @endif
                <span class="block2-newprice m-text8 p-r-5">
                    {{$bGood->price}} Тг.
                </span>
            </div>
        </div>
        @endforeach
        </div>  
    </div>
    <script>
      var owl = $('.owl-carousel');
      owl.owlCarousel({
        margin: 10,
        loop: true,
        autoplay:true,
        autoplayTimeout: 2000,
        autoplayHoverPause:true,
        autoplaySpeed: 1500,
        responsive: {
          0: {
            items: 2.5
          },
          600: {
            items: 3.5
          },
          1000: {
            items: 6.5
          }
        }
      })
    </script>

    <!-- end best goods carousel -->

    <!-- best sellers carousel -->
    
    <div class="sec-title p-b-25 m-t-30">
        <h6 class="m-text15 t-center" style="font-size: 28px !important;">
            Лучшие продавцы
        </h6>
    </div>
    <div class="row" style="margin-right: -35px">
        <div class="owl-carousel">
        @foreach($sellers as $seller)
        <div class="block2">
            <div class="square block2-img wrap-pic-w of-hidden pos-relative">
                @if($seller->avatar != NULL)
                <img class="square_img" src="{{asset('resources/avatars/' . $seller->id . '/' . $seller->avatar)}}" alt="аватар продавца">
                @else
                <img class="square_img" src="images/item-02.jpg" alt="аватар">
                @endif
                <div class="block2-overlay trans-0-4">
                    <div class="block2-btn-addcart w-size1 trans-0-4 text-center">
                        <a href="{{url('profile/' . $seller->id)}}" class="btn btn-lg bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                           В профиль
                        </a>
                    </div>
                </div>
            </div>
            <div class="block2-txt bg-light text-center">
                <a href="{{url('profile/' . $seller->id)}}" class="block2-name dis-block s-text3 p-t-8 p-b-5">
                    {{ $seller->name }}
                </a>
            </div>
        </div>
        @endforeach
        </div>
    </div>
    <script>
      var owl = $('.owl-carousel');
      owl.owlCarousel({
        margin: 10,
        loop: true,
        autoplay:true,
        autoplayTimeout: 2000,
        autoplayHoverPause:true,
        autoplaySpeed: 1500,
        responsive: {
          0: {
            items: 2.5
          },
          600: {
            items: 3.5
          },
          1000: {
            items: 6.5
          }
        }
      })
    </script>

    <!-- end best sellers carousel -->


</div>
@endsection