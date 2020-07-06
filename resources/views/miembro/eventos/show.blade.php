@extends("layouts.miembro.layout")

@section('container-title')
    Bienvenido
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('mieventos.index') }}">Eventos</a></li>
    <li class="breadcrumb-item active">Ver Evento</li>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">



            <div class="row justify-content-center">
                <div class="col-md-12">



                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detalles del Evento</h3>

                            <div class="card-tools">
                                {{--<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>--}}
                                {{--<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fas fa-times"></i></button>--}}
                                {{--<a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-tool"><i class="fas fa-pencil-alt"></i></a>
                                --}}<a href="{{ route('mieventos.index') }}" class="btn btn-tool btn-sm">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Max. Participantes</span>
                                                    <span class="info-box-number text-center text-muted mb-0">{{ $evento->cupos }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Num. Inscritos</span>
                                                    <span class="info-box-number text-center text-muted mb-0">{{ $participantes->count() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Cupos Disponibles</span>
                                                    @php($dis = $evento->cupos - $participantes->count())
                                                    @if($dis < 1)
                                                        @php($boton = 'disabled')
                                                    @endif
                                                    <span class="info-box-number text-center text-muted mb-0">{{ $dis }}<span>
                    </span></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h4><span class="text-sm text-success text-bold">Lugar:</span> <strong class="text-muted">{{ ucfirst($evento->lugar_evento) }}</strong></h4>
                                            <h6>
                                                <span class="text-sm text-success text-bold">Fecha Inicio:</span> <strong class="text-muted">{{ $carbon->parse($evento->fecha_inicio)->format('d-m-Y') }}</strong>
                                                <span class="float-right">
                                            <span class="text-sm text-success text-bold">Fecha Final:</span> <strong class="text-muted">{{ $carbon->parse($evento->fecha_final)->format('d-m-Y') }}</strong>
                                        </span>
                                            </h6>
                                            {{--<h4>Fecha Final</h4>--}}
                                            <div class="post">
                                                {{--<div class="user-block">
                                                    <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                                    <span class="username">
                                  <a href="#">Jonathan Burke Jr.</a>
                                </span>
                                                    <span class="description">Shared publicly - 7:45 PM today</span>
                                                </div>
                                                <!-- /.user-block -->
                                                <p>
                                                    Lorem ipsum represents a long-held tradition for designers,
                                                    typographers and the like. Some people hate it and argue for
                                                    its demise, but others ignore.
                                                </p>

                                                <p>
                                                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a>
                                                </p>--}}
                                            </div>

                                            <div class="post clearfix row">
                                                <div class="col-md-6">
                                                    @if($img_coordinador)
                                                        @php($img_coordinador = 'img/users_img/'.$img_coordinador->nombre_imagen)
                                                    @else
                                                        @php($img_coordinador = 'img/user.jpg')
                                                    @endif

                                                    @if($img_administrador)
                                                        @php($img_administrador = 'img/users_img/'.$img_administrador->nombre_imagen)
                                                    @else
                                                        @php($img_administrador = 'img/user.jpg')
                                                    @endif

                                                    @if($img_asesor)
                                                        @php($img_asesor = 'img/users_img/'.$img_asesor->nombre_imagen)
                                                    @else
                                                        @php($img_asesor = 'img/user.jpg')
                                                    @endif

                                                    @if($coordinador)
                                                        <div class="user-block">
                                                            <img class="img-circle img-bordered-sm" src="{{ asset($img_coordinador) }}" alt="User Image">
                                                            <span class="username">
                                                      <a href="#">{{ $coordinador->nombre_completo }}</a>
                                                    </span>
                                                            <span class="description">Coordinador</span>
                                                        </div>
                                                        <!-- /.user-block -->
                                                    @endif
                                                    @if($administrador)
                                                        <div class="user-block">
                                                            <img class="img-circle img-bordered-sm" src="{{ asset($img_administrador) }}" alt="User Image">
                                                            <span class="username">
                                                      <a href="#">{{ $administrador->nombre_completo }}</a>
                                                    </span>
                                                            <span class="description">Administrador</span>
                                                        </div>
                                                        <!-- /.user-block -->
                                                    @endif
                                                    @if($asesor)
                                                        <div class="user-block">
                                                            <img class="img-circle img-bordered-sm" src="{{ asset($img_asesor) }}" alt="User Image">
                                                            <span class="username">
                                                      <a href="#">{{ $asesor->nombre_completo }}</a>
                                                    </span>
                                                            <span class="description">Asesor</span>
                                                        </div>
                                                        <!-- /.user-block -->
                                                    @endif
                                                </div>

                                                <div class="col-md-6">

                                                    @if($evento->pago == "SI")
                                                        <div class="col-sm-6">
                                                            <div class="info-box bg-lime">
                                                                <div class="info-box-content">
                                                                    <span class="info-box-text text-center text-muted">Costo:</span>
                                                                    <span class="info-box-number text-center text-muted mb-0">{{ number_format($evento->monto_pago, 2, ',', '.') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                </div>

                                                {{--<p>
                                                    Lorem ipsum represents a long-held tradition for designers,
                                                    typographers and the like. Some people hate it and argue for
                                                    its demise, but others ignore.
                                                </p>--}}
                                                {{--<p>
                                                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 2</a>
                                                </p>--}}

                                            </div>

                                            <div class="post clearfix text-center">
                                                <h4>Agenda del Evento</h4>
                                            </div>
                                            @foreach($rangos as $rango)
                                                <div class="post clearfix">
                                                    <div class="user-block">
                                                        @if($rango->img)
                                                            @php($img = 'img/users_img/'.$rango->img->nombre_imagen)
                                                        @else
                                                            @php($img = 'img/user.jpg')
                                                        @endif
                                                        <img class="img-circle img-bordered-sm" src="{{ asset($img) }}" alt="user image">
                                                        <span class="username">
                                              <a href="#">{{ $rango->nombre_completo }}</a>
                                            </span>
                                                        <span class="description">{{ $rango->tipo }}</span>
                                                    </div>
                                                    <!-- /.user-block -->
                                                    <p>
                                                        {{ $rango->mensaje }}
                                                    </p>

                                                    {{--<p>
                                                        <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v1</a>
                                                    </p>--}}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                                    <h3 class="text-primary"><i class="far fa-flag"></i> {{ strtoupper($evento->nombre_evento) }}</h3>
                                    <p class="text-muted">{{ $evento->descripcion }}</p>
                                    <br>
                                    <div class="text-muted">
                                        <p class="text-sm">Tipo de Evento
                                            <b class="d-block">{{ $evento->tipos->tipo_evento }}</b>
                                        </p>
                                        <p class="text-sm">Status
                                            <b class="d-block">{{ $evento->status }}</b>
                                        </p>
                                    </div>

                                    <h5 class="mt-5 text-muted">
                                        Lista de Inscritos
                                        {{--<span class="small float-right">
                                            <a href="#" data-toggle="modal" data-target="#modal-sm-in">
                                                <i class="fas fa-user-plus"></i>
                                            </a>
                                        </span>--}}
                                    </h5>

                                    <ul class="list-unstyled">
                                        @foreach($participantes as $participante)
                                            @if($participante->datos_id == $datos->id)
                                                @php($boton = "disabled")
                                            @endif
                                            <li>
                                                <a href="#" class="btn-link text-secondary badge" data-toggle="modal" data-target="#modal-sm{{ $participante->id }}">
                                                    <i class="far fa-fw fa-user"></i>
                                                    {{ $participante->nombre_completo }}
                                                    @if($participante->asistencia == "SI")
                                                        @php($asistencia = '<span class="text-success">( <i class="far fa-thumbs-up"></i>)</span>')
                                                    @else
                                                        @php($asistencia = '<span class="text-danger">( <i class="far fa-thumbs-down"></i>)</span>')
                                                    @endif

                                                    @if($evento->fecha_inicio < date('Y-m-d') && $evento->fecha_final < date('Y-m-d'))
                                                        {!! $asistencia !!}
                                                    @endif
                                                </a>
                                            </li>





                                            <div class="modal fade" id="modal-sm{{ $participante->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        {{--<div class="modal-header">
                                                            <h4 class="modal-title">Agregar Miembros</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>--}}
                                                        <div class="modal-body">

                                                            <div class="card card-widget widget-user-2">
                                                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                                                <div class="widget-user-header bg-success">
                                                                    <div class="widget-user-image">
                                                                        @if($participante->img)
                                                                            @php($img_par = 'img/users_img/'.$participante->img->nombre_imagen)
                                                                        @else
                                                                            @php($img_par = 'img/user.jpg')
                                                                        @endif
                                                                        <img class="img-circle elevation-2" src="{{ asset($img_par) }}" alt="User Avatar">
                                                                    </div>
                                                                    <!-- /.widget-user-image -->
                                                                    <h3 class="widget-user-username">{{ $participante->nombre_completo }}</h3>
                                                                    <h5 class="widget-user-desc">{{ $participante->cedula }}</h5>
                                                                </div>
                                                                <div class="card-footer p-0">
                                                                    <ul class="nav flex-column">
                                                                        <li class="nav-item nav-link">
                                                                            <span class="text-bold text-muted">Edad:</span>
                                                                            <span class="float-right text-success">(29 años)</span>
                                                                        </li>
                                                                        {{--<li class="nav-item nav-link">
                                                                            <span class="text-bold text-muted">Tipo Miembro:</span>
                                                                            <span class="float-right text-success">{{ $rango->tipo }}</span>
                                                                        </li>--}}
                                                                        <li class="nav-item nav-link">
                                                                            <span class="text-bold text-muted">Telefono:</span>
                                                                            <span class="float-right text-success">{{ $participante->telefono }}</span>
                                                                        </li>
                                                                        <li class="nav-item nav-link">
                                                                            <span class="text-bold text-muted">Sexo:</span>
                                                                            <span class="float-right text-success">{{ $participante->sexo }}</span>
                                                                        </li>
                                                                        <li class="nav-item nav-link">
                                                                            <span class="text-bold text-muted">Parroquia:</span>
                                                                            <span class="float-right text-success">{{ $participante->parroquia }}</span>
                                                                        </li>
                                                                        <li class="nav-item nav-link">
                                                                            <span class="text-bold text-muted">Arquidiosesis:</span>
                                                                            <span class="float-right text-success">{{ $participante->arquidiosesis }}</span>
                                                                        </li>



                                                                        {{--<li class="nav-item">
                                                                            <a href="#" class="nav-link">
                                                                                Tasks <span class="float-right badge bg-info">5</span>
                                                                            </a>
                                                                        </li>--}}
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="text-right">
                                                                {!! Form::open(['route' => ['mieventos.destroy', $participante->id], 'method' => 'DELETE']) !!}

                                                                @if($participante->datos_id == Auth::user()->id)
                                                                <div class="btn-group float-left">
                                                                    <button type="submit" onclick="return confirm('Cancelar Inscripcion {{ $participante->nombre_completo }}')" class="btn btn-default btn-sm text-danger" title="Eliminar">
                                                                        <i class="far fa-trash-alt"></i></button>
                                                                </div>
                                                                @endif

                                                                {!! Form::close() !!}
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                                {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                                                            </div>

                                                        </div>
                                                        {{--<div class="modal-footer text-right">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                            --}}{{--<button type="button" class="btn btn-primary">Save changes</button>--}}{{--
                                                        </div>--}}
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->




                                        @endforeach
                                    </ul>

                                    <div class="text-center mt-5 mb-3">
                                       {{-- @if($evento->status == "Cerrado")
                                            <a href="{{ route('eventos.cerrado.show', $evento->id) }}" class="btn btn-sm btn-primary">
                                                Invitados
                                            </a>
                                        @endif--}}
                                        {{--<a href="{{ route('agenda.show', $evento->id) }}" class="btn btn-sm btn-warning">Agenda</a>--}}
                                        {{--@if($evento->fecha_inicio < date('Y-m-d') && $evento->fecha_final < date('Y-m-d'))
                                            <a href="{{ route('eventos.asistencia.show', $evento->id) }}" class="btn btn-sm btn-success">Asistencia</a>
                                        @endif--}}
                                        @php($verificar = null)
                                        @if($evento->fecha_inicio < date('Y-m-d') && $evento->fecha_final < date('Y-m-d'))
                                            @php($verificar = '<span class="text-danger text-bold">(Culminado)</span>')
                                            @php($boton = "disabled")
                                        @endif
                                        @if($evento->fecha_inicio < date('Y-m-d') && $evento->fecha_final >= date('Y-m-d'))
                                            @php($verificar = '<span class="text-primary text-bold">(En Desarrollo...)</span>')
                                            @php($boton = "disabled")
                                        @endif

                                        {!! Form::open(['route' => 'mieventos.store', 'method' => 'POST', 'role' => 'form']) !!}
                                        {{--<a href="{{ route('agenda.show', $evento->id) }}" class="btn btn-sm btn-warning {{ $boton }}">
                                            <i class="fas fa-user-plus"></i> Participar
                                        </a>--}}
                                        <input type="hidden" name="id" value="{{ $evento->id }}">
                                        <input type="hidden" name="datos_id" value="{{ $datos->id }}">
                                        <button type="submit" class="btn btn-sm btn-warning" {{ $boton }} onclick="return confirm('Confirmar Inscripcion')">
                                            <i class="fas fa-user-plus"></i> Participar
                                        </button>
                                        {!! Form::close() !!}

                                        <ul class="list-unstyled">
                                            <li class="text-danger text-center small">{!! $mensaje !!}</li>
                                            <li class="text-center small">
                                                {!! $verificar !!}
                                            </li>
                                        </ul>

                                    </div>

                                    @if($evento->fecha_inicio < date('Y-m-d') && $evento->fecha_final < date('Y-m-d'))
                                    <ul class="list-unstyled">
                                        <li>
                                            <span class="text-success small">( <i class="far fa-thumbs-up"></i>) = Asistio al Evento</span>
                                        </li>
                                        <li>
                                            <span class="text-danger small">( <i class="far fa-thumbs-down"></i>) = No estuvo Presente</span>
                                        </li>
                                    </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>



                </div>

            </div>



        </div>

    </div>

@endsection

@section('script')
    <script>
        function readImage (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result); // Renderizamos la imagen
                    $('#blah').attr('class', 'img-thumbnail');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function () {
            // Código a ejecutar cuando se detecta un cambio de archivO
            readImage(this);
        });
    </script>
@endsection
