@extends('office')

@section('activeNav')
    @if(Auth::user()->role == 'seller')
    <li><a href="{{route('myreviews')}}"><i class="icon-signal"></i> <span class="muted">Отзывы</span></a></li>
    @endif
    <li class="active" id="active"><a href="{{route('mysettings')}}"><i class="icon-lock"></i> <span class="muted">Настройки</span></a></li>
@endsection

@section('officeContent')
    

@endsection