@extends('layouts.shopLayout')
@section('head')
<link rel="stylesheet" href="{{asset('developerTemplate/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('developerTemplate/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('developerTemplate/css/style.css')}}">
<link href='https://fonts.googleapis.com/css?family=PT+Serif:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
<style>
	.banner{
		<?php 
		if($user->wallpaper != NULL){
			echo 'background: url("' . asset('/resources/wallpapers/' . $user->id . '/' . $user->wallpaper) . '");';
		}else{
			echo 'background: url("' . asset("/images/master-slide-07.jpg") . '");';
		}?>
		background-repeat: no-repeat;
		background-position: center;
		-webkit-background-size: cover;
		background-size: cover;
		height: 500px;
		position: relative;
		z-index: 111;
	}

	.no-background{
		background: none !important;
		color: #fff !important;
	}

	.activeall{
		background: #2c3e50;
		border-color: #2c3e50;
		color: #fff !important;
	}
</style>
@endsection

@section('nav')
<li>
    <a href="{{route('shop')}}">Поиск</a>
</li>

<li>
    <a href="{{route('home')}}">Новинки</a>
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
    <a href="{{route('home')}}">Новинки</a>
</li>

<li>
    <a href="about.html">О нас</a>
</li>

<li>
    <a href="contact.html">Контакты</a>
</li>
@endsection


