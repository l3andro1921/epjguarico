@extends('layouts.admin.layout')
@section('title', 'Inicio')
@section('container-title', 'Inicio')
@section('breadcrumb', '')

@section('buscar')
    <form class="form-inline ml-3" action="/contactos">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="text" name="buscar" placeholder="Buscar Nombre" aria-label="Buscar" required>
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="far fa-bookmark"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Noticias</span>
                        <span class="info-box-number">
                            {{ $cnoticias }}
                  {{--<small>%</small>--}}
                </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="far fa-calendar-alt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Eventos</span>
                        <span class="info-box-number">{{ $ceventos }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Usuarios</span>
                        <span class="info-box-number">{{ $cusuarios }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-chart-pie"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Miembros</span>
                        <span class="info-box-number">{{ $cmiembros }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Bienvenid@
                        <div class="card-tools">
                            {{--<a href="{{ route('excel.pedidos') }}" class="btn btn-tool btn-sm">
                                <i class="fas fa-download"></i>
                            </a>--}}
                            {{--<a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-sm">
                                <i class="fas fa-cart-plus"></i>
                            </a>--}}
                            {{--<a href="#" class="btn btn-tool btn-sm">
                                <i class="fas fa-cog"></i>
                            </a>--}}
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <br>
                                <p>Nombre: <strong>{{ ucwords(auth()->user()->name) }}</strong></p>
                                <p>Correo: <strong>{{ auth()->user()->email }}</strong></p>
                            </div>
                            <div class="col-lg-4">

                            <img class="img-thumbnail" src="{{ asset('img/users_img/'.$imagen->nombre_imagen) }}" alt="Entrar">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- USERS LIST -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ultimos Usuarios</h3>

                        <div class="card-tools">
                            {{--<span class="badge badge-danger">8 New Members</span>--}}
                            {{--<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                            </button>--}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <ul class="users-list clearfix">
                            @foreach($usuarios as $usuario)
                                @if($usuario->imagen)
                                    @php($foto = asset('img/users_img/'.$usuario->imagen->nombre_imagen))
                                    @else
                                    @php($foto = asset('img/user.jpg'))
                                @endif
                            <li>
                                <img src="{{ $foto }}" class="img-thumbnail" alt="User Image">
                                <a class="users-list-name" href="/contactos?buscar={{ $usuario->name }}">{{ ucwords($usuario->name) }}</a>
                                <span class="users-list-date">{{ $carbon->parse($usuario->created_at)->diffForHumans() }}</span>
                            </li>
                            @endforeach
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                        <a href="{{ route('usuarios.index') }}">Ver todos los Usuarios</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!--/.card -->
            </div>

        </div>
    </div>
@endsection

