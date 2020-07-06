@extends("layouts.admin.layout")
@section('title', 'Miembros')
@section('miembros', 'active')
@section('container-title', 'Miembros')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('miembros.index') }}">Miembros Registrados</a></li>
    <li class="breadcrumb-item active">Editar Tipo Miembro</li>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-3">



            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Editar Tipo Miembro</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {!! Form::open(['route' => ['miembros_tipos.update', $actual->id], 'method' => 'PUT', 'role' => 'form']) !!}
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">{{ __('Name') }} Tipo</label>
                        {!! Form::text('tipo_miembro', $actual->tipo_miembro, ['class' => 'form-control', 'placeholder' => __('Name'), 'required']) !!}
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer text-right">
                    <a href="{{ route('miembros.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.card -->



        </div>

        <div class="col-md-3">


            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Tipos de Miembro</h3>
                    <div class="card-tools">
                        {{--<a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </a>--}}
                        {{--<a href="{{ route('miembros.create') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-user-plus"></i>
                        </a>--}}
                        <a href="{{ route('miembros_tipos.create') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-cog"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <table class="table table-hover table-valign-middle table-sm table-bordered table-responsive-sm">
                            <thead class="thead-dark">
                            <tr class="text-center">
                                <th>Tipo</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tipos as $tipo)

                                <tr class="text-center table-primary text-sm">
                                    <td class="text-center">
                                        {{ strtoupper($tipo->tipo_miembro) }}
                                    </td>
                                    <td style="width: 10px">
                                        {!! Form::open(['route' => ['iglesias.destroy', $tipo->id], 'method' => 'DELETE']) !!}
                                        <div class="btn-group">
                                            {{--<a href="{{ route('iglesias.show', $iglesia->id) }}" class="btn btn-default btn-sm text-info" title="Ver">
                                                <i class="fas fa-eye"></i></a>--}}
                                            <a href="{{ route('miembros_tipos.edit', $tipo->id) }}" class="btn btn-default btn-sm text-warning" title="Editar">
                                                <i class="fas fa-pencil-alt"></i></a>
                                            {{--<button type="submit" onclick="return confirm('Desea Eliminar la Iglesia {{ strtoupper($tipo->tipo_nombre) }}')" class="btn btn-default btn-sm text-danger" title="Eliminar">
                                                <i class="far fa-trash-alt"></i></button>--}}
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


    </div>
@endsection

@section('script')

@endsection


