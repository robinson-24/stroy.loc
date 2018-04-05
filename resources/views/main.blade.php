@extends('welcome')

@section('content')

    <p>"СтройЭлемент"- надёжный партнёр на рынке строительных материалов г. Харькова</p>

    <p>
        <strong>"Строй Элемент"</strong>открывает вам возможность приобрести
        качественные стройматериалы в Харькове по оптимальной цене. Основами
        наших материалов без которых, в сущности, невозможен сам процесс
        строительства и возведения зданий относятся: кирпич, песок, бетон,
        щебень, пеноблок, шлакоблок, керамзит. Все строительные материалы
        сертифицированы и доставляются заказчику в кротчайшие сроки и в любых
        объемах
    </p>
    <h1>Строительные Материалы:</h1>

    <div class="home-page-nav">
        @if(count($categorys))
            <ul>
                @for($i = 0; $i < count($categorys); $i++)
                    <li class="col-xs-12 col-sm-6">
                        <a href="/categorys/{{ $categorys[$i]['slug'] }}" title="{{ $categorys[$i]['slug'] }}">
                            <img src="/images/categorys/{{ $categorys[$i]['image_name'] }}" alt="{{ $categorys[$i]['image_alt'] }}">
                            <p>{{ $categorys[$i]['name'] }}</p>
                        </a>
                        <p>{{ $categorys[$i]['intro_description'] }}</p>
                    </li>
                @endfor
            </ul>
        @endif
    </div>
@endsection