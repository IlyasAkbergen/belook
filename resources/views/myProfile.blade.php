@extends('layouts.shopLayout')
@section('head')
<link rel="stylesheet" href="{{asset('developerTemplate/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('developerTemplate/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('developerTemplate/css/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap-editable/bootstrap-editable.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('modal/modal.css') }}">
<link href='https://fonts.googleapis.com/css?family=PT+Serif:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
<link href="http://cdn-na.infragistics.com/igniteui/2017.2/latest/css/themes/infragistics/infragistics.theme.css" rel="stylesheet" />
<link href="http://cdn-na.infragistics.com/igniteui/2017.2/latest/css/structure/infragistics.css" rel="stylesheet" />
<style>
	@media (max-width: 992px){
		.banner{
			margin-top: 60px;
		}
	}
	.banner{
		<?php 
		if($user->wallpaper != NULL){
			echo 'background: url("' . asset('resources/wallpapers/' . $user->id . '/' . $user->wallpaper) . '");';
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
	.ch-grid {
		margin: 20px 0 0 0;
		padding: 0;
		list-style: none;
		display: block;
		text-align: center;
		width: 100%;
	}

	.ch-grid:after,
	.ch-item:before {
		content: '';
	    display: table;
	}

	.ch-grid:after {
		clear: both;
	}

	.ch-grid li {
		width: 220px;
		height: 220px;
		display: inline-block;
		margin: 20px;
	}
	.ch-item {
		width: 100%;
		height: 100%;
		border-radius: 50%;
		overflow: hidden;
		position: relative;
		cursor: default;
		box-shadow: 
			inset 0 0 0 16px rgba(255,255,255,0.6),
			0 1px 2px rgba(0,0,0,0.1);
		transition: all 0.4s ease-in-out;
	}
	.ch-info {
		position: absolute;
		background: rgba(63,147,147, 0.8);
		width: inherit;
		height: inherit;
		border-radius: 50%;
		overflow: hidden;
		opacity: 0;
		transition: all 0.4s ease-in-out;
		transform: scale(0);
	}

	.ch-info h3 {
		color: #fff;
		text-transform: uppercase;
		letter-spacing: 2px;
		font-size: 22px;
		margin: 0 30px;
		padding: 45px 0 0 0;
		height: 140px;
		font-family: 'Open Sans', Arial, sans-serif;
		text-shadow: 
			0 0 1px #fff, 
			0 1px 2px rgba(0,0,0,0.3);
	}

	.ch-info a {
		display: block;
		color: #fff;
		padding: 45px 0 0 0;
		text-transform: uppercase;
		letter-spacing: 2px;
		font-size: 22px;
		font-family: 'Open Sans', Arial, sans-serif;
	}

	.ch-info a:hover {
		color: rgba(255,242,34, 0.8);
	}

	.ch-item:hover {
		box-shadow: 
			inset 0 0 0 1px rgba(255,255,255,0.1),
			0 1px 2px rgba(0,0,0,0.1);
	}

	.ch-item:hover .ch-info {
		transform: scale(1);
		opacity: 1;
	}

	.ch-item:hover .ch-info p {
		opacity: 1;
	}
	.ch-img { 
		<?php if($user->avatar != NULL){
			echo 'background-image: url("' . asset('resources/avatars/' . $user->id . '/' . $user->avatar) . '");';
		}else{
			echo 'background-image: url("' . asset('images/item-02.jpg') . '");';
		}
		?>
		background-repeat: no-repeat;
		background-position: center;
		-webkit-background-size: cover;
		background-size: cover;
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
@section('searchVisibility')
	{{'visibility: hidden;'}}
@endsection
@section('content')
	<div id="_token" class="hidden" data-token="{{ csrf_token() }}"></div>
	<div class="banner" id="home"></div>
	<header class="header">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1 no-padding">
					<div class="col-sm-12 text-center user" <?php if ($profile!= NULL) {
							echo 'style="margin-bottom: -65px"';
						}else{
							echo 'style="margin-bottom: 10px"';
						} ?> >
						<ul class="ch-grid">
							<li>
							<div class="ch-item ch-img">
								<div class="ch-info">
									<a class="trigger" href="#">Обновить фотографии профиля</a>
								</div>
							</div>
							</li>
						</ul>
						<h1>
							<a href="#" class="name m-text17" style="color: white !important;" data-type="text" data-column="name" data-url="{{route('editName')}}" data-pk="{{$user->id}}" data-title="name" data-name="name">
								{{$user->name}}<i class="glyphicon glyphicon-pencil"></i>
							</a>
						</h1>

						@if($profile != NULL)
						<a href="#" class="address m-text11" style="color: white !important;" data-type="text" data-column="name" data-url="{{route('editAddress')}}" data-pk="{{$user->id}}" data-title="address" data-name="address">
							{{$profile->address}}<i class="glyphicon glyphicon-pencil"></i>
						</a>

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
							<!-- modal upload avatar -->
						</div>
						@else
						<h4>Вы пока не настроили свой профиль.</h4>
						@endif
					</div>
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
				                        <li class="filter active" data-filter=".all">
				                            <a href="#" class="no-background active">Магазин</a>
				                        </li>
				                        <li class="filter" data-filter=".about">
				                            <a href="#" class="no-background">О себе</a>
				                        </li>
				                        <li class="filter" data-filter=".reviews">
				                            <a href="#" class="no-background">Отзывы</a>
				                        </li>
				                        <li class="filter" data-filter=".contacts">
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
		<div class="modal-wrapper">
		  <div class="myModal">
		    <div class="head">
		    	<h4 class="col-xs-10">Загрузка фотографий профиля</h4>
		      	<div class="col-xs-2">
			      	<a class="btn-close trigger" href="#">
				        <i class="fa fa-times" aria-hidden="true"></i>
			        </a>
		    	</div>
		    </div>
		    <div class="content">
		        <div class="good-job">
		          <form action="{{route('uploadAva')}}" method="POST" enctype="multipart/form-data">
		          	{{csrf_field()}}
		          	<label style="color: #e65540;" for="ava">Аватар профиля</label>
		          	<input class="form-control" name="ava" type="file" id="ava">
					<label style="color: #e65540;" for="wallpaper">Обложка профиля</label>
					<input class="form-control" type="file" name="wallpaper" id="wallpaper"> 
					<input type="hidden" name="seller_id" value="{{$user->id}}">
					<button class="btn btn-tomato" type="submit" alt="Загрузить фото">Загрузить</button>
		          </form>
		        </div>
		    </div>
		  </div>
		</div>
	</header>
	
	<section class="works text-center p-t-45 p-b-58">
		<div class="container">
			<div class="row mix all <?php foreach ($categories as $category): echo $category->id . ' '; endforeach ?>">
				<h2 class="m-t-0 m-b-25">Ваш магазин</h2>
				<a class="btn btn-success btn-md" href="{{route('addGoodForm')}}"><i class="fa fa-plus"></i>&nbsp &nbspДобавить товар в магазин</a>
				
				<br><br>
				
				
				<div class="btn btn-md btn-excel" style="border: 1px solid lightgrey; padding: 12px !important;  position: relative;"><?php echo Form::open(array('url' => 'uploadGoods','files'=>'true')); ?>
					<input type="file" name="file" style="z-index: 1; opacity: 0">
					<div style="position: absolute; margin-top: -30px;z-index: 0 !important;">
						<img style="width: 35px;" src="{{asset('images/icons/excel_icon.png')}}" alt="">&nbsp &nbspВыгрузить товары из excel	
					</div>	
					
				</div>
				
				<?php echo Form::close(); ?>
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
	                                <a href="{{url('editGoodForm/' . $good->id)}}" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
	                                   Редактировать
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
					<p class="muted">Вы еще не добавили ни одного товара в магазин.</p>
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
			<div class="mix reviews" id="reviews" data-myorder="4">
				<div class="row">
					<div class="col-md-12">
						<h2>Отзывы</h2>
					</div>
					
					<div class="col-md-12">
						<h2>Отзывы</h2>
					</div>
					<div class="col-md-12">
						<h2>Отзывы</h2>
					</div>
					
				</div>
			</div>
			<div class="mix contacts" id="contacts" data-myorder="8">
				<div class="row">
					<div class="col-md-12">
						<h2>Контакты</h2>
					</div>
					
					<div class="col-md-12">
						<h2>Контакты</h2>
					</div>
					<div class="col-md-12">
						<h2>Контакты</h2>
					</div>
				</div>
			</div>
		</div>
	</section><!-- end of portfolios -->

@endsection

@section('script')
<script src="{{asset('developerTemplate/js/jquery.mixitup.js')}}"></script>
<script src="{{asset('developerTemplate/js/custom.js')}}"></script>
<script src="{{ asset('bootstrap-editable/bootstrap-editable.js') }}"></script>
<script src="{{ asset('bootstrap-editable/bootstrap-editable.min.js') }}"></script>
<script>
	$( document ).ready(function() {
	  $('.trigger').on('click', function() {
	     $('.modal-wrapper').toggleClass('open');
	    $('.page-wrapper').toggleClass('blur-it');
	     return false;
	  });
	});
</script>
<script>
$.fn.editable.defaults.mode = 'inline';
$(document).ready(function() {
    $('.name').editable({
        params: function(params) {
            // add additional params from data-attributes of trigger element
            params._token = $("#_token").data("token");
            params.name = $(this).editable().data('name');
            return params;
        },
        error: function(response, newValue) {
            if(response.status === 500) {
                return 'Server error. Check entered data.';
            } else {
                return response.responseText;
                // return "Error.";
            }
        }
    });

    $('.address').editable({
        params: function(params) {
            // add additional params from data-attributes of trigger element
            params._token = $("#_token").data("token");
            params.name = $(this).editable().data('address');
            return params;
        },
        error: function(response, newValue) {
            if(response.status === 500) {
                return 'Server error. Check entered data.';
            } else {
                return response.responseText;
                // return "Error.";
            }
        }
    });    
});
</script>
<script src="{{asset('hierarchy-select/hierarchy-select.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example-one').hierarchySelect({
            width: 200
        });
    });
</script>
@endsection