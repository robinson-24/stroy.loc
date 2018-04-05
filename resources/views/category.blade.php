@extends('welcome')

@section('content')

    <h1>{{ $category['name'] }}</h1>

    <div id="textBlock">

        @if(count($items))
            <div class="wrapper">
                <ul class="products clearfix">
                    <li class="product-wrapper">
                        <div class="product">
                            <div class="product-main">
                                <div class="product-photo">
                                    <img src="/images/items/43.jpg" alt="Кирпич самосвалом">
                                </div>
                                <div class="product-text">
                                    <h4 class="produvt-name">Кирпич навалом</h4>
                                    <table style="width: 100%;" border="0">
                                        <tbody>
                                            <tr>
                                                <td class="namecolumn">Производитель:</td>
                                                <td>Куряж</td>
                                            </tr>
                                            <tr>
                                                <td class="namecolumn">Размер:</td>
                                                <td>250*120*88 мм.</td>
                                            </tr>
                                            <tr>
                                                <td class="namecolumn">Кол. в клетке</td>
                                                <td>704 шт.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="product-icons"></div>
                                </div>
                            </div>
                            <div class="product-details-wrap"> 
                                <div class="product-details">
                                    <div class="product-availability"><span class="icon icon-check"></span>В наличии</div>
                                    <span class="product-price product-price-old">
                                        <b>2550</b>
                                        <small>грн.</small>
                                    </span>
                                    <span class="product-price">
                                        <b>2490</b>
                                        <small>грн.м3</small>
                                    </span>
                                </div>
                                <div class="product-buttons-wrap">
                                    <div class="buttons">
                                        <div class="ulightbox oneClick"><span class="button">Купить в 1 клик</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        @else
            <div class="alert-info">Товара в данной категории еще нет</div>
        @endif

        {!! $category['full_description'] !!}
    </div>

@endsection