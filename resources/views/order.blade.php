@extends('layouts.app')

@section('content')
    <div class="content-container" style="margin-top: 4%;">





            <div id="cartNew">

            </div>

        <div class="form" >
            <form action="">
                <label for="count">Кол-во персон</label><br>
                <input name="count" id="count" type="number" style="width:250px" min="1"><br>
                <label for="name">Имя</label><br>
                <input name="name" id="name" type="text" style="width:250px"><br>
                <label for="email">Email</label><br>
                <input name="email" id="email" type="email" style="width:250px"><br>
                <label for="phone">Телефон</label><br>
                <input name="phone" id="phone" type="phone" style="width:250px"><br>
                <label for="address">Адрес</label><br>
                <input name="address" id="address" type="text" style="width:250px"><br>
                <label for="name">Дата фуршета</label><br>
                <input name="date" id="date" type="date" style="width:250px"><br>
                <label for="comm">Комментарий</label><br>
                <textarea name="comm" id="comm" style="width:250px"></textarea><br>
                <label for="comm">Вариант оплаты</label><br>
                <input type="radio" id="contactChoice1"
                       name="payment" value="cash" checked>
                <label for="contactChoice1">Наличничными</label>

                <input type="radio" id="contactChoice2"
                       name="payment" value="card">
                <label for="contactChoice2">Картой</label>

                {{--<input type="radio" id="contactChoice3"--}}
                       {{--name="payment" value="org">--}}
                {{--<label for="contactChoice3">Счёт организации</label><br>--}}
                <a id="send_button" style="background-color: #277b29; ">Оформить</a>
            </form>


    </div>
    </div>
   


<script>
    var d = document,cartNew = d.getElementById('cartNew'), button = d.getElementById('send_button');
    const input = d.querySelector('#count');
    const inputName = d.querySelector('#name');
    const inputPhone = d.querySelector('#phone');
    const inputAddress = d.querySelector('#address');
    const inputDate = d.querySelector('#date');
    const inputEmail = d.querySelector('#email');
    const inputComm = d.querySelector('#comm');
    const inputPay1 = d.querySelector('#contactChoice1');
    const inputPay2 = d.querySelector('#contactChoice2');
    d.body.onclick = function () {
        console.log(input.value);
        let totalSum = 0;
        let totalWeight = 0;
        totalItems = '<table class="end_shopping_list"><tr><th>Название</th><th>Цена</th><th>Кол-во</th><th>Вес</th></tr>';
        for(var items in cartData){
            totalItems += '<tr>';
            for(var i = 0; i < cartData[items].length; i++){
                totalItems += '<td>' + cartData[items][i] + '</td>';
            }
            totalSum += cartData[items][1]*Number(cartData[items][2]);
            totalWeight +=Number(cartData[items][3])*Number(cartData[items][2]);
           // totalItems += '<td><span class="del_item" data-id="'+ items +'">X</span></td>';
            totalItems += '</tr>';
        }
        let totalSum2=Number(totalSum) * Number(input.value);
        totalItems += '<tr><td><span id="total_sum">'+ totalSum2 +'</span> ₽</td><td>'+ totalSum +' ₽/Чел</td><td>'+ totalWeight +' Гр./Чел</td></tr>';
        totalItems += '<table>';
        cartNew.innerHTML = totalItems;
    }
    button.onclick = function () {
        console.log('Хуй');
        var params = getCartData();
        const url = '{{ route('order') }}';
        const data = {
            count: input.value,
            name: inputName.value,
            phone: inputPhone.value,
            address: inputAddress.value,
            date: inputDate.value,
            email: inputEmail.value,
            comm: inputComm.value,
            payment1: inputPay1.checked,
            payment2: inputPay2.checked,
            price: totalSum,
            data: params };
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
    function getCartData(){
        return JSON.parse(localStorage.getItem('cart'));
    }

    var cartData = getCartData(), // вытаскиваем все данные корзины
        totalItems = '',
        totalCount = 0,
        totalWeight = 0,
        totalSum = 0;
    // если что-то в корзине уже есть, начинаем формировать данные для вывода
    if(cartData !== null){
        totalItems = '<table class="end_shopping_list"><tr><th>Название</th><th>Цена</th><th>Кол-во</th><th>Вес</th><th></th></tr>';
        for(var items in cartData){
            totalItems += '<tr>';
            for(var i = 0; i < cartData[items].length; i++){
                totalItems += '<td>' + cartData[items][i] + '</td>';
            }
            totalSum += cartData[items][1] * Number(cartData[items][2]);
            totalWeight += Number(cartData[items][3])*Number(cartData[items][2]);

            //totalItems += '<td><span class="del_item" data-id="'+ items +'">X</span></td>';
            totalItems += '</tr>';
        }
        totalItems += '<tr><td><span id="total_sum">'+ totalSum +'</span> ₽/Чел</td><td><span id="total_sum">'+ totalWeight +'</span> Гр./Чел</td><td></td></tr>';
        totalItems += '<table>';
        cartNew.innerHTML = totalItems;
    } else {
        // если в корзине пусто, то сигнализируем об этом
        cartNew.innerHTML = 'В корзине пусто!';
    }

    function closest(el, sel) {
        if (el !== null)
            return el.matches(sel) ? el : (el.querySelector(sel) || closest(el.parentNode, sel));
    }
    addEvent(d.body, 'click', function(e){
        if(e.target.className === 'del_item') {
            var itemId = e.target.getAttribute('data-id'),
                cartData = getCartData();
            if(cartData.hasOwnProperty(itemId)){
                var tr = closest(e.target, 'tr');
                tr.parentNode.removeChild(tr); /* Удаляем строку товара из таблицы */
                // пересчитываем общую сумму и цену
                var totalSumOutput = d.getElementById('total_sum');

                totalSumOutput.textContent = +totalSumOutput.textContent - cartData[itemId][1] * cartData[itemId][2];

                delete cartData[itemId]; // удаляем товар из объекта
                setCartData(cartData); // перезаписываем измененные данные в localStorage
            }
        }else if(e.target.className === 'send_button'){
            console.log('Хуй');
            var params = getCartData();
            const url = '{{ route('order') }}';
            const data = { data: params };
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
                localStorage.removeItem('cart')
                if (response.redirected) {
                    window.location.href = response.url;
                }
            })
                .catch(function(err) {
                    console.info(err + " url: " + url);
                });


        } else if(e.target.className === 'closeBasket') {
            cartCont.innerHTML = null;
        }
    }, false);
</script>
@endsection
