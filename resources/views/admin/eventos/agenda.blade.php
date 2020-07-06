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


                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Lista de Exponentes</h3>
                        <div class="card-tools">
                            {{--<a href="#" class="btn btn-tool btn-sm">
                                <i class="fas fa-download"></i>
                            </a>--}}
                            {{--<a href="{{ route('miembros.create') }}" class="btn btn-tool btn-sm">
                                <i class="fas fa-user-plus"></i>
                            </a>--}}

                            <a href="{{ route('agenda.create.show', $evento->id) }}" class="btn btn-tool btn-sm"><i class="far fa-file-alt"></i></a>
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
                                    <th>N°</th>
                                    <th>Exponente</th>
                                    <th>Mensaje</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i = 0)
                                @foreach($rangos as $rango)
                                    @php($i++)
                                    <tr class="table-primary text-sm">
                                        <td class="text-center">
                                            <label class="badge"> {{ $i }}</label>
                                        </td>
                                        <td class="text-left">
                                            <label class="badge">{{ $rango->nombre_completo }}</label>
                                        </td>
                                        <td class="text-justify">
                                            {{ $rango->mensaje }}
                                        </td>
                                        <td style="width: 10px">
                                            {!! Form::open(['route' => ['agenda.destroy', $rango->id], 'method' => 'DELETE']) !!}
                                            <div class="btn-group">
                                                {{--<a href="{{ route('usuarios.show', $rango->id) }}" class="btn btn-default btn-sm text-info" title="Ver"
                                                   data-toggle="modal" data-target="#modal-sm{{ $rango->id }}">
                                                    <i class="fas fa-eye"></i></a>--}}
                                                <a href="{{ route('agenda.edit', $rango->id) }}" class="btn btn-default btn-sm text-warning" title="Editar">
                                                    <i class="fas fa-pencil-alt"></i></a>
                                                {{--<a href="#" class="btn btn-default btn-sm" title="Cambiar Tipo">
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
