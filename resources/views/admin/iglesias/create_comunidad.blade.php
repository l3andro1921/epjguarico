@extends("layouts.admin.layout")
@section('title', 'Iglesias & Comunidades')
@section('iglesias', 'active')
@section('container-title', 'Iglesias & Comunidades')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('iglesias.index') }}">Listar Registros</a></li>
    <li class="breadcrumb-item active">Nueva Comunidad</li>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-4">



            <!-- general form elements -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Nueva Comunidad</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'comunidades.store', 'method' => 'POST', 'role' => 'form']) !!}
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Iglesia</label>
                        {!! Form::select('iglesias_id', $iglesias, null, ['class' => 'form-control', 'placeholder' => 'Seleccione']) !!}
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('Name') }} de la Comunidad</label>
                        {!! Form::text('nombre_comunidad', null, ['class' => 'form-control', 'placeholder' => __('Name'), 'required']) !!}
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer text-right">
                    <a href="{{ route('iglesias.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.card -->



        </div>

        <div class="offset-1 col-md-5">


            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Comunidades</h3>
                    <div class="card-tools">
                        {{--<a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </a>--}}
                        {{--<a href="{{ route('miembros.create') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-user-plus"></i>
                        </a>--}}
                        <a href="{{ route('comunidades.create') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-cog"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <table class="table table-hover table-valign-middle table-sm table-bordered table-responsive-sm">
                            <thead class="thead-dark">
                            <tr class="text-center">
                                <th>Nombre de la Comunidad</th>
                                <th>Iglesia</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comunidades as $comunidad)

                                <tr class="text-center table-primary text-sm">
                                    <td class="text-center">
                                        {{ $comunidad->nombre_comunidad }}
                                    </td>
                                    @if($comunidad->iglesias_id == null)
                                        @php($nombre_iglesia = "-")
                                    @else
                                        @php($nombre_iglesia = $comunidad->iglesias->nombre_iglesia)
                                    @endif
                                    <td class="text-center">{{ strtoupper($nombre_iglesia) }}</td>
                                    <td style="width: 10px">
                                        {!! Form::open(['route' => ['comunidades.destroy', $comunidad->id], 'method' => 'DELETE']) !!}
                                        <div class="btn-group">
                                            {{--<a href="{{ route('usuarios.show', $comunidad->id) }}" class="btn btn-default btn-sm text-info" title="Ver">
                                                <i class="fas fa-eye"></i></a>--}}
                                            <a href="{{ route('comunidades.edit', $comunidad->id) }}" class="btn btn-default btn-sm text-warning" title="Editar">
                                                <i class="fas fa-pencil-alt"></i></a>
                                            {{--<a href="#" class="btn btn-default btn-sm" title="Cambiar Tipo">
                                                <i class="fas fa-cog"></i></a>--}}
                                            {{--<button type="submit" onclick="return confirm('Desea Eliminar la Comunidad {{ strtoupper($comunidad->nombre_comunidad) }}')" class="btn btn-default btn-sm text-danger" title="Eliminar">
                                                <i class="far fa-trash-alt"></i></button>--}}
                                        </div>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row text-sm justify-content-end">
                        {!! $comunidades->render() !!}
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection

@section('script')

@endsection


