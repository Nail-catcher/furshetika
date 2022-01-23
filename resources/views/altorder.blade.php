@extends('layouts.app')

@section('content')
    <div class="content-container" style="margin-top: 1%;">
{{-- $table->text('name')->nullable();
            $table->text('address')->nullable();
            $table->text('phone')->nullable();
            $table->text('event')->nullable();
            $table->integer('peoples')->nullable();
            $table->date('date')->nullable();
            $table->string('email')->nullable();
            $table->text('menu')->nullable();
            $table->text('comm')->nullable();--}}


        <div class="offers"  >
            <h2>
            <a href="{{asset('images/pdf.pdf')}}" target="_blank">Открыть меню</a></h2>
            <form action="">
                <label for="name">ФИО</label><br>
                <input name="name" id="name" type="text" style="width:450px"><br>
                <label for="email">Email</label><br>
                <input name="email" id="email" type="email" style="width:450px"><br>
                <label for="phone">Телефон</label><br>
                <input name="phone" id="phone" type="phone" style="width:450px"><br>
                <label for="address">Адрес</label><br>
                <input name="address" id="address" type="text" style="width:450px"><br>
                <label for="count">Кол-во персон</label><br>
                <input name="count" id="count" type="number" style="width:450px" min="1"><br>
                <label for="name">Дата мероприятия</label><br>
                <input name="date" id="date" type="date" style="width:450px"><br>
                <label for="event">Вид мероприятия</label><br>
                <textarea name="event" id="event" style="width:450px"></textarea><br>
                <label for="comm">Комментарий</label><br>
                <textarea name="comm" id="comm" style="width:450px"></textarea><br>
                <label for="menu">Меню </label><br>
                <textarea name="menu" id="menu" style="width:450px"></textarea><br>

                
                <a id="alt_send_button" style="background-color:  #277b29; width:450px; ">Отправить заказ</a>
            </form>


        </div>
    </div>
    <script>
    var d = document, button = d.getElementById('alt_send_button');
    const input = d.querySelector('#count');
    const inputName = d.querySelector('#name');
    const inputPhone = d.querySelector('#phone');
    const inputAddress = d.querySelector('#address');
    const inputDate = d.querySelector('#date');
    const inputEmail = d.querySelector('#email');
    const inputComm = d.querySelector('#comm');
    const inputEvent = d.querySelector('#event');
    const inputMenu = d.querySelector('#menu');

            button.onclick = function () {
            console.log('Хуй');
            var params = getCartData();
            const url = '{{ route('altorder.store') }}';
            const data = {
            peoples: input.value,
            name: inputName.value,
            phone: inputPhone.value,
            address: inputAddress.value,
            date: inputDate.value,
            email: inputEmail.value,
            comm: inputComm.value,
            event: inputEvent.value,
            menu: inputMenu.value,
            };
            const csrfToken = "{{csrf_token()}}"
            fetch(url, {
            method: 'POST',
            redirect: 'follow',
            body: JSON.stringify(data),
            headers: {
            'Content-Type': 'application/json',
            'x-csrf-token': csrfToken
            }
            }).then(response => {
            console.log( data);
            if (response.redirected) {

            window.location.href = response.url;
            }
            })
            .catch(function(err) {
            console.info(err + " url: " + url);
            });

            }
        </script>

@endsection
