@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">
                @include('includes.nav')
            </div>
            
            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">SEO главная страница</div>

                    <div class="panel-body">

                        @if(isset($error))
                            <div class="alert alert-danger">{!! $error !!}</div>
                        @endif

                        @if(isset($success))
                            <div class="alert alert-success">{!! $success !!}</div>
                        @endif
                        <form action="/setting/home" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <input type="text" class="form-control" name="title" value="{{ $title or '' }}" placeholder="title seo">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="description" value="{{ $description or '' }}" placeholder="description seo">
                            </div>

                            <input type="submit" class="btn btn-primary" value="Сохранить">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection