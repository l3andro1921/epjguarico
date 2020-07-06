@extends("layouts.admin.layout")
@section('title', 'Miembros')
@section('miembros', 'active')
@section('container-title', 'Miembros')
@section('breadcrumb', '')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card card-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-success">
                    <div class="widget-user-image">
                        @if($user_imagen)
                            @php($foto = 'img/users_img/'.$user_imagen->nombre_imagen)
                        @else
                            @php($foto = 'img/user.jpg')
                        @endif
                        <img class="img-circle elevation-2" src="{{ asset($foto) }}" alt="User Avatar">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">{{ $datos->nombre_completo }}</h3>
                    <h5 class="widget-user-desc">{{ $datos->cedula }}</h5>
                </div>
                <div class="card-footer p-0">
                    <ul class="nav flex-column">
                        <li class="nav-item nav-link">
                            <span class="text-bold text-muted">Edad:</span>
                            <span class="float-right text-success">{{ $datos->users->id }}</span>
                        </li>
                        <li class="nav-item nav-link">
                            <span class="text-bold text-muted">Telefono:</span>
                            <span class="float-right text-success">{{ $datos->telefono }}</span>
                        </li>
                        <li class="nav-item nav-link">
                            <span class="text-bold text-muted">Sexo:</span>
                            <span class="float-right text-success">{{ $datos->sexo }}</span>
                        </li>
                        <li class="nav-item nav-link">
                            <span class="text-bold text-muted">Parroquia:</span>
                            <span class="float-right text-success">{{ $datos->parroquia }}</span>
                        </li>
                        <li class="nav-item nav-link">
                            <span class="text-bold text-muted">Arquidiosesis:</span>
                            <span class="float-right text-success">{{ $datos->arquidiosesis }}</span>
                        </li>



                        {{--<li class="nav-item">
                            <a href="#" class="nav-link">
                                Tasks <span class="float-right badge bg-info">5</span>
                            </a>
                        </li>--}}
                    </ul>
                </div>
            </div>



        </div>

        <div class="col-md-3">


            <!-- general form elements -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Nuevo Miembro</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'miembros.store', 'method' => 'POST', 'role' => 'form']) !!}
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Tipo de Miembro</label>
                        {!! Form::select('tipos_id', $tipos, null, ['class' => 'form-control', 'placeholder' => 'Seleccione', 'required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="name">Comunidad</label>
                        {!! Form::select('comunidades_id', $comunidades, null, ['class' => 'form-control chosen-select', 'placeholder' => 'Seleccione', 'required']) !!}
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer text-right">
                    <a href="{{ route('miembros.index') }}" class="btn btn-secondary">Cancelar</a>
                    <input type="hidden" name="fecha" value="{{ date('Y-m-d') }}">
                    <input type="hidden" name="datos_id" value="{{ $datos->id }}">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.card -->

        </div>


    </div>

@endsection

@section('script')
    {{--<script>
        jQuery(document).ready(function($) {
            $('a[data-rel^=lightcase]').lightcase();
        });

    </script>--}}
    <script>
        $('[data-mask]').inputmask();
        $(".chosen-select").chosen({
            no_results_text: "Sin Resultados para "
        });
    </script>
@endsection


