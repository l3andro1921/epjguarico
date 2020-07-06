@extends("layouts.admin.layout")
@section('title', 'Iglesias & Comunidades')
@section('iglesias', 'active')
@section('container-title', 'Iglesias & Comunidades')
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
                                            <button type="submit" onclick="return confirm('Desea Eliminar la Iglesia {{ strtoupper($iglesia->nombre_iglesia) }}')" class="btn btn-default btn-sm text-danger" title="Eliminar">
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
                                            <button type="submit" onclick="return confirm('Desea Eliminar la Comunidad {{ strtoupper($comunidad->nombre_comunidad) }}')" class="btn btn-default btn-sm text-danger" title="Eliminar">
                                                <i class="far fa-trash-alt"></i></button>
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