@section('content')

	<div class="banner" id="home"></div>
	<header class="header">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1 no-padding">
					<div class="col-sm-12 text-center user" <?php if ($profile!= NULL) {
							echo 'style="margin-bottom: -45px"';
						}else{
							echo 'style="margin-bottom: 0px"';
						} ?> >
						@if($user->avatar != NULL)
						<img src="{{asset('resources/avatars/' . $user->id . '/' . $user->avatar)}}" alt="Me" class="img-circle">
						@else
						<img src="{{asset('images/item-02.jpg')}}" alt="Me" class="img-circle">
						@endif
						<h1>{{$user->name}}</h1>
					    @if($profile != NULL)
						<h4>{{$profile->address}}</h4>
						<div class="social-icons">
							@if($profile->facebook != NULL)
							<a href="{{$profile->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a>
							@endif
							@if($profile->instagram != NULL)
							<a href="{{$profile->instagram}}" target="_blank"><i class="fa fa-instagram"></i></a>
							@endif
							@if($profile->vk != NULL)
							<a href="{{$profile->vk}}" target="_blank"><i class="fa fa-vk"></i></a>
							@endif
							@if($profile->google != NULL)
							<a href="{{$profile->google}}" target="_blank"><i class="fa fa-google-plus"></i></a>
							@endif
						</div>
						@else
						<h4>Продавец пока не настроил свой профиль.</h4>
						@endif
					</div>
					@if($user->rating != 0)
					    <img src="{{asset('/resources/images/star' . $user->rating . '.png')}}" alt="" style="width: 18%; height: auto; display: block; margin: 0 auto;">
                    @endif
					<!-- nav starts here -->
					<div class="col-md-12">	
						<div class="main-nav">
							<nav class="navbar navbar-default">
							  <div class="container-fluid">
							   	<div class="navbar-header">
							      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							        <span class="sr-only">Toggle navigation</span>
							        <span class="icon-bar"></span>
							        <span class="icon-bar"></span>
							        <span class="icon-bar"></span>
							      </button>
							    </div>

							    <div class="collapse navbar-collapse text-center" id="bs-example-navbar-collapse-1">
							       <ul class="nav navbar-nav">
				                        <li class="filter" data-filter=".all">
				                            <a href="#" class="no-background active">Магазин</a>
				                        </li>
				                        <li class="filter" data-filter=".about">
				                            <a href="#" class="no-background">О себе</a>
				                        </li>
				                        <li class="filter" data-filter=".top-rate">
				                            <a href="#" class="no-background">Отзывы</a>
				                        </li>
				                        <li class="filter" data-filter=".top-rate">
				                            <a href="#" class="no-background">Контакты</a>
				                        </li>
				                    </ul>
							    </div> 
							  </div>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	
	<section class="works text-center p-t-45 p-b-58">
		<div class="container">
		        <!--  -->
			<div class="row mix all <?php foreach ($categories as $category): echo $category->id . ' '; endforeach ?>">
					<h2>Магазин</h2>
					@if(count($goods) > 0)
					<div class="col-md-12">
						<ul class="list-inline">
							<li class="filter active activeall" data-filter=".all">Все</li>
							@foreach($categories as $category)
							<li class="filter" data-filter=".{{$category->id}}">{{$category->title}}</li>
							@endforeach
						</ul>
					</div>
					<!-- single portfolio item -->
					@foreach($goods as $good)
					<div class="col-sm-6 col-md-4 col-lg-3 p-b-50 mix website-customization all {{$good->category}}">
			            <div class="block2">
			                <div class="square bg-light block2-img wrap-pic-w of-hidden pos-relative">
				        		<?php $avatars = App\GoodPhoto::where('good_id', $good->id)->get();
			                        if(count($avatars)>0){
			                            $avatar = $avatars->first()->filename;
			                        }else{
			                          $avatar='default';  
			                        } ?>
			                        @if($avatar == 'default')
			                        <img class="square_img" src="{{asset('images/item-02.jpg')}}" alt="IMG-PRODUCT">
			                        @else
			                        <img class="square_img" src="{{asset('resources/images') . '/' . $good->id . '/' . $avatar}}" alt="фото товара">
			                        @endif
					            <div class="block2-overlay trans-0-4">
		                            <br>
		                            <h3 style="color: white;">{{$good->title}}</h3>
		                            
		                            <div class="block2-btn-addcart w-size1 trans-0-4">
		                                <a href="" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
		                                    в корзину
		                                </a>
		                                <br>
		                                <a href="{{url('good/' . $good->id)}}" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
		                                   купить сейчас
		                                </a>
		                            </div>

		                        </div>
							</div>
						</div>

						<div class="block2-txt bg-light">
							<br>
		                    <a href="{{url('good/' . $good->id)}}" class="block2-name dis-block s-text18 p-b-5"  style="padding: 3px 0px 0px 15px">
		                        {{ $good->title }}
		                    </a>
		                    @if($good->oldprice != NULL)
		                    <span class="block2-price m-text7 p-r-5" style="padding: 3px 0px 4px 15px">
		                        {{$good->oldprice}} Тг.
		                    </span>
		                    @endif
		                    <span class="block2-newprice m-text8 p-r-5" style="padding: 3px 0px 4px 15px">
		                        {{$good->price}} Тг.
		                    </span><br><br>
		                </div>
					</div>
					@endforeach
					@else
					<p class="muted">Продавец еще не добавил ни одного товара в свой магазин.</p>
					@endif
			</div>
			<div class="mix about" id="about" data-myorder="5">
				<div class="row">
					<div class="col-md-12">
						<h2>О себе</h2>
					</div>
					
					<div class="col-md-12">
						<h2>О себе</h2>
					</div>
					
					<div class="col-md-12">
						<h2>О себе</h2>
					</div>
					
					<div class="col-md-12">
						<h2>О себе</h2>
					</div>
					
					<div class="col-md-12">
						<h2>О себе</h2>
					</div>
					
					<div class="col-md-12">
						<h2>О себе</h2>
					</div>
					
					<div class="col-md-12">
						<h2>О себе</h2>
					</div>
				</div>
					
			</div>
		</div>
		
	</section><!-- end of portfolios -->
@endsection

@section('script')
<script src="{{asset('developerTemplate/js/jquery.mixitup.js')}}"></script>
<script src="{{asset('developerTemplate/js/custom.js')}}"></script>
@endsection