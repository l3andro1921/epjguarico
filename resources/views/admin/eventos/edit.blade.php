@extends("layouts.admin.layout")
@section('title', 'Eventos | Nuevo')
@section('eventos', 'active')
@section('container-title', 'Eventos')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('eventos.index') }}">Eventos Registrados</a></li>
    <li class="breadcrumb-item active">Editar Evento</li>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            {!! Form::open(['route' => ['eventos.update', $evento->id], 'method' => 'PUT']) !!}

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Datos del Evento</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tipo de Evento</label>
                                {!! Form::select('tipos_id', $tipos, $evento->tipos_id, ['class' => 'form-control chosen-select',
                                                  'placeholder' => 'Seleccione']) !!}
                            </div>
                            <div class="form-group">
                                {{--<label>Estatus</label>--}}
                                {!! Form::select('status', ['Abierto' => 'Abierto', 'Cerrado' => 'Cerrado', 'Libre' => 'Libre'], $evento->status, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label>Nombre del Evento</label>
                                {!! Form::text('nombre_evento', $evento->nombre_evento, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                            </div>
                            <div class="form-group">
                                <label>Fecha de Inicio</label>
                                {!! Form::date('fecha_inicio', $evento->fecha_inicio, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label>Fecha de Final</label>
                                {!! Form::date('fecha_final', $evento->fecha_final, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                {!! Form::textarea('descripcion', $evento->descripcion, ['class' => 'form-control',
                                                    'placeholder' => 'Descripción', 'cols' => 30, 'rows' => 1]) !!}
                            </div>
                            <div class="form-group">
                                <label>Lugar del Evento</label>
                                {!! Form::textarea('lugar_evento', $evento->lugar_evento, ['class' => 'form-control',
                                                    'placeholder' => 'Lugar', 'cols' => 30, 'rows' => 1]) !!}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Monto y Disponibilidad</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="input-group">
                                <label class="col-md-12">Pago</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        @if($evento->pago != null )
                                            @php($pago = 'checked')
                                        @else
                                            @php($pago = null)
                                        @endif
                                        {!! Form::checkbox('pago', 'SI', $pago) !!}
                                    </span>
                                </div>
                                {!! Form::number('monto_pago', $evento->monto_pago, ['class' => 'form-control', 'placeholder' => 'Monto BsF.']) !!}
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Cupos</label>
                                {!! Form::number('cupos', $evento->cupos, ['class' => 'form-control', 'placeholder' => 'Max Participantes', 'required']) !!}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Team Miembros</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label>Coordinador</label>
                                {!! Form::select('id_coordinador', $miembros, $evento->id_coordinador, ['class' => 'form-control chosen-select', 'placeholder' => 'Seleccione']) !!}
                            </div>
                            <div class="form-group">
                                <label>Administrador</label>
                                {!! Form::select('id_administrador', $miembros, $evento->id_administrador, ['class' => 'form-control chosen-select', 'placeholder' => 'Seleccione']) !!}
                            </div>
                            <div class="form-group">
                                <label>Asesor</label>
                                {!! Form::select('id_asesor', $miembros, $evento->id_asesor, ['class' => 'form-control chosen-select', 'placeholder' => 'Seleccione']) !!}
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Cancelar</a>
                    {{--<input type="hidden" name="users_id" value="{{ $users_id }}">--}}
                    <input type="submit" value="Guardar" class="btn btn-primary float-right">
                </div>
            </div>
            <br>

            {!! Form::close() !!}




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
