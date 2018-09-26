@extends('layouts.shopLayout')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('dropzone/basic.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.3/css/star-rating.css">
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
@endsection

@section('nav')
<li>
    <a href="{{route('shop')}}">Поиск</a>
</li>

<li>
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

<li>
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
    <div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
        @foreach($categories as $category)
        <a href="{{url('category' . '/' . App\Category::where('code', $category)->first()->id)}}" class="s-text16">
            {{ App\Category::where('code', $category)->first()->title }}
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>
        @endforeach
    </div>
    <!-- Product Detail -->
    <div class="container p-t-35 p-b-80">
        <div class="flex-w flex-sb">
            <div class="w-size13 p-t-30 respon5">
                <div class="wrap-slick3 flex-sb flex-w">
                    <div class="wrap-slick3-dots"></div>

                    <div class="slick3">
                       <?php
                        $date = Carbon\Carbon::now();
                        $date->subWeek();
                         ?>
                        @if(count($photos)>0)
                        @foreach($photos as $photo)
                        <div class="item-slick3" data-thumb="{{asset('/resources/images') . '/' . $good->id . '/' . $photo->filename}}">
                            <div <?php
                             if (date('Y-m-d H:i:s', strtotime($good->created_at)) > $date->toDateTimeString()) {
                                echo ' class="wrap-pic-w square block2-labelnew"';
                            }else{
                                echo ' class="wrap-pic-w square"';
                            } ?>>
                                <img src="{{asset('/resources/images') . '/' . $good->id . '/' . $photo->filename}}" alt="фото-товара">
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="item-slick3" data-thumb="{{asset('/resources/images/product-detail-01.jpg')}}">
                            <div <?php 
                             if (date('Y-m-d H:i:s', strtotime($good->created_at)) > $date) {
                                echo ' class="wrap-pic-w square block2-labelnew"';
                            }else{
                                echo ' class="wrap-pic-w square"';
                            } ?>>
                                <img src="{{asset('/resources/images/product-detail-01.jpg')}}" alt="добавьте фото">
                            </div>
                        </div>

                        <div class="item-slick3" data-thumb="{{asset('/resources/images/product-detail-02.jpg')}}">
                            <div <?php 
                            if (date('Y-m-d H:i:s', strtotime($good->created_at)) > $date) {
                                echo ' class="wrap-pic-w square block2-labelnew"';
                            }else{
                                echo ' class="wrap-pic-w square"';
                            } ?>>
                                <img src="{{asset('/resources/images/product-detail-02.jpg')}}" alt="добавьте фото">
                            </div>
                        </div>

                        <div data-thumb="{{asset('/resources/images/product-detail-03.jpg')}}">
                            <div <?php  
                            if (date('Y-m-d H:i:s', strtotime($good->created_at)) > $date) {
                                echo ' class="wrap-pic-w square block2-labelnew"';
                            }else{
                                echo ' class="wrap-pic-w square"';
                            } ?> >
                                <img src="{{asset('/resources/images/product-detail-03.jpg')}}" alt="добавьте фото">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="w-size14 p-t-30 respon5">
                <h5 class="product-detail-name m-text12 p-b-13">
                    Продавец: <a class="m-text12" href="{{url('profile/' . $good->seller_id)}}">{{App\User::find($good->seller_id)->name}}</a>
                </h5>
                
                <h4 class="product-detail-name m-text16 p-b-13">
                    {{$good->title}}
                </h4>
                @if($good->oldprice != NULL)
                <span class="m-text17">
                    <del>{{$good->oldprice}} Тг.</del>
                </span>
                @endif
                <span class="m-text17" style="color: #e65540">
                    {{$good->price}} Тг.
                </span>
                
                <hr>
                <div class="p-b-45">
                    <span class="s-text8"><b>Категория: </b>
                {{ App\Category::find($good->category)->title }}</span>
                </div>
                
                
                <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Описание
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                            <span class="muted s-text8 p-t-10">{{$good->description}} </span>
                        </p>
                    </div>
                </div>

                <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Дополнительная информация
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                            Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
                        </p>
                    </div>
                </div>

                <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Отзывы ({{count($reviews)}})
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>
                        
                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        @if(count($reviews) > 0)
                            <h6 class="m-text21">Рейтинг товара:  <span class="m-text22">{{$good->rating}} / 5</span></h6>
                            <div class="col-xs-6" style="padding-left:  0px; padding-bottom: 20px">
                                <img src="{{asset('/resources/images/star' . $good->rating . '.jpg')}}" alt="" style="width: 100%; height: auto;">
                            </div>
                            <br>
                            <br>
                            <br>
                        @foreach($reviews as $review)
                        <div>
                        <div class="col-xs-12">
                            <div class="col-xs-4">
                                <img src="{{asset('/resources/images/star' . $review->points . '.jpg')}}" alt="" style="width: 100%; height: auto;">
                            </div>
                        </div><br>
                        <p class="s-text8">
                            {{ $review->text }}
                        </p>
                        <p class="s-text10">{{ $review->created_at }}</p>
                        </div><hr>
                        @endforeach
                        @else
                        <p class="s-text8">
                            Нет отзывов                            
                        </p>
                        @endif
                        
                        @if(Auth::guest())
                        <br>
                        <br>
                        <h6 class="m-text19">Оставьте отзыв</h6>
                        <form action="{{route('rate')}}" method="POST">
                            {{csrf_field()}}
                            <br><div class="rating" id="rate1" required></div><br><br>
                            <textarea class="s-text17" name="reviewText" style="width:90%" rows="4"></textarea>
                            <input type="submit" class="btn btn-lg btn-primary text-uppercase">
                            <input type="hidden" name="good_id" value="{{$good->id}}">
                            <input type="hidden" name="seller_id" value="{{$good->seller_id}}">
                            <input type="hidden" name="points" id="points">
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('dropzone/dropzone-config.js') }}"></script>
    <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
    <script type="text/javascript">
    initializeRatings();

    function initializeRatings() {
        $('#rate1').shieldRating({
            max: 5,
            step: 0.5,
            value: 0,
            markPreset: false
        });
    }

    $("#rate1").on('click touchend', function(){
        document.getElementById("points").value = $('#rate1').swidget().value();
    });

</script>
@endsection