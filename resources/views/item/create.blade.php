@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">
                @include('includes.nav')
            </div>
            
            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Создать товар</div>

                    <div class="panel-body">

                        @if(isset($error))
                            <div class="alert alert-danger">{!! $error !!}</div>
                        @endif

                        @if(isset($success))
                            <div class="alert alert-success">{!! $success !!}</div>
                        @endif

                        <form action="{{ route('item.postCreate') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <select name="category" id="category" class="form-control">
                                    @for($i = 0; $i < count($category); $i++)
                                        <option value="{{ $category[$i]->id }}">{{ $category[$i]->name }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" value="" placeholder="название товара">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" id="characteristics" name="characteristics" placeholder="характеристика товара"></textarea>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="title" placeholder="title seo">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="price" placeholder="цена">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="description" placeholder="description seo">
                            </div>

                            <div class="form-group">
                                Логотип товара
                                <input type="file" name="image" accept="image/*">
                            </div>

                            <div class="form-group">
                                <input type="text" name="alt" class="form-control" placeholder="ALT картинки">
                            </div>

                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="show" checked>Отображать товар
                                </label>
                            </div>

                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="existence" checked>В наличии
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
        /*CKEDITOR.replace( 'characteristics' );*/
    </script>
@endsection