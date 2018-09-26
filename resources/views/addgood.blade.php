@extends('layouts.shopLayout')
@section('head')
<link href="http://cdn-na.infragistics.com/igniteui/2017.2/latest/css/themes/infragistics/infragistics.theme.css" rel="stylesheet" />
<link href="http://cdn-na.infragistics.com/igniteui/2017.2/latest/css/structure/infragistics.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('hierarchy-select/pygments.css')}}">  
<link rel="stylesheet" href="{{asset('hierarchy-select/hierarchy-select.min.css')}}">

<style>
    form{
        position: relative;
        display: -ms-flexbox;
        -ms-flex-direction: column;
        flex-direction: column;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0,0,0,.2);
        border-radius: .3rem;
        outline: 0;
    }
    @media (max-width: 992px){
        .container {
            margin-top: 100px;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <h2 class="m-text-17 text-center m-b-20"><b>Добавить новый товар</b></h2>
    <form action="{{route('addgood')}}" class="myModal form p-t-15 p-b-15 m-b-20 bg-light col-lg-6 col-lg-offset-3" method="POST"> <!-- enctype="multipart/form-data"> -->
        {{ csrf_field() }}
        <div class="container">
            <div class="form-group">
                <label for="title"><h3>&nbsp;Название товара</h3></label>
                <input name="title" type="text" id="title" class="form-control" required>
            </div><hr>
            <div class="btn-group hierarchy-select" data-resize="auto" id="example-one">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="selected-label pull-left">&nbsp;</span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu open">
                    <div class="hs-searchbox">
                        <input type="text" class="form-control" id="category[]" autocomplete="off">
                    </div>
                    <ul class="dropdown-menu inner" role="menu">
                        <li data-value="" data-level="1" data-default-selected="">
                            <a href="#">Категория</a>
                        </li>
                         <?php

                            $options = App\Category::orderBy('code', 'asc')->get();
                            
                            foreach ($options as $option){
                                ?><li data-value="{{$option->id}}" data-level="{{$option->data_level}}"><a href="#">{{$option->title}}</a></li><?php
                            }
                        
                        ?>
                    </ul>
                </div>
                <input class="hidden hidden-field" name="category" readonly="readonly" aria-hidden="true" type="text" required />
            </div>
            <hr>
            <div class="form-group">
                <label for="description"><h3>&nbsp;Описание товара</h3></label>
                <textarea name="description" class="form-control" rows="8" id="description" class="form-control" required></textarea>
            </div><hr>

            <div class="form-group">
                <label for="price"><h3>&nbsp;Цена</h3></label>
                <input name="price" type="text" id="price" class="form-control" required>
            </div><hr>
            <button class="btn btn-lg btn-success">Добавить товар</button>
        </div>
    </form>
</div>    
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