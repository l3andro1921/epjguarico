@extends("layouts.admin.layout")
@section('title', 'Miembros')
@section('miembros', 'active')
@section('container-title', 'Miembros')
@section('breadcrumb', '')

@section('buscar')
    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="text" placeholder="Buscar Cedula" aria-label="Buscar" data-inputmask='"mask": "A-99999999"' data-mask required>
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
        <div class="col-md-8">



            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Lista de Miembros</h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </a>
                        @if(!$tipos->isEmpty())
                            <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-sm">
                                <i class="fas fa-user-plus"></i>
                            </a>
                            @else
                            <a href="{{ route('miembros_tipos.create') }}" class="btn btn-tool btn-sm">
                                <i class="fas fa-user-plus"></i>
                            </a>
                        @endif
                        {{--<a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-cog"></i>
                        </a>--}}
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <table class="table table-hover table-valign-middle table-sm table-bordered table-responsive-sm">
                            <thead class="thead-dark">
                            <tr class="text-center">
                                <th>Cedula</th>
                                <th>Nombre Completo</th>
                                <th>Tipo de Miembro</th>
                                <th>Comunidad</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($miembros as $miembro)

                                <tr class="text-center table-primary text-sm">
                                    <td class="text-center">
                                        {{ $miembro->datos->cedula }}
                                    </td>
                                    <td class="text-left">{{ $miembro->datos->nombre_completo }}</td>
                                    @if($miembro->tipos_id == null)
                                        @php($tipo_miembro = "-")
                                    @else
                                        @php($tipo_miembro = $miembro->tipos->tipo_miembro)
                                    @endif
                                    <td class="text-center">{{ $tipo_miembro }}</td>
                                    @if($miembro->comunidades_id == null)
                                        @php($comunidad_nombre = "-")
                                    @else
                                        @php($comunidad_nombre = $miembro->comunidades->nombre_comunidad)
                                    @endif
                                    <td>{{ $comunidad_nombre }}</td>
                                    <td style="width: 10px">
                                        {!! Form::open(['route' => ['miembros.destroy', $miembro->id], 'method' => 'DELETE']) !!}
                                        <div class="btn-group">
                                            <a href="{{ route('miembros.timeline', $miembro->id) }}" class="btn btn-default btn-sm text-info" title="Ver">
                                                <i class="fas fa-eye"></i></a>
                                            <a href="{{ route('miembros.edit', $miembro->id) }}" class="btn btn-default btn-sm text-warning" title="Editar">
                                                <i class="fas fa-pencil-alt"></i></a>
                                            {{--<a href="#" class="btn btn-default btn-sm" title="Cambiar Tipo">
                                                <i class="fas fa-cog"></i></a>--}}
                                            <button type="submit" onclick="return confirm('Desea Eliminar al Miembro {{ $miembro->datos->cedula }}')" class="btn btn-default btn-sm text-danger" title="Eliminar">
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
                        {!! $miembros->render() !!}
                    </div>
                </div>
            </div>



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
                                        <a href="{{ route('miembros.show', $tipo->id) }}" class="btn btn-default btn-sm text-info float-left" title="Ver">
                                            <i class="fas fa-eye"></i></a>
                                        <small class="float-right text-primary text-small">
                                            <i class="fas fa-users"></i>
                                            ({{ $tipo->miembros }})
                                        </small>
                                    </td>
                                    <td style="width: 10px">
                                        {!! Form::open(['route' => ['miembros_tipos.destroy', $tipo->id], 'method' => 'DELETE']) !!}
                                        <div class="btn-group">
                                            {{--<a href="{{ route('iglesias.show', $iglesia->id) }}" class="btn btn-default btn-sm text-info" title="Ver">
                                                <i class="fas fa-eye"></i></a>--}}
                                            <a href="{{ route('miembros_tipos.edit', $tipo->id) }}" class="btn btn-default btn-sm text-warning" title="Editar">
                                                <i class="fas fa-pencil-alt"></i></a>
                                            <button type="submit" onclick="return confirm('Desea Eliminar el Tipo {{ strtoupper($tipo->tipo_miembro) }}')" class="btn btn-default btn-sm text-danger" title="Eliminar">
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


    </div>

    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Miembros</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- SEARCH FORM -->
                    {!! Form::open(['route' => 'cedula.create', 'method' => 'POST', 'role' => 'form']) !!}
                        <div class="input-group input-group">
                            <input class="form-control" type="text" name="cedula" placeholder="Buscar Cedula" data-inputmask='"mask": "A-99999999"' data-mask required>
                            <div class="input-group-append">
                                <button class="btn btn-default" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <!-- SEARCH FORM -->
                    {{--<legend></legend>
                    <form>
                        <div class="input-group input-group">
                            <input class="form-control" type="text" placeholder="Buscar Nombre" required>
                            <div class="input-group-append">
                                <button class="btn btn-default" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>--}}
                </div>
                {{--<div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>--}}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection

@section('script')
    {{--<script>
        jQuery(document).ready(function($) {
            $('a[data-rel^=lightcase]').lightcase();
        });

    </script>--}}
    <script>
        $('[data-mask]').inputmask()
    </script>
@endsection


