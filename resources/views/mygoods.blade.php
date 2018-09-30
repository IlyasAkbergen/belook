@extends('office')

@section('activeNav')
    <li><a href="{{route('myreviews')}}"><span class="muted">Отзывы</span></a></li>
    <li><a href="{{route('mysettings')}}"><span class="muted">Настройки</span></a></li>
    <li class="active"><a href="{{route('office')}}"><span class="muted">Мой контейнер</span></a></li>
@endsection

@section('officeContent')
    <br><br>

    <link rel="stylesheet" href="{{asset('hierarchy-select/pygments.css')}}">  
    <link rel="stylesheet" href="{{asset('hierarchy-select/hierarchy-select.min.css')}}">

    <div class="tab01">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal" >
                <i class="fa fa-plus"></i>&nbsp &nbspДобавить товар в контейнер
            </button>
            @yield('addgood')
        </ul>
    </div>
    <br><br>
    <h1 class="m-text5 t-center">Мой контейнер</h1>
    <br><br><br>

    <div class="col-sm-10 col-sm-offset-1">
        @if(count($goods) < 1)
            <p class="muted text-center">Вы еще не добавили ни одного товара в свой контейнер.</p>
            <br><br><br><br><br>
        @else
        @foreach($goods as $good)
        <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
            <!-- Block2 -->
            <div class="block2">
                <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew rectangle bg-light">
                    <?php $avatars = App\GoodPhoto::where('good_id', $good->id)->get();
                        if(count($avatars)>0){
                            $avatar = $avatars->first()->filename;
                        }else{
                          $avatar='default';  
                        } ?>
                    @if($avatar == 'default')
                    <img src="images/item-02.jpg" alt="IMG-PRODUCT">
                    @else
                    <img src="{{asset('../resources/images') . '/' . $good->id . '/' . $avatar}}" alt="фото товара">
                    @endif
                    <div class="block2-overlay trans-0-4">
                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                        </a>

                        <div class="block2-btn-addcart w-size1 trans-0-4">
                            <!-- Button -->
                            <a href="editGoodForm/{{$good->id}}" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                Редактировать
                            </a>
                        </div>
                    </div>
                </div>

                <div class="block2-txt p-t-20 bg-light">
                    <a href="editGoodForm/{{$good->id}}" class="block2-name dis-block s-text3 p-b-5"  style="padding: 3px 0px 0px 15px">
                        {{ $good->title }}
                    </a>

                    <span class="block2-price m-text6 p-r-5" style="padding: 3px 0px 4px 15px">
                        {{$good->price}} Тг.
                    </span><br><br>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>                       

@endsection