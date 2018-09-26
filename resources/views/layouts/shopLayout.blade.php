@extends('layouts.app')
	
	@section('head')
		@yield('head')
	@endsection

	@section('mobileNav')
		<li class="item-menu-mobile">
			<a href="{{route('shop')}}">Поиск</a>
		</li>

		<li class="item-menu-mobile">
			<a href="{{route('home')}}">Главная</a>
		</li>

        <li class="item-menu-mobile">
            <a href="about.html">О нас</a>
        </li>

        <li class="item-menu-mobile">
            <a href="contact.html">Контакты</a>
        </li>
	@endsection

	@section('content')
 		@yield('content')
	@endsection

@section('script')
	@yield('script')
@endsection

