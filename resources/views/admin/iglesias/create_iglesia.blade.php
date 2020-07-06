@extends("layouts.admin.layout")
@section('title', 'Iglesias & Comunidades')
@section('iglesias', 'active')
@section('container-title', 'Iglesias & Comunidades')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('iglesias.index') }}">Listar Registros</a></li>
    <li class="breadcrumb-item active">Nueva Iglesia</li>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-4">



            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Iglesias</h3>
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
                                <th>Nombre de la Iglesia</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($iglesias as $iglesia)

                                <tr class="text-center table-primary text-sm">
                                    <td class="text-center">
                                        {{ strtoupper($iglesia->nombre_iglesia) }}
                                    </td>
                                    <td style="width: 10px">
                                        {!! Form::open(['route' => ['iglesias.destroy', $iglesia->id], 'method' => 'DELETE']) !!}
                                        <div class="btn-group">
                                            {{--<a href="{{ route('iglesias.show', $iglesia->id) }}" class="btn btn-default btn-sm text-info" title="Ver">
                                                <i class="fas fa-eye"></i></a>--}}
                                            <a href="{{ route('iglesias.show', $iglesia->id) }}" class="btn btn-default btn-sm text-warning" title="Editar">
                                                <i class="fas fa-pencil-alt"></i></a>
                                            {{--<button type="submit" onclick="return confirm('Desea Eliminar la Iglesia {{ strtoupper($iglesia->nombre_iglesia) }}')" class="btn btn-default btn-sm text-danger" title="Eliminar">
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

        <div class="offset-1 col-md-4">


            <!-- general form elements -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Nueva Iglesia</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'iglesias.store', 'method' => 'POST', 'role' => 'form']) !!}
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">{{ __('Name') }} de la Iglesia</label>
                        {!! Form::text('nombre_iglesia', null, ['class' => 'form-control', 'placeholder' => __('Name'), 'required']) !!}
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
    </div>
@endsection

@section('script')

@endsection


