@extends('office')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('dropzone/basic.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.3/css/star-rating.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap-editable/bootstrap-editable.css') }}">

    <link href='https://fonts.googleapis.com/css?family=PT+Serif:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
    <style>
    .item-slick3 > .delbtn {
      position: absolute;
      top: 7%;
      left: 92%;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      background-color: #e65540;
      color: white;
      font-size: 25px;
      padding: 0px 19px;
      border: none;
      cursor: pointer;
      border-radius: 3px;
    }

    .item-slick3 > .delbtn:hover {
      background-color: #f42c35;
    }

    .btn-tomato{
        background-color: #e65540;
        color: white;
    }

    .btn-tomato:hover {
        background-color: #dc3545;
        color: black;
    }
    </style> 
@endsection

@section('activeNav')
    <li><a href="{{route('mysettings')}}"><span class="muted">Настройки</span></a></li>
    <li><a href="{{route('myreviews')}}"><span class="muted">Отзывы</span></a></li>
    <li class="active"><a href="{{route('office')}}"><span class="muted">Товары</span></a></li>
@endsection

@section('officeContent')

    <!-- Product Detail -->
    <div class="container bg-light p-t-35 p-b-80">
        <h4 class="product-detail-name m-text16 p-b-13" style="text-align: center">
            Редактирование информации о товаре
        </h4>
        <div class="bg6" id="image" style="margin-top: 4px; border: 1px solid rgba(0,0,0,.15); border-radius: .25rem; text-align: center;">
            <form method="post" action="{{route('addPhoto')}}"
                  enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                {{ csrf_field() }}
                <input type="hidden" name="goodID" value="{{$good->id}}">
                <div class="dz-message" style="padding: 40px;">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="message">
                            <p>Перетащите сюда фото или нажмите, чтобы добавить фото товара.</p>
                            <p>Затем перезугрузите страницу, чтобы увидеть изменения</p>
                        </div>
                    </div>
                </div>
                <div class="fallback">
                    <input type="file" name="file" multiple>
                </div>
            </form>
        </div>
        <div class="flex-w flex-sb">
            <div class="w-size13 p-t-30 respon5">
                <div class="wrap-slick3 flex-sb flex-w">
                    <div class="wrap-slick3-dots"></div>

                    <div class="slick3">
                        @if(count($photos)>0)
                        @foreach($photos as $photo)
                        <div class="item-slick3" data-thumb="{{asset('/resources/images') . '/' . $good->id . '/' . $photo->filename}}">
                            <form action="{{route('delPhoto')}}" method="post" id="delPhotoForm{{$photo->id}}">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$good->id}}" name="good_id">
                                <input type="hidden" value="{{$photo->filename}}" name="filename">
                            </form>
                            <button id="delPhoto" class="delbtn" title="удалить" onclick="delPhoto({{$photo->id}})">&times;</button>
                            <div class="wrap-pic-w square">
                                <img src="{{asset('/resources/images') . '/' . $good->id . '/' . $photo->filename}}" alt="фото-товара">
                            </div>
                            <br>
                            <div class="text-center"><a class="btn btn-lg btn-tomato" href="{{url('deleteGood/' . $good->id)}}">удалитьлить товар</a></div>
                        </div>
                        @endforeach
                        @else
                        <div class="item-slick3" data-thumb="{{asset('../resources/images/product-detail-01.jpg')}}">
                            <div class="wrap-pic-w">
                                <img src="{{asset('../resources/images/product-detail-01.jpg')}}" alt="добавьте фото">
                            </div>
                            <div class="text-center"><a class="btn btn-lg btn-tomato" href="{{url('deleteGood/' . $good->id)}}">удалитьлить товар</a></div>
                        </div>

                        <div class="item-slick3" data-thumb="{{asset('../resources/images/product-detail-02.jpg')}}">
                            <div class="wrap-pic-w">
                                <img src="{{asset('../resources/images/product-detail-02.jpg')}}g" alt="добавьте фото">
                            </div>
                            <div class="text-center"><a class="btn btn-lg btn-tomato" href="{{url('deleteGood/' . $good->id)}}">удалитьлить товар</a></div>
                        </div>

                        <div class="item-slick3" data-thumb="{{asset('../resources/images/product-detail-03.jpg')}}">
                            <div class="wrap-pic-w">
                                <img src="{{asset('../resources/images/product-detail-03.jpg')}}" alt="добавьте фото">
                            </div>
                            <div class="text-center"><a class="btn btn-lg btn-tomato" href="{{url('deleteGood/' . $good->id)}}">удалитьлить товар</a></div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="w-size14 p-t-30 respon5">
                <div id="_token" class="hidden" data-token="{{ csrf_token() }}"></div>
                <h4 class="product-detail-name m-text14 p-b-13 muted">Редактируйте информацию о товаре</h4><br>
                <h4 class="product-detail-name m-text16 p-b-13">
                    <a href="#" class="title m-text16" data-type="text" data-column="title" data-url="{{route('editTitle')}}" data-pk="{{$good->id}}" data-title="title" data-name="title"> {{$good->title}} <i class="glyphicon glyphicon-pencil"></i></a>
                </h4>
                
                <span class="m-text17">
                    <del>{{$good->oldprice}}</del>
                </span>
                <span class="m-text16">
                <a href="#" class="price" data-type="text" data-column="title" data-url="{{route('editPrice')}}" data-pk="{{$good->id}}" data-title="price" data-name="price"><span class="m-text17">
                {{$good->price}}</span></a><span class="m-text17"> Тг.</span>
                </span>
                
                <hr>
                <div class="p-b-45">
                    <span class="s-text8"><b>Категория: </b>
                    <a href="#" id="category" data-type="select" data-pk="{{$good->id}}" data-url="{{route('editCategory')}}" data-title="category">{{ App\Category::find($good->category)->title }}</a></span>
                </div>
                
                <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        Описание
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                            <a href="#" class="description" data-type="text" data-column="description" data-url="{{route('editDescription')}}" data-pk="{{$good->id}}" >
                                <span class="muted s-text8 p-t-10">{{$good->description}} </span><i class="glyphicon glyphicon-pencil"></i>
                            </a>
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
                        @foreach($reviews as $review)
                        <p class="s-text8">
                            {{ $review->text }}
                        </p>
                        <p class="s-text">{{ $review->created_at }}</p>
                        <div class="row lead">
                            <div id="stars-existing" class="starrr" data-rating='{{ $review->points }}'></div>
                            You gave a rating of <span id="count-existing">{{ $review->points }}</span>
                        </div>
                        <!-- <b>Points: </b><span class="s-text">{{ $review->points }}</span> -->
                        <br><br>
                        @endforeach
                        @else
                        <p class="s-text8">
                            Нет отзывов                            
                        </p>
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
    <script src="{{ asset('bootstrap-editable/bootstrap-editable.js') }}"></script>
    <script src="{{ asset('bootstrap-editable/bootstrap-editable.min.js') }}"></script>
    <script>
    $.fn.editable.defaults.mode = 'inline';
    $(document).ready(function() {
        $('.title').editable({
            params: function(params) {
                params._token = $("#_token").data("token");
                params.name = $(this).editable().data('title');
                return params;
            },
            error: function(response, newValue) {
                if(response.status === 500) {
                    return 'Server error. Check entered data.';
                } else {
                    return response.responseText;
                }
            }
        });

        $('.price').editable({
            params: function(params) {
                params._token = $("#_token").data("token");
                params.name = $(this).editable().data('price');
                return params;
            },
            error: function(response, newValue) {
                if(response.status === 500) {
                    return 'Server error. Check entered data.';
                } else {
                    return response.responseText;
                }
            }
        });

        $('.description').editable({
            params: function(params) {
                params._token = $("#_token").data("token");
                params.name = $(this).editable().data('description');
                return params;
            },
            error: function(response, newValue) {
                if(response.status === 500) {
                    return 'Server error. Check entered data.';
                } else {
                    return response.responseText;
                }
            }
        });


        $('#category').editable({

            value: {{$good->category}},    
            source: [
            <?php $cats = App\Category::get(); 
                foreach ($cats as $cat) {
                  echo "{value:" . $cat->id . ", text: '" . $cat->title ."'},";
                }
            ?>
               ],
            params: function(params) {
                params._token = $("#_token").data("token");
                params.name = $(this).editable().data('category');
                return params;
            },
            error: function(response, newValue) {
                if(response.status === 500) {
                    return 'Server error. Check entered data.';
                } else {
                    return response.responseText;
                }
            }
        });
    
    });
    </script>

    <script>
        function delPhoto($id) {
          document.getElementById("delPhotoForm" + $id).submit();
        }
    </script>
@endsection