@extends("layouts.admin.layout")
@section('title', 'Eventos | Configuración')
@section('configuracion', 'active')
@section('container-title', 'Configuración')
@section('breadcrumb', '')

@section('buscar')
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="text" placeholder="Buscar Comunidad" aria-label="Buscar" required>
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-4">



            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Tipos de Eventos</h3>
                    <div class="card-tools">
                        {{--<a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </a>--}}
                        {{--<a href="{{ route('miembros.create') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-user-plus"></i>
                        </a>--}}
                        <a href="{{ route('iglesias.create') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-cog"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <table class="table table-hover table-valign-middle table-sm table-bordered table-responsive-sm">
                            <thead class="thead-dark">
                            <tr class="text-center">
                                <th>Tipos</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tipos as $tipo)

                                <tr class="text-center table-primary text-sm">
                                    <td class="text-center">
                                        {{ strtoupper($tipo->tipo_evento) }}
                                    </td>
                                    <td style="width: 10px">
                                        {!! Form::open(['route' => ['configuracion.destroy', $tipo->id], 'method' => 'DELETE']) !!}
                                        <div class="btn-group">
                                            <a href="{{ route('configuracion.show', $tipo->id) }}" class="btn btn-default btn-sm text-info" title="Ver">
                                                <i class="fas fa-eye"></i></a>
                                            <a href="{{ route('configuracion.edit', $tipo->id) }}" class="btn btn-default btn-sm text-warning" title="Editar">
                                                <i class="fas fa-pencil-alt"></i></a>
                                            <button type="submit" onclick="return confirm('Desea Eliminar {{ strtoupper($tipo->tipo_evento) }}')" class="btn btn-default btn-sm text-danger" title="Eliminar">
                                                <i class="far fa-trash-alt"></i></button>
                                        </div>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--<div class="row text-sm justify-content-end">
                        {!! $datos->render() !!}
                    </div>--}}
                </div>
            </div>



        </div>

        <div class="offset-1 col-md-5">


            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Editar Tipo de Evento</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {!! Form::open(['route' => ['configuracion.update', $actual->id], 'method' => 'PUT', 'role' => 'form']) !!}
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Tipo de Evento</label>
                        {!! Form::text('tipo_evento', $actual->tipo_evento, ['class' => 'form-control', 'placeholder' => __('Name'), 'required']) !!}
                    </div>
                    {{--<div class="form-group">
                        <label for="name">Tipo de Miembro Permitido</label>
                        {!! Form::select('miembros_tipos_id', $miembros, null,
                                                     ['class' => 'form-control', 'placeholder' => 'Seleccione']) !!}
                    </div>--}}
                </div>
                <!-- /.card-body -->

                <div class="card-footer text-right">
                    <a href="{{ route('configuracion.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.card -->



        </div>
    </div>
@endsection

@section('script')

@endsection


