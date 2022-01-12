<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(87125643, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/87125643" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-grey shadow-sm" style="position: fixed; z-index: 8; width: 100%">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <a class="navbar-brand" href="{{ url('/#set') }}">
                    Боксы
                </a>
                <a class="navbar-brand" href="{{ url('/#product') }}">
                    Меню
                </a>
                <a class="navbar-brand" href="{{ url('/altorder') }}">
                    Альтернативный заказ
                </a>
                <a class="navbar-brand" href="{{ url('/info') }}">
                    Наши услуги
                </a>
                <div id="cart_content"></div>
                <a class="navbar-brand" id="checkout" href="#">
                    Корзина
                </a>


            </div>

        </nav>

        <main class="py-4">
            <div class="hline">
                <div class="hline-ss"><a href="https://instagram.com/furshetika?utm_medium=copy_link" target="_blank"><img src="../images/inst.png" alt=""></a></div>
                <div class="hline-logo"><a href="{{ url('/') }}"><img src="../images/logo.png" alt=""></a></div>
                <div class="hline-adr"><img src="../images/geo.png" alt=""><p>   +7 918 045 88 55<p></p></div>
            </div>
            @yield('content')

        </main>




    </div>

    <script>

        var d = document,
            itemBox = d.querySelectorAll('.sets-card'), // блок каждого товара
            cartCont = d.getElementById('cart_content'); // блок вывода данных корзины
        // Функция кроссбраузерной установка обработчика событий
        function addEvent(elem, type, handler){
            if(elem.addEventListener){
                elem.addEventListener(type, handler, false);
            } else {
                elem.attachEvent('on'+type, function(){ handler.call( elem ); });
            }
            return false;
        }
        // Получаем данные из LocalStorage
        function getCartData(){
            return JSON.parse(localStorage.getItem('cart'));
        }
        // Записываем данные в LocalStorage
        function setCartData(o){
            localStorage.setItem('cart', JSON.stringify(o));
            return false;
        }
        // Добавляем товар в корзину
        function addToCart(e){
            this.disabled = true; // блокируем кнопку на время операции с корзиной
            var cartData = getCartData() || {}, // получаем данные корзины или создаём новый объект, если данных еще нет
                parentBox = this.parentNode, // родительский элемент кнопки "Добавить в корзину"
                itemId = this.getAttribute('data-id'), // ID товара
                itemTitle = parentBox.querySelector('.item_title').innerHTML, // название товара
                itemPrice = parentBox.querySelector('.item_price').innerHTML,
                itemWeight = parentBox.querySelector('.item_weight').innerHTML,// стоимость товара
                itemCount = parentBox.querySelector('.item_count').value;
                cartData[itemId] = [itemTitle, itemPrice,itemCount,itemWeight];

            if(!setCartData(cartData)){ // Обновляем данные в LocalStorage
                this.disabled = false; // разблокируем кнопку после обновления LS
            }
            return false;
        }
        // Устанавливаем обработчик события на каждую кнопку "Добавить в корзину"
        for(var i = 0; i < itemBox.length; i++){
            addEvent(itemBox[i].querySelector('.sets-button'), 'click', addToCart);
        }
        // Открываем корзину со списком добавленных товаров
        function openCart(e){

            var cartData = getCartData(), // вытаскиваем все данные корзины
                totalItems = '',
                totalCount = 0,
                totalWeight = 0,
                totalSum = 0;
            // если что-то в корзине уже есть, начинаем формировать данные для вывода
            if(cartData !== null){
                totalItems = '<table class="shopping_list"><tr><th>Название</th><th>Цена</th><th>Кол-во</th><th>Вес</th><th><a href="#" class="closeBasket">X</a></th></tr>';
                for(var items in cartData){
                    totalItems += '<tr>';
                    for(var i = 0; i < cartData[items].length; i++){
                        totalItems += '<td>' + cartData[items][i] + '</td>';
                    }
                    totalSum += cartData[items][1] * Number(cartData[items][2]);
                    totalWeight += Number(cartData[items][3])*Number(cartData[items][2]);

                    totalItems += '<td><span class="del_item" data-id="'+ items +'">X</span></td>';
                    totalItems += '</tr>';
                }
                totalItems += '<tr><td><span id="total_sum">'+ totalSum +'</span> ₽/Чел</td><td><span id="total_sum">'+ totalWeight +'</span> Гр./Чел</td><td><a href="/endorder" >Оформить </a></td></tr>';
                totalItems += '<table>';
                cartCont.innerHTML = totalItems;
            } else {
                // если в корзине пусто, то сигнализируем об этом
                cartCont.innerHTML = 'В корзине пусто!';
            }

            return false;
        }

        function closest(el, sel) {
            if (el !== null)
                return el.matches(sel) ? el : (el.querySelector(sel) || closest(el.parentNode, sel));
        }

        /* Открыть корзину */
        addEvent(d.getElementById('checkout'), 'click', openCart);
        /* Очистить корзину */
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

            } else if(e.target.className === 'closeBasket') {
                cartCont.innerHTML = null;
            }
        }, false);


    </script>
</body>

</html>
