@extends('layouts.app')

@section('content')
    <div class="content-container" style="margin-top: 4%;margin-left: -4%;">

        <div class="catering" style=" margin:0 2% 0 40%;">
            <h2>Ваш заказ уже создан, осталось его оплатить!</h2>
            <p>К оплате {{$payment}} рублей, отсканируйте QR код ниже для оплаты</p><br>
            <img src="../images/index.jpeg" alt="">
        </div>




    </div>


@endsection
