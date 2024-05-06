@extends('admin.layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить продукт</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index.welcome') }}">Home</a></li>
                        <li class="breadcrumb-item active">Главная страница</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Название</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Название товара" required>
                    </div>

                    <!-- Поле для описания товара -->
                    <div class="form-group">
                        <label for="title">Описание</label>
                        <textarea class="form-control" id="title" name="title" placeholder="Описание товара"></textarea>
                    </div>

                    <!-- Поле для загрузки изображения товара -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name = "product_image" type="file" class="custom-file-input"
                                    id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите изображение</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузка</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price">Количество</label>
                        <input type="number" class="form-control" id="count" name="count" placeholder="Количество"
                            required>
                    </div>
                    <!-- Поле для цены товара -->
                    <div class="form-group">
                        <label for="price">Цена</label>
                        <input type="number" step="any" class="form-control" id="price" name="price"
                            placeholder="Цена" required>
                    </div>
                    {{-- <div class="form-group">
                        <select name = "tags []" class="tags" multiple="multiple" data-placeholder="Выберите тег"
                            style="width: 100%;">
                            @foreach ($tags as $tag)
                                <option value="{{$tag ->id}}">{{$tag->title}}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <select name="category_id" class="form-control">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                            </option>
                            @endforeach
                           </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Добавить">
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
