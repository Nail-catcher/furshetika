<h1>Заказ на сайте:</h1>
{{--@foreach($data as $d)--}}
{{--{{$d}}--}}
{{--@endforeach--}}
<p><strong>Имя:</strong> {{ $data['name'] }}</p>
<p><strong>Почта:</strong> {{ $data['email'] }}</p>
<p><strong>Телефон:</strong> {{ $data['phone'] }}</p>
<p><strong>Количество человек:</strong> {{ $data['peoples'] }}</p>
<p><strong>Адрес:</strong> {{ $data['address'] }}</p>
<p><strong>Стоимость:</strong> {{ $data['price'] }}</p>
<p><strong>Тип оплаты:</strong> {{ $data['payment'] }}</p>
<p><strong>Дата:</strong> {{ $data['date'] }}</p>
<p><strong>Комментарий:</strong> {{ $data['comm'] }}</p>
<p><strong>Меню:</strong>
@foreach($data['prods'] as $prod)
        {{$prod}} <br>
    @endforeach
</p>