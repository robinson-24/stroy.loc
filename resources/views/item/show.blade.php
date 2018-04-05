@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">
                @include('includes.nav')
            </div>
            
            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Товары</div>

                    <div class="panel-body">

                        <table class="table table-responsive">
                            <thead>
                                <tr class="text-center">
                                    <td>id</td>
                                    <td>Категория</td>
                                    <td>Логотип</td>
                                    <td>Имя</td>
                                    <td>Цена</td>
                                    <td>Показ</td>
                                    <td>Наличие</td>
                                    <td>Действие</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($items))
                                    @for($i = 0; $i < count($items); $i++)
                                        <tr>
                                            <td>{{ $items[$i]->id }}</td>
                                            <td>{{ $items[$i]->category }}</td>
                                            <td><img src="/images/items/{{ $items[$i]->image_name }}" alt="{{ $items[$i]->image_alt }}" style="height: 200px;"></td>
                                            <td>{{ $items[$i]->name }}</td>
                                            <td>{{ number_format( (float) $items[$i]->price, 2) }}</td>
                                            <td>{!! $items[$i]->show ? '<i class="fas fa-eye" title="Видима"></i>' : '<i class="fas fa-eye-slash" title="Скрыта"></i>' !!}</td>
                                            <td>{!! $items[$i]->existence ? '<span style="color: green;">В наличии</span>' : '<span style="color: red;">Нет в наличии</span>' !!}</td>
                                            <td><a href="/items/{{ $items[$i]->id }}/edit"><i class="fas fa-edit" style="color:green;" title="Редактировать"></i></a></td>
                                        </tr>
                                    @endfor
                                @else
                                    <tr>
                                        <td colspan="8">
                                            <div class="alert alert-info text-center">Нету товаров</div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection