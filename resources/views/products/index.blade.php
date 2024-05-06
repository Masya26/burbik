@extends('admin.layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Продукты</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                        <li class="breadcrumb-item active">Главная страница</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                           <a href="{{route('products.create')}}" class="btn btn-primary">Добавить</a>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Наименование</th>
                                        <th>ID Категории</th>
                                        <th>Категория</th>
                                        <th>Изображение</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if (isset($products))
                                @foreach ($products as $product)


                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td><a href="{{route('products.show', $product->id)}}">{{$product->name}}</a></td>
                                        <td>{{$product->category_id}}</td>
                                        <td>{{$product->category->title}}</td>
                                        <td>
                                            <img style="width:150px; height:150px;"
                                                src="{{ asset('storage/images/product/' . $product->product_image) }}" alt=""> <br>
                                        </td>
                                    </tr>

                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
