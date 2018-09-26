 @extends('office')

@section('activeNav')
    <li><a href="{{route('mysettings')}}"><span class="muted">Настройки</span></a></li>
    <li class="active"><a href="{{route('myreviews')}}"><span class="muted">Отзывы</span></a></li>
@endsection

@section('officeContent')

<h4>Все отзывы по товарам продавца будут здесь</h4>

@endsection