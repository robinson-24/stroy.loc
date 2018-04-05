@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">
                @include('includes.nav')
            </div>
            
            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Категории</div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <td>id</td>
                                    <td>Имя</td>
                                    <td>Логотип</td>
                                    <td>Показ</td>
                                    <td>Действие</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($categorys) > 0)
                                    @for($i = 0; $i < count($categorys); $i++)
                                        <tr>
                                            <td class="text-center">
                                                {{ $categorys[$i]->id }}
                                            </td>
                                            <td>
                                                <a href="{{ url($categorys[$i]->slug) }}">{{ $categorys[$i]->name }}</a>
                                            </td>
                                            <td>
                                                <img src="/images/categorys/{{ $categorys[$i]->image_name }}" alt="{{ $categorys[$i]->image_alt }}" style="width: 100px">
                                            </td>
                                            <td class="text-center">
                                                {!! $categorys[$i]->show ? '<i class="fas fa-eye" title="Видима"></i>' : '<i class="fas fa-eye-slash" title="Скрыта"></i>' !!}
                                            </td>
                                            <td class="text-center">
                                                <a href="/category/{{ $categorys[$i]->id }}/edit"><i class="fas fa-edit" style="color:green;" title="Редактировать"></i></a>
                                            </td>
                                        </tr>
                                    @endfor
                                @else
                                    <tr>
                                        <td colspan="5">
                                            <div class="alert alert-info text-center">Нету категорий</div>
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