@extends('layouts.app')

@section('content')
    <div class="content-container" style="margin-top: 4%; margin-left: -4%;">

        <div class="catering" style=" margin:0 2% 0 40%;">
            <h2>Что такое кейтиринг?</h2>
            @foreach($textes as $text)
                @if($text->category == 'katering')
                    <p>{{$text->text}}</p><br>
                @endif
            @endforeach
        </div>
        <div class="offers" style=" margin:0 2% 0 40%;">
            <h2>Наши услуги:</h2>
            @foreach($textes as $text)
                @if($text->category == 'offer')
                    <p>{{$text->text}}</p><br>
                @endif
            @endforeach

        </div>



    </div>


@endsection
