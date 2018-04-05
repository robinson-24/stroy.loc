@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">
                @include('includes.nav')
            </div>
            
            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Заказы</div>

                    <div class="panel-body">
                        <table class="table table-responsive">
                            <thead>
                                <tr class="text-center">
                                    <td>#</td>
                                    <td>Имя</td>
                                    <td>Телефон</td>
                                    <td>Дата</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($orders))
                                    @for($i = 0; $i < count($orders); $i++)
                                        <tr class="{{ (!$orders[$i]->visit) ? 'noVisit' : '' }} text-center" data-id="{{ $orders[$i]->id }}">
                                            <td>{{ $i+1 }}</td>
                                            <td>{{ $orders[$i]->name }}</td>
                                            <td>{{ $orders[$i]->tel }}</td>
                                            <td>{{ $orders[$i]->created_at }}</td>
                                        </tr>
                                    @endfor
                                @else
                                    <tr>
                                        <td colspan="4">
                                            <div class="alert alert-info text-center">Заказов нету</div>
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