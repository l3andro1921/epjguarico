@extends("layouts.admin.layout")
@section('title', 'Eventos | Evento Privado')
@section('eventos', 'active')
@section('container-title', 'Eventos')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('eventos.index') }}">Eventos Registrados</a></li>
    <li class="breadcrumb-item active">Evento Cerrado</li>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8 row">

            <div class="col-md-6">

                <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-primary">
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="{{ asset('dist/img/evento-png-5.png') }}" alt="User Avatar">
                            {{--<span class="img-circle elevation-2"><i class="far fa-calendar-alt"></i></span>--}}
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">{{ strtoupper($evento->nombre_evento) }}</h3>
                        <h5 class="widget-user-desc">{{ $evento->tipos->tipo_evento }}</h5>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item nav-link">
                                <span class="text-bold text-muted">Fecha Inicio:</span>
                                <span class="float-right text-primary">{{ $carbon->parse($evento->fecha_inicio)->format('d-m-Y') }}</span>
                            </li>
                            <li class="nav-item nav-link">
                                <span class="text-bold text-muted">Fecha Final:</span>
                                <span class="float-right text-primary">{{ $carbon->parse($evento->fecha_final)->format('d-m-Y') }}</span>
                            </li>
                            <li class="nav-item nav-link">
                                <span class="text-bold text-muted">Max Participantes:</span>
                                <span class="float-right text-primary text-bold">{{ $evento->cupos }}</span>
                            </li>
                            <li class="nav-item nav-link">
                                <span class="text-bold text-muted">Miembros Invitados:</span>
                                <span class="float-right text-primary text-bold">{{ $rangos->count() }}</span>
                            </li>
                            <li class="nav-item nav-link">
                                <span class="text-bold text-muted">Lugar:</span>
                                <span class="float-right text-primary">{{ $evento->lugar_evento }}</span>
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

            <div class="col-md-6">


                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Miembros Invitados</h3>
                        <div class="card-tools">
                            {{--<a href="#" class="btn btn-tool btn-sm">
                                <i class="fas fa-download"></i>
                            </a>--}}
                            {{--<a href="{{ route('miembros.create') }}" class="btn btn-tool btn-sm">
                                <i class="fas fa-user-plus"></i>
                            </a>--}}
                            @if($cupos > 0)
                            <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-sm">
                                <i class="fas fa-cog"></i>
                            </a>
                            @endif
                            <a href="{{ route('eventos.show', $evento->id) }}" class="btn btn-tool btn-sm">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <table class="table table-hover table-valign-middle table-sm table-bordered table-responsive-sm">
                                <thead class="thead-dark">
                                <tr class="text-center">
                                    <th>Lista de Miembros</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rangos as $rango)

                                    <tr class="table-primary text-sm">
                                        <td class="text-center">
                                            {{ $rango->nombre_completo }}
                                        </td>
                                        <td style="width: 10px">
                                            {!! Form::open(['route' => ['eventos.cerrado.destroy', $rango->id], 'method' => 'DELETE']) !!}
                                            <div class="btn-group">
                                                <a href="{{ route('usuarios.show', $rango->id) }}" class="btn btn-default btn-sm text-info" title="Ver"
                                                   data-toggle="modal" data-target="#modal-sm{{ $rango->id }}">
                                                    <i class="fas fa-eye"></i></a>




                                                <div class="modal fade" id="modal-sm{{ $rango->id }}">
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
                                                                            @if($rango->img)
                                                                                @php($img = 'img/users_img/'.$rango->img->nombre_imagen)
                                                                            @else
                                                                                @php($img = 'img/user.jpg')
                                                                            @endif
                                                                            <img class="img-circle elevation-2" src="{{ asset($img) }}" alt="User Avatar">
                                                                        </div>
                                                                        <!-- /.widget-user-image -->
                                                                        <h3 class="widget-user-username">{{ $rango->nombre_completo }}</h3>
                                                                        <h5 class="widget-user-desc">{{ $rango->cedula }}</h5>
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
                                                                                <span class="float-right text-success">{{ $rango->telefono }}</span>
                                                                            </li>
                                                                            <li class="nav-item nav-link">
                                                                                <span class="text-bold text-muted">Sexo:</span>
                                                                                <span class="float-right text-success">{{ $rango->sexo }}</span>
                                                                            </li>
                                                                            <li class="nav-item nav-link">
                                                                                <span class="text-bold text-muted">Parroquia:</span>
                                                                                <span class="float-right text-success">{{ $rango->parroquia }}</span>
                                                                            </li>
                                                                            <li class="nav-item nav-link">
                                                                                <span class="text-bold text-muted">Arquidiosesis:</span>
                                                                                <span class="float-right text-success">{{ $rango->arquidiosesis }}</span>
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





                                                {{--<a href="{{ route('comunidades.edit', $comunidad->id) }}" class="btn btn-default btn-sm text-warning" title="Editar">
                                                    <i class="fas fa-pencil-alt"></i></a>
                                                <a href="#" class="btn btn-default btn-sm" title="Cambiar Tipo">
                                                    <i class="fas fa-cog"></i></a>--}}
                                                <button type="submit" onclick="return confirm('Desea Quitar a {{ strtoupper($rango->nombre_completo) }}')" class="btn btn-default btn-sm text-danger" title="Eliminar">
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
                           {{-- {!! $rangos->render() !!}--}}
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
                                {!! Form::open(['route' => ['eventos.cerrado.store', $evento->id], 'method' => 'POST', 'role' => 'form']) !!}
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
