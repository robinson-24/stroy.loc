@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">
                @include('includes.nav')
            </div>
            
            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Редактирование категорию</div>

                    <div class="panel-body">

                        @if(isset($error))
                            <div class="alert alert-danger">{!! $error !!}</div>
                        @endif

                        @if(isset($success))
                            <div class="alert alert-success">{!! $success !!}</div>
                        @endif
                        <form action="/category/{{ $category[0]['id'] }}/save" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" value="{{ $category[0]['name'] }}" placeholder="название категории">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" id="intro_description" name="intro_description" placeholder="краткое описание категории">{{ $category[0]['intro_description'] }}</textarea>
                                <sub>Отображается на главной странице</sub>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" id="full_description" name="full_description" placeholder="полное описание категории">{{ $category[0]['full_description'] }}</textarea>
                                <sub>Отображается на странице категории после товаров</sub>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="title" value="{{ $category[0]['title'] }}" placeholder="title seo">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="description" value="{{ $category[0]['description'] }}" placeholder="description seo">
                            </div>

                            <div class="form-group">
                                @if(!empty($category[0]['image_name']))
                                    <i class="far fa-times-circle deleteImage" data-id="{{ $category[0]['id'] }}" title="Удалить"></i>
                                    <img src="/images/categorys/{{ $category[0]['image_name'] }}" alt="{{ $category[0]['image_alt'] }}" class="thumbnail" style="width: 100px;">
                                    
                                @else
                                    Логотип категории (100х100 рх)
                                    <input type="file" name="image" accept="image/*">
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="alt" placeholder="ALT картинки" value="{{ $category[0]['image_alt'] or '' }}">
                            </div>

                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="show" {{ ($category[0]['show']) ? 'checked' : '' }}>Отображать категорию
                                </label>
                            </div>
                            
                            <input type="submit" class="btn btn-primary" value="Сохранить" style="float:left; margin-right: 10px;">
                            
                        </form>
                        <form action="/category/{{ $category[0]['id'] }}/delete" method="post">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-warning" value="Удалить">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        /*CKEDITOR.replace( 'intro_description' );
        CKEDITOR.replace( 'full_description' );*/
    </script>
@endsection