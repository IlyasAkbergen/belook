@extends('layouts.shopLayout')
@section('head')
<link href="http://cdn-na.infragistics.com/igniteui/2017.2/latest/css/themes/infragistics/infragistics.theme.css" rel="stylesheet" />
<link href="http://cdn-na.infragistics.com/igniteui/2017.2/latest/css/structure/infragistics.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('carousel/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('carousel/owl.theme.default.min.css')}}">
<!-- javascript -->
<script src="{{asset('carousel/jquery.min.js')}}"></script>
<script src="{{asset('carousel/owl.carousel.js')}}"></script>
@endsection

@section('nav')
<li class="sale-noti">
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
<li class="sale-noti">
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
	<!-- Content page -->
	<section class="bgwhite p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-5">
					<div class="leftbar p-r-20 p-r-0-sm">
						<div class="wrap-dropdown-content active-dropdown-content">
							<h4 class="p-b-7 js-toggle-dropdown-content flex-sb-m cs-pointer m-text15 color0-hov trans-0-4">
								Категории
								<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                     			<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
							</h4>
							<?php $categories = App\Category::orderBy('code', 'asc')->get();?>
							<ul class="p-b-54 dropdown-content dis-none">
								<li class="p-t-4">
									@if(empty($currentCat))
									<a href="{{route('shop')}}" class="s-text18">
										Все
									</a>
									@else
									<a href="{{route('shop')}}" class="s-text13">
										Все
									</a>
									@endif
								</li>
								@foreach($categories as $category)
								<li class="p-t-4" <?php echo 'style="padding-left: ' . $category->data_level*15 . 'px;"' ?>>
									@if(!empty($currentCat) && $category->id == $currentCat->id)
									<a href="{{url('category' . '/' . $category->id)}}" class="s-text18">
										{{$category->title}}
									</a>
									
									@else
									<a href="{{url('category' . '/' . $category->id)}}" class="s-text13">
										{{$category->title}}
									</a>
									@endif
								</li>
								@endforeach
							</ul>
						</div>
						<!--  -->
						<div class="wrap-dropdown-content">
							<h4 class="p-b-7 js-toggle-dropdown-content flex-sb-m cs-pointer m-text15 color0-hov trans-0-4">
								Фильтры
								<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                     			<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
							</h4>
							<div class="dropdown-content dis-none">
								<div class="filter-price p-t-22 p-b-50 bo3">
									<div class="m-text15 p-b-17">
										Цена
									</div>

									<div class="wra-filter-bar">
										<div id="filter-bar"></div>
									</div>

									<div class="flex-sb-m flex-w p-t-16">
										<div class="w-size11">
											<!-- Button -->
											<button class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4">
												Фильтр
											</button>
										</div>

										<div class="s-text3 p-t-10 p-b-10">
											Диапазон: <span id="value-lower">200тг</span> - <span id="value-upper">100000тг</span>
										</div>
									</div>
								</div>

								<div class="filter-color p-t-22 p-b-50 bo3">
									<div class="m-text15 p-b-12">
										Цвет
									</div>

									<ul class="flex-w">
										<li class="m-r-10">
											<input class="checkbox-color-filter" id="color-filter1" type="checkbox" name="color-filter1">
											<label class="color-filter color-filter1" for="color-filter1"></label>
										</li>

										<li class="m-r-10">
											<input class="checkbox-color-filter" id="color-filter2" type="checkbox" name="color-filter2">
											<label class="color-filter color-filter2" for="color-filter2"></label>
										</li>

										<li class="m-r-10">
											<input class="checkbox-color-filter" id="color-filter3" type="checkbox" name="color-filter3">
											<label class="color-filter color-filter3" for="color-filter3"></label>
										</li>

										<li class="m-r-10">
											<input class="checkbox-color-filter" id="color-filter4" type="checkbox" name="color-filter4">
											<label class="color-filter color-filter4" for="color-filter4"></label>
										</li>

										<li class="m-r-10">
											<input class="checkbox-color-filter" id="color-filter5" type="checkbox" name="color-filter5">
											<label class="color-filter color-filter5" for="color-filter5"></label>
										</li>

										<li class="m-r-10">
											<input class="checkbox-color-filter" id="color-filter6" type="checkbox" name="color-filter6">
											<label class="color-filter color-filter6" for="color-filter6"></label>
										</li>

										<li class="m-r-10">
											<input class="checkbox-color-filter" id="color-filter7" type="checkbox" name="color-filter7">
											<label class="color-filter color-filter7" for="color-filter7"></label>
										</li>
									</ul>
								</div>
							</div>
						</div>

						<div class="wrap-dropdown-content">
							<h4 class="p-b-7 js-toggle-dropdown-content flex-sb-m cs-pointer m-text15 color0-hov trans-0-4">
								Сортировка
								<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                     			<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
							</h4>
							<div class="dropdown-content dis-none ">
								<div class="flex-w">
									<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
										<select class="selection-2" name="sorting">
											<option>Default Sorting</option>
											<option>Popularity</option>
											<option>Price: low to high</option>
											<option>Price: high to low</option>
										</select>
									</div>
									<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
										<select class="selection-2" name="sorting">
											<option>Price</option>
											<option>$0.00 - $50.00</option>
											<option>$50.00 - $100.00</option>
											<option>$100.00 - $150.00</option>
											<option>$150.00 - $200.00</option>
											<option>$200.00+</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<!-- carousel -->
					@if(count($goods) > 0)
						@if($searchgood != '')
							<h4 class="m-text6">Результаты по запросу: &nbsp;<span class="m-text15">{{$searchgood}}</span></h4><hr>
						@endif
					
					<div class="sec-title p-b-25 m-t-30">
				        <h3 class="m-text15 t-center" style="font-size: 40px !important;">
				            Товары
				        </h3>
				    </div> 

				    <div class="row" style="margin-right: -35px">
				    	@if(count($goods) > 0 && count($goods) < 10)
				        <div class="col-sm-12 col-sm-offset owl-carousel">
				           
				            @foreach($goods as $good)
				                <!-- Block2 -->
				                <div class="block2">
				                    <div class="block2-img square pos-relative wrap-pic-w of-hidden">
				                        @if($good->sale > 0)
				                        	<span class = "mylabel">-{{ $good->sale }}%</span>
				                        @endif
				                        <?php $avatars = App\GoodPhoto::where('good_id', $good->id)->get();
				                        if(count($avatars)>0){
				                            $avatar = $avatars->first()->filename;
				                        }else{
				                          $avatar='default';  
				                        } ?>
				                        @if($avatar == 'default')
				                        <img class="square_img" src="images/item-02.jpg" alt="IMG-PRODUCT">
				                        @else
				                        <img class="square_img" src="{{asset('resources/images') . '/' . $good->id . '/' . $avatar}}" alt="фото товара">
				                        @endif
				                        <div class="block2-overlay trans-0-4">
				                            @if(!Auth::guest() && Auth::user()->token == null)
				                            <div class="block2-btn-addcart block2-btn-addcartBtn w-size1 trans-0-4 text-center m-b-20">
				                                <!-- Button -->
				                                <a onclick="addToCart({{$good->id}})" href="#" class="btn btn-lg bg4 bo-rad-23 hov1 s-text1 trans-0-4">
				                                    в корзину
				                                </a>
				                                <br><br>
				                            </div>
				                                @endif
				                            <div class="block2-btn-addcart w-size1 trans-0-4 text-center">
				                                <a href="{{url('good/' . $good->id)}}" class="btn btn-lg bg4 bo-rad-23 hov1 s-text1 trans-0-4">
				                                   купить
				                                </a>
				                            </div>
				                        </div>
				                    </div>

				                    <div class="block2-txt p-t-20 text-center">
				                        <a href="{{url('good/' . $good->id)}}" class="block2-name dis-block s-text3 p-b-5 d-inline-block text-truncate" style="width: 90%">
				                            {{$good->title}}
				                        </a>
				                        @if($good->oldprice != NULL)
				                        <span class="block2-price m-text7 p-r-5">
				                            {{$good->oldprice}} 
				                        </span>
				                        @endif

				                        <span class="block2-newprice m-text8 p-r-5">
				                            {{$good->price}} Тг.
				                        </span>
				                    </div>
				                </div>
				            @endforeach
				           
				        </div>
					    <script>
					      var owl = $('.owl-carousel');
					      owl.owlCarousel({
					        margin: 10,
					        loop: true,
					        autoplay:true,
					        autoplayTimeout: 4000,
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
					            items: 5.5
					          }
					        }
					      })
					    </script>
						@elseif(count($goods) > 0 && count($goods) > 10)
							
							<?php 
								$half = ceil($goods->count() / 2);
								$chunks = $goods->chunk($half);
							?>
							@foreach($chunks as $chunk)
								<div class="col-sm-12 col-sm-offset owl-carousel" style="border-bottom: 1px solid lightgrey; margin-bottom: 17px">
						        @foreach($chunk as $good)
					                <div class="block2">
					                    <div class="block2-img square pos-relative wrap-pic-w of-hidden">
					                        @if($good->sale > 0)
					                        	<span class = "mylabel">-{{ $good->sale }}%</span>
					                        @endif
					                        <?php $avatars = App\GoodPhoto::where('good_id', $good->id)->get();
					                        if(count($avatars)>0){
					                            $avatar = $avatars->first()->filename;
					                        }else{
					                          $avatar='default';  
					                        } ?>
					                        @if($avatar == 'default')
					                        <img class="square_img" src="images/item-02.jpg" alt="IMG-PRODUCT">
					                        @else
					                        <img class="square_img" src="{{asset('resources/images') . '/' . $good->id . '/' . $avatar}}" alt="фото товара">
					                        @endif
					                        <div class="block2-overlay trans-0-4">
					                            @if(!Auth::guest() && Auth::user()->token == null)
					                            <div class="block2-btn-addcart block2-btn-addcartBtn w-size1 trans-0-4 text-center m-b-20">
					                                <!-- Button -->
					                                <a onclick="addToCart({{$good->id}})" href="#" class="btn btn-lg bg4 bo-rad-23 hov1 s-text1 trans-0-4">
					                                    в корзину
					                                </a>
					                                <br><br>
					                            </div>
					                                @endif
					                            <div class="block2-btn-addcart w-size1 trans-0-4 text-center">
					                                <a href="{{url('good/' . $good->id)}}" class="btn btn-lg bg4 bo-rad-23 hov1 s-text1 trans-0-4">
					                                   купить
					                                </a>
					                            </div>
					                        </div>
					                    </div>

					                    <div class="block2-txt p-t-20 text-center">
					                        <a href="{{url('good/' . $good->id)}}" class="block2-name dis-block s-text3 p-b-5 d-inline-block text-truncate" style="width: 90%">
					                            {{$good->title}}
					                        </a>
					                        @if($good->oldprice != NULL)
					                        <span class="block2-price m-text7 p-r-5">
					                            {{$good->oldprice}} 
					                        </span>
					                        @endif

					                        <span class="block2-newprice m-text8 p-r-5">
					                            {{$good->price}} Тг.
					                        </span>
					                    </div>
					                </div>

					            @endforeach
					            </div>

							    <script>
							      var owl = $('.owl-carousel');
							      owl.owlCarousel({
							        margin: 10,
							        loop: true,
							        autoplay:true,
							        autoplayTimeout: 4000,
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
							            items: 5.5
							          }
							        }
							      })
							    </script>
							@endforeach
						   
					    @else
		                <div class="col-xs-12 text-center">
		                    <p class="m-text17">Нет товаров по данному запросу.</p>
		                </div>
			            @endif
				    </div>
					@endif
					<!-- end carousel -->

					<!-- sellers carousel -->

					@if(!empty($sellers))
						@if(count($sellers) > 0)
							<div class="sec-title p-b-25 m-t-30">
						        <h2 class="m-text15 t-center" style="font-size: 40px !important;">
						            Продавцы
						        </h3>
						    </div> 
							<div class="row">
								<div class="col-sm-12 col-sm-offset owl-carousel">
							        @foreach($sellers as $seller)
						                <div class="block2">
						                    <div class="block2-img square pos-relative wrap-pic-w of-hidden">
						                        
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
					            <script>
							      var owl = $('.owl-carousel');
							      owl.owlCarousel({
							        margin: 10,
							        loop: true,
							        autoplay:true,
							        autoplayTimeout: 4000,
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
							            items: 5.5
							          }
							        }
							      })
							    </script>

							</div>
						@else
							<div class="sec-title p-b-22">
								<br><br>
						        <h4 class="m-text5 t-center">
						            К сожалению, мы ничего не нашли по Вашему запросу.
						        </h4>
						    </div>
						@endif
					@endif
						
					<!-- end sellers carousel -->
				</div>
			</div>
		</div>
	</section>

@endsection

@section('script')
<script src="{{asset('hierarchy-select/hierarchy-select.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example-one').hierarchySelect({
            width: 200
        });
    });
</script>
@endsection