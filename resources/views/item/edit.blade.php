@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">
                @include('includes.nav')
            </div>
            
            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Редактирование товара</div>

                    <div class="panel-body">

                        @if(isset($error))
                            <div class="alert alert-danger">{!! $error !!}</div>
                        @endif

                        @if(isset($success))
                            <div class="alert alert-success">{!! $success !!}</div>
                        @endif
                        <form action="/items/{{ $items[0]['id'] }}/save" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <select name="category" id="category" class="form-control">
                                    @for($i = 0; $i < count($category); $i++)
                                        <option value="{{ $category[$i]->id  }}" {{ ($category[$i]->id == $items[0]['category_id']) ? 'selected' : '' }}>{{ $category[$i]->name }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="name" value="{{ $items[0]['name'] }}" placeholder="название товара">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" id="characteristics" name="characteristics" placeholder="характеристика товара">{{ $items[0]['characteristics'] }}</textarea>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="title" value="{{ $items[0]['title'] }}" placeholder="title seo">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="price" value="{{ $items[0]['price'] }}" placeholder="цена">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="description" value="{{ $items[0]['description'] }}" placeholder="description seo">
                            </div>

                            <div class="form-group">
                                @if(!empty($items[0]['image_name']))
                                    <i class="far fa-times-circle deleteImageItem" data-id="{{ $items[0]['id'] }}" title="Удалить"></i>
                                    <img src="/images/items/{{ $items[0]['image_name'] }}" alt="{{ $items[0]['image_alt'] }}" class="thumbnail" style="width: 100px;">
                                @else
                                    Логотип товара
                                    <input type="file" name="image" accept="image/*">
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="text" name="alt" class="form-control" value="{{ $items[0]['image_alt'] }}" placeholder="ALT картинки">
                            </div>

                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="show" {{ ($items[0]['show']) ? 'checked' : '' }}>Отображать товар
                                </label>
                            </div>

                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="existence" {{ ($items[0]['existence']) ? 'checked' : '' }}>В наличии
                                </label>
                            </div>
                            
                            <input type="submit" class="btn btn-primary" value="Сохранить" style="float:left; margin-right: 10px;">
                            
                        </form>
                        <form action="/items/{{ $items[0]['id'] }}/delete" method="post">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-warning" value="Удалить">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        /*CKEDITOR.replace( 'characteristics' );*/
    </script>
@endsection