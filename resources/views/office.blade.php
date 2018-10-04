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
        @if(Auth::user()->role == 'candidate')
            <h1 class="text-center m-t-20">Настройте свой мазагин</h1>
            <p class="muted text-center m-t-10">Настройка обязательна. Без нее Ваш магазин не будет виден для покупателей.</p>
        @endif
        <div class="col-md-8 col-my-offset-25 m-t-25">
            <div class="bg6 panel panel-default">
                <div class="panel-heading"><h3>Обязательные данные продавца</h3></div>
                <div class="panel-body">



                    # добавить другой обработчик формы #


                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Имя</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="surname" class="col-md-4 control-label">Фамилия</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="fathername" class="col-md-4 control-label">Отчество</label>

                            <div class="col-md-6">
                                <input id="fathername" type="text" class="form-control" name="fathername" value="{{ old('fathername') }}" required autofocus>

                                @if ($errors->has('fathername'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('fathername') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="iin" class="col-md-4 control-label">ИИН</label>

                            <div class="col-md-6">
                                <input id="iin" type="tel" class="form-control" name="iin" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    Открыть магазин
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @yield('script')
@endsection