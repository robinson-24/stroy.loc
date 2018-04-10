<html lang="ru">
<head>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title or 'Харьков - Стройматериалы' }}</title>
    <meta name="description" content="{{ $description or 'Харьков - Стройматериалы' }}">

    <link type="text/css" rel="stylesheet" href="{{ asset('css/my.css') }}?<?php echo time();?>">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/base.css') }}?<?php echo time();?>">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/layer1.css') }}?<?php echo time();?>">
    
    <link type="text/css" rel="stylesheet" href="{{ asset('css/ulightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome/web-fonts-with-css/css/fontawesome-all.css') }}">
    
    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/ulightbox.js') }}"></script>

    {{ csrf_field() }}
</head>

<body>
    <div style="width: 252px; height: 450px; position: fixed; right: 0px; top: 0px; overflow: hidden; z-index: 2147483640; margin: 0px; padding: 0px; background: none; display: none;" id="dVasw_yE">

    </div>

    <div id="utbr8214" rel="s16"></div>

    <div id="m-contanier">
        <!--U1AHEADER1Z-->
        <header class="b-header">
            <div class="logo b-h">
                <a href="/" class="b-header-logo"><img alt="Главная" src="{{ asset('/images/logo.png') }}" title="Стройматериалы в Харькове" class="b-header-logo"></a>
            </div>
            <div class="about b-h">
                <p>Мы реализуем строительные.</p>
                <p>материалы с доставкой по Харькову и области.</p>
                <p>Доставка и разгрузка в день оформления заявки</p>
            </div>
            <div class="info b-h">
                <input class="open" id="top-box-call" type="checkbox" hidden="">
                <label class="btn-call" for="top-box-call" onclick="myFunction(this)"></label>
                <div class="top-panel-call">
                    <p>г. Харьков, ул. Индустриальная, 8</p>
                    <a href="tel:0577527520">(057) 752-752-0</a>
                    <a href="tel:0661312695">(066) 131-26-95</a>
                    <a href="tel:0636701423">(063) 670-14-23</a> 
                </div> 
            </div> 
        </header>

        <input class="open" id="top-box" type="checkbox" hidden="">
        <label class="btn" for="top-box" onclick="myFunction(this)"><span></span></label>
        <div class="top-panel">
            <div id="dataBar">
                @if(count($categorys))
                    <ul>
                        @for($i = 0; $i < count($categorys); $i++)
                            <li>
                                <a href="/category/{{ $categorys[$i]['slug'] }}" title="{{ $categorys[$i]['name'] }}"><img alt="{{ $categorys[$i]->image_alt }}" src="/images/categorys/{{ $categorys[$i]->image_name }}">{{ $categorys[$i]['name'] }}</a>
                            </li>
                        @endfor
                    </ul>
                @else
                    <h2>Категорий нет</h2>
                @endif
                </ul>
            </div>
        </div>
    </div>

    <!--U1CLEFTER1Z-->
    <div class="boxTable"></div>
    <div class="boxContent"></div>
    <!--/U1CLEFTER1Z-->

    <div id="contanier">
        <div id="wrap">
            <div id="content">
                <div id="textBlock">
                    <br>
                    <div class="price-date"><b>Цена на <span class="priceDate"></span></b></div>
        
                    @yield('content')
                    
                </div>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>
 
    <!--U1BFOOTER1Z-->
    <div id="footer">
        <div class="main-footer">
            <div class="footer-cont">Харьков ООО"СтройЭлемент" 2004©</div>
                <div class="mail">E-mail:stroyelement@list.ru</div>
            </div>
        </div>
        <!--/U1BFOOTER1Z-->
     
        <div class="call-box">
            <div class="ulightbox pulse-button"></div>
        </div>
        <a href="#" class="back-to-top"></a> 
    </div>
    <script>
        $(function(){
            $("#tel").mask("+38 (999) 999-99-99");
        }); 

        // open modal
        var wrap = $('#wrapper'),
            btn = $('.open-modal-btn'),
            modal = $('.cover, .modal, .content, .content2');

        btn.on('click', function() {
            modal.fadeIn();
        });
        
        // close modal
        $('.modal').click(function() {
            wrap.on('click', function(event) {
                var select = $('.content'), select2 = $('.content2');
                if ($(event.target).closest(select).length) return;
                modal.fadeOut();
                wrap.unbind('click');
            });
        });
    </script>
    <script src="{{ asset('js/easing.js') }}"></script>
    <!--<script src="{{ asset('js/script.js') }}"></script>-->
    <script src="{{ asset('js/script-2.js') }}"></script>
    <script src="{{ asset('js/jquery.maskedinput.js') }}"></script>
    <script src="{{ asset('js/main.js') }}?<?php echo time();?>"></script>

<div id="popUpForm" style="display:none;"> 
    <i class="far fa-times-circle fa-2x closePopUp" style="position: absolute; top: 5px; right: 5px; cursor:pointer;" title="Закрыть"></i>
    <table border="0" width="100%" id="table1" cellspacing="1" cellpadding="2">
        <tbody>
            <tr>
                <td width="35%">E-mail отправителя:</td>
                <td>
                    <input type="email" name="f1" value="">
                </td>
            </tr>
            <tr>
                <td>Имя <font color="red">*</font></td>
                <td><input type="text" name="f2"> </td>
            </tr>
            <tr>
                <td>Телефон <font color="red">*</font></td
                    ><td><input type="text" name="f3" id="tel"> </td>
                </tr>
            <tr>
                <td colspan="2" align="center"><br>
                    <button class="button to-cart" type="button" value="Отправить">Отправить</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<!-- 0.01949 (s16) -->
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
</body>
</html>