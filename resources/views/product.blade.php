@extends('layouts.app')

@section('content')
    <div class="main_block"  style=" margin-left: -20%;">

        <div class="right_block" style=" float:right; width: 40%">
        <h3 style="text-align: center">{{$product->name}}</h3>
            <h3 style="text-align: center">{{$product->descriprion}}</h3>
        <div class="sets-price">
            <h5><span class="item_price">{{$product->price}}</span> ₽</h5><h5 style="margin-left: 15%;">222 гр.</h5>
        </div>
        <div class="sets-button" data-id="{{$product->id}}"  style="width: 40%" >
            <a  >В Корзину</a>
        </div>
        </div>
        <div class="left_block" style=" float:right; width: 40%">
        <img src="{{ asset($product->image) }}" alt="" style="width: 90%">
        <h3 style="text-align: center">{{$product->pathes}}</h3>
        </div>
    </div>

@endsection