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
                                <li class="breadcrumb-item"><a href="{{route('index.welcome')}}">Home</a></li>
                                <li class="breadcrumb-item active">Главная страница</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex p-3">
                                    <div class="mr-3">
                                        <a href="{{route('products.edit', $product->id)}}" class="btn btn-secondary">Редактировать</a>
                                    </div>

                                    <form action="{{route('products.destroy', $product->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                        <input type="submit" class="btn btn-danger" value="УНИЧТОЖИТЬ">
                                    </form>
                                </div>

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <tbody>
                                            <tr>
                                                <td>ID</td>
                                                <td>{{$product->id}}</td>
                                            </tr>
                                            <tr>
                                                <td>Наименование</td>
                                                <td>{{$product->name}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
@endsection
