@extends('layouts.shopLayout')
@section('head')
    <style>
        .nav > .active {
          background: #f0f0f0;
          text: #e65540;
          border-radius: 3px;
        }

        .officeNav {
            border-bottom: 1px solid #dddddd !important;
        }
    </style>
    @yield('head')
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
<div class="container">
    <div class="sec-title p-b-22">
        <h3 class="m-text5 t-center">
            Ваш кабинет
        </h3>
    </div>

    <div class="tab01">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs officeNav" role="tablist">
            @yield('activeNav')  
        </ul>
    </div>
    @yield('officeContent')
</div>
@endsection

@section('script')
    @yield('script')
@endsection