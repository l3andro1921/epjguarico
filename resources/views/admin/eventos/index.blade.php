@extends("layouts.admin.layout")
@section('title', 'Eventos')
@section('eventos', 'active')
@section('container-title', 'Eventos')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('eventos.create') }}">Nuevo Evento</a></li>
@endsection

@section('buscar')
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="text" name="buscar" placeholder="Buscar Evento" aria-label="Buscar" required>
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
        <div class="col-md-10">



            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Eventos Registrados</h3>

                    <div class="card-tools">
                        {{--<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>--}}
                        {{--<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>--}}
                        <a href="{{ route('eventos.create') }}" class="btn btn-tool"><i class="far fa-flag"></i></a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th style="width: 1%">
                                ID
                            </th>
                            <th style="width: 30%">
                                Nombre del Evento
                            </th>
                            <th style="width: 20%">
                                Team Members
                            </th>
                            <th>
                                Progreso
                            </th>
                            <th style="width: 8%" class="text-center">
                                Tipo
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($eventos as $evento)

                        <tr>
                            <td>
                                {{ $evento->id }}
                            </td>
                            <td>
                                <a>
                                    {{ strtoupper($evento->nombre_evento) }}
                                </a>
                                <br>
                                <small>
                                    Fecha {{ $carbon->parse($evento->fecha_inicio)->format('d-m-Y') }}
                                    @if($evento->fecha_inicio < date('Y-m-d') && $evento->fecha_final < date('Y-m-d'))
                                        <span class="text-danger text-bold">(Culminado)</span>
                                    @endif
                                    @if($evento->fecha_inicio < date('Y-m-d') && $evento->fecha_final >= date('Y-m-d'))
                                        <span class="text-primary text-bold">(En Desarrollo...)</span>
                                    @endif
                                </small>
                            </td>
                            <td>
                                <ul class="list-inline">
                                    @if($evento->img_coordinador)
                                        @php($img_coordinador = 'img/users_img/'.$evento->img_coordinador->nombre_imagen)
                                    @else
                                        @php($img_coordinador = 'img/user.jpg')
                                    @endif

                                    @if($evento->img_administrador)
                                        @php($img_administrador = 'img/users_img/'.$evento->img_administrador->nombre_imagen)
                                    @else
                                        @php($img_administrador = 'img/user.jpg')
                                    @endif

                                    @if($evento->img_asesor)
                                        @php($img_asesor = 'img/users_img/'.$evento->img_asesor->nombre_imagen)
                                    @else
                                        @php($img_asesor = 'img/user.jpg')
                                    @endif
                                    <li class="list-inline-item">
                                        <img alt="Avatar" class="table-avatar" src="{{ asset($img_coordinador) }}">
                                    </li>
                                    <li class="list-inline-item">
                                        <img alt="Avatar" class="table-avatar" src="{{ asset($img_administrador) }}">
                                    </li>
                                    <li class="list-inline-item">
                                        <img alt="Avatar" class="table-avatar" src="{{ asset($img_asesor) }}">
                                    </li>
                                </ul>
                            </td>
                            <td class="project_progress">
                                <div class="progress progress-sm">
                                    @php($porcentaje = (100 * $evento->confirmados) / $evento->cupos)
                                    <div class="progress-bar bg-green" role="progressbar" aria-volumenow="{{ $porcentaje }}"
                                         aria-volumemin="0" aria-volumemax="100" style="width: {{ $porcentaje }}%">
                                    </div>
                                </div>
                                <small>
                                    {{ number_format($porcentaje, 0) }}% Completo
                                </small>
                            </td>
                            <td class="project-state">
                                <span class="badge badge-info">{{ $evento->tipos }}</span>
                                <br>
                                <small>
                                    {{ $evento->status }}
                                </small>
                            </td>
                            <td class="project-actions text-right">
                                {!! Form::open(['route' => ['eventos.destroy', $evento->id], 'method' => 'DELETE']) !!}
                                <a class="btn btn-primary btn-sm" href="{{ route('eventos.show', $evento->id) }}">
                                    <i class="fas fa-folder">
                                    </i>
                                </a>
                                <a class="btn btn-info btn-sm" href="{{ route('eventos.edit', $evento->id) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                </a>
                                {{--<a class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                </a>--}}
                                <button type="submit" onclick="return confirm('Desea Eliminar el Evento {{ $evento->nombre_evento }}')"
                                        class="btn btn-danger btn-sm" title="Eliminar">
                                    <i class="fas fa-trash"></i></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="row text-sm justify-content-center">
                {!! $eventos->render() !!}
            </div>



        </div>

    </div>
@endsection

@section('script')

@endsection


