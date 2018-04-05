@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">
                @include('includes.nav')
            </div>
            
            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Создать категорию</div>

                    <div class="panel-body">

                        @if(isset($error))
                            <div class="alert alert-danger">{!! $error !!}</div>
                        @endif

                        @if(isset($success))
                            <div class="alert alert-success">{!! $success !!}</div>
                        @endif
                        <form action="{{ route('category.postCreate') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" value="" placeholder="название категории">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" id="intro_description" name="intro_description" rows="10" cols="80" placeholder="краткое описание категории"></textarea>
                                <sub>Отображается на главной странице</sub>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" id="full_description" name="full_description" rows="10" cols="80" placeholder="полное описание категории"></textarea>
                                <sub>Отображается на странице категории после товаров</sub>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="title" placeholder="title seo">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="description" placeholder="description seo">
                            </div>

                            <div class="form-group">
                                Логотип категории (100х100 рх)
                                <input type="file" name="image" accept="image/*">
                            </div>

                            <div class="form-group">
                                <input type="text" name="alt" class="form-control" placeholder="ALT картинки">
                            </div>

                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="show" checked>Отображать категорию
                                </label>
                            </div>
                            
                            <input type="submit" class="btn btn-primary" value="Создать">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        CKEDITOR.replace('intro_description');
        CKEDITOR.replace('full_description');
    </script>

@endsection