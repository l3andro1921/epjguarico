@extends("layouts.admin.layout")
@section('title', 'Eventos | Agenda')
@section('eventos', 'active')
@section('container-title', 'Eventos')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('eventos.index') }}">Eventos Registrados</a></li>
    <li class="breadcrumb-item active">Agenda del Evento</li>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="col-md-12">

                <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-warning">
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{{ asset('img/logo_movimiento.jpg') }}" alt="User Avatar">
                            {{--<span class="img-circle elevation-2"><i class="far fa-calendar-alt"></i></span>--}}
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">
                            {{ strtoupper($evento->nombre_evento) }}
                            <span class="float-right text-bold">AGENDA</span>
                        </h3>
                        <h5 class="widget-user-desc">{{ $evento->tipos->tipo_evento }}</h5>
                    </div>
                    {{--<div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item nav-link">
                                <span class="text-bold text-muted">Fecha Inicio:</span>
                                <span class="float-right text-success">{{ $carbon->parse($evento->fecha_inicio)->format('d-m-Y') }}</span>
                            </li>
                            <li class="nav-item nav-link">
                                <span class="text-bold text-muted">Fecha Final:</span>
                                <span class="float-right text-success">{{ $carbon->parse($evento->fecha_final)->format('d-m-Y') }}</span>
                            </li>
                            <li class="nav-item nav-link">
                                <span class="text-bold text-muted">Max Participantes:</span>
                                <span class="float-right text-success text-bold">{{ $evento->cupos }}</span>
                            </li>
                            <li class="nav-item nav-link">
                                <span class="text-bold text-muted">Miembros Invitados:</span>
                                <span class="float-right text-success text-bold">{{ $rangos->count() }}</span>
                            </li>
                            <li class="nav-item nav-link">
                                <span class="text-bold text-muted">Lugar:</span>
                                <span class="float-right text-success">{{ $evento->lugar_evento }}</span>
                            </li>


                            --}}{{--<li class="nav-item">
                                <a href="#" class="nav-link">
                                    Tasks <span class="float-right badge bg-info">5</span>
                                </a>
                            </li>--}}{{--
                        </ul>
                    </div>--}}
                </div>



            </div>

            <div class="col-md-12">


                {!! Form::open(['route' => 'agenda.store', 'method' => 'POST']) !!}

                <div class="row">
                    <div class="offset-3 col-md-6">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Agregar Mensaje</h3>

                                {{--<div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>--}}
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Exponente</label>
                                    {!! Form::select('datos_id', $miembros, null, ['class' => 'form-control chosen-select',
                                                      'placeholder' => 'Seleccione']) !!}
                                </div>
                                <div class="form-group">
                                    <label>Mensaje</label>
                                    {!! Form::textarea('mensaje', null, ['class' => 'form-control',
                                                        'placeholder' => 'Descripción', 'cols' => 30, 'rows' => 1]) !!}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                </div>

                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('agenda.show', $evento->id) }}" class="btn btn-secondary">Cancelar</a>
                        <input type="hidden" name="eventos_id" value="{{ $evento->id }}">
                        <input type="submit" value="Guardar" class="btn btn-success float-right">
                    </div>
                </div>
                <br>

                {!! Form::close() !!}



            </div>




        </div>
    </div>
@endsection

@section('script')
    <script>
        $('[data-mask]').inputmask();
        $(".chosen-select").chosen({
            no_results_text: "Sin Resultados para "
        });
    </script>
@endsection
