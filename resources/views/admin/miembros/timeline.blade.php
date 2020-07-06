@extends("layouts.admin.layout")
@section('title', 'Miembros')
@section('miembros', 'active')
@section('container-title', 'Miembros')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('miembros.index') }}">Miembros Registrados</a></li>
    <li class="breadcrumb-item active">Timeline</li>
@endsection

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-8">


            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Timeline <em class="small">de</em> <span class="text-muted text-bold">{{ $datos->nombre_completo }}</span></h3>
                    <div class="card-tools">
                        {{--<a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </a>--}}
                        <a href="{{ route('miembros.index') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-times"></i>
                        </a>
                        {{--<a href="{{ route('miembros_tipos.create') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-cog"></i>
                        </a>--}}
                    </div>
                </div>
                <div class="card-body">

                   {{-- //////////////////////////////////////////////////////////////////////////////////////////////////////--}}



                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                    @foreach($timelines as $actividad)
                        @php($contador = 0)

                        @foreach($actividad->participantes as $participante)
                            @if($participante->datos_id == $datos->id && $participante->asistencia == "SI")
                                @php($contador = $contador + 1)
                            @endif
                        @endforeach

                        @if(!$contador)
                            @continue
                        @endif

                        <!-- timeline time label -->
                            <div class="time-label">
                                @php($claves = array_rand($color, 1))
                                <span class="{{ $color[$claves] }}">
                          {{ $carbon->parse($actividad->fecha_inicio)->toFormattedDateString() }}
                        </span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            @foreach($actividad->participantes as $participante)
                                @if($participante->status == "Inscrito" && $participante->asistencia == "SI" && $participante->datos_id == $datos->id)
                                    <div>
                                        <i class="far fa-flag bg-primary"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> {{ $carbon->parse($actividad->updated_at)->diffForHumans() }}</span>

                                            <h3 class="timeline-header"><a href="{{ route('eventos.show', $actividad->id) }}">
                                                    Participante</a> <em class="small">en el evento: </em>
                                                <a href="{{ route('eventos.show', $actividad->id) }}" class="text-muted">
                                                    {{ strtoupper($actividad->nombre_evento) }}</a></h3>

                                            <div class="timeline-body">
                                                {{ $actividad->descripcion }}
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="{{ route('eventos.show', $actividad->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-folder"></i> Ver</a>
                                                {{--<a href="#" class="btn btn-danger btn-sm">Delete</a>--}}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        <!-- END timeline item -->
                            <!-- timeline item -->
                            @if($actividad->id_coordinador == $datos->id)
                                @foreach($actividad->participantes as $participante)
                                    @if($participante->status == "TEAM" && $participante->asistencia == "SI" && $participante->datos_id == $datos->id)
                                        <div>
                                            <i class="fas fa-user bg-success"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> {{ $carbon->parse($actividad->updated_at)->diffForHumans() }}</span>

                                                <h3 class="timeline-header border-0"><a href="{{ route('eventos.show', $actividad->id) }}">
                                                        Coordinador</a> <em class="small">en el evento: </em>
                                                    <a href="{{ route('eventos.show', $actividad->id) }}" class="text-muted">
                                                        {{ strtoupper($actividad->nombre_evento) }}</a></h3>
                                                </h3>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        <!-- END timeline item -->
                            <!-- timeline item -->
                            @if($actividad->id_administrador == $datos->id)
                                @foreach($actividad->participantes as $participante)
                                    @if($participante->status == "TEAM" && $participante->asistencia == "SI" && $participante->datos_id == $datos->id)
                                        <div>
                                            <i class="fas fa-user bg-info"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> {{ $carbon->parse($actividad->updated_at)->diffForHumans() }}</span>

                                                <h3 class="timeline-header border-0"><a href="{{ route('eventos.show', $actividad->id) }}">
                                                        Administrador</a> <em class="small">en el evento: </em>
                                                    <a href="{{ route('eventos.show', $actividad->id) }}" class="text-muted">
                                                        {{ strtoupper($actividad->nombre_evento) }}</a></h3>
                                                </h3>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        <!-- END timeline item -->
                            <!-- timeline item -->
                            @if($actividad->id_asesor == $datos->id)
                                @foreach($actividad->participantes as $participante)
                                    @if($participante->status == "TEAM" && $participante->asistencia == "SI" && $participante->datos_id == $datos->id)
                                        <div>
                                            <i class="fas fa-user bg-maroon"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> {{ $carbon->parse($actividad->updated_at)->diffForHumans() }}</span>

                                                <h3 class="timeline-header border-0"><a href="{{ route('eventos.show', $actividad->id) }}">
                                                        Asesor</a> <em class="small">en el evento: </em>
                                                    <a href="{{ route('eventos.show', $actividad->id) }}" class="text-muted">
                                                        {{ strtoupper($actividad->nombre_evento) }}</a></h3>
                                                </h3>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        <!-- END timeline item -->
                            <!-- timeline item -->
                            @php($opcion = true)
                            @foreach($actividad->participantes as $participante)
                                @if($participante->status == "AGENDA" && $participante->datos_id == $datos->id && $participante->asistencia == "SI")
                                    @if($opcion)
                                        @php($opcion = false)
                                        <div>
                                            <i class="fas fa-comments bg-warning"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> {{ $carbon->parse($actividad->updated_at)->diffForHumans() }}</span>

                                                <h3 class="timeline-header"><a href="{{ route('eventos.show', $actividad->id) }}">
                                                        Exponente</a> <em class="small">en el evento: </em>
                                                    <a href="{{ route('eventos.show', $actividad->id) }}" class="text-muted">
                                                        {{ strtoupper($actividad->nombre_evento) }}</a></h3>

                                                <div class="timeline-body">
                                                    @php($contador = 0)
                                                    @foreach($participante->agendas as $agenda)
                                                        @php($contador = $contador + 1)
                                                        <em>Mensaje {{ $contador }}: <span class="text-info">{{ $agenda->mensaje }}</span></em><br>
                                                    @endforeach
                                                </div>
                                                {{--<div class="timeline-footer">
                                                    <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                                </div>--}}
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        <!-- END timeline item -->
                            <!-- timeline time label -->
                            {{--<div class="time-label">
                                                <span class="bg-success">
                                                  3 Jan. 2014
                                                </span>
                            </div>--}}
                        @endforeach
                    <!-- /.timeline-label -->
                        <!-- timeline item -->
                        {{--<div>
                            <i class="fas fa-camera bg-purple"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                <div class="timeline-body">
                                    <img src="http://placehold.it/150x100" alt="...">
                                    <img src="http://placehold.it/150x100" alt="...">
                                    <img src="http://placehold.it/150x100" alt="...">
                                    <img src="http://placehold.it/150x100" alt="...">
                                </div>
                            </div>
                        </div>
                        <!-- END timeline item -->--}}
                        <div>
                            <i class="far fa-clock bg-gray"></i>
                        </div>
                    </div>





                    {{--//////////////////////////////////////////////////////////////////////////////////////////////////////--}}

                </div>
            </div>

        </div>


    </div>
@endsection

@section('script')

@endsection


