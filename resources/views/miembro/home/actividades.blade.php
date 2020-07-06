@if($actividades)
@foreach($actividades as $actividad)
    @php($contador = 0)

    @foreach($actividad->participantes as $participante)
        @if($participante->datos_id == $datos->id)
            @php($contador = $contador + 1)
        @endif
    @endforeach

    @if(!$contador)
        @continue
    @endif

        <div class="post">
            <div class="user-block">
                @if($imagen)
                    @php($foto = 'img/users_img/'.$imagen->nombre_imagen)
                @else
                    @php($foto = 'img/user.jpg')
                @endif
                <img class="img-circle img-bordered-sm" src="{{ asset($foto) }}" alt="user image">
                <span class="username">
                                  <a href="#">{{ ucwords(Auth::user()->name) }}</a>
                              {{--<a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>--}}
                                </span>
                <span class="description">{{ $carbon->parse($actividad->updated_at)->diffForHumans() }}</span>
            </div>
            <!-- /.user-block -->
            <h3 class="text-primary"><i class="far fa-flag"></i> {{ strtoupper($actividad->nombre_evento) }}</h3>
            <p>
                {{ $actividad->descripcion }}
            </p>
            <h4><span class="text-sm text-success text-bold">Lugar:</span> <strong class="text-muted">{{ ucfirst($actividad->lugar_evento) }}</strong></h4>
            <h6>
                <span class="text-sm text-success text-bold">Fecha Inicio:</span> <strong class="text-muted">{{ $carbon->parse($actividad->fecha_inicio)->format('d-m-Y') }}</strong>
                <span class="float-right">
                                            <span class="text-sm text-success text-bold">Fecha Final:</span> <strong class="text-muted">{{ $carbon->parse($actividad->fecha_final)->format('d-m-Y') }}</strong>
                                        </span>
            </h6>
            <br>
            <p class="text-muted">
                @if($actividad->id_coordinador == $datos->id)
                    <i class="far fa-fw fa-user"></i> Coordinador<br>
                @endif
                @if($actividad->id_administrador == $datos->id)
                    <i class="far fa-fw fa-user"></i> Administrador<br>
                @endif
                @if($actividad->id_asesor == $datos->id)
                    <i class="far fa-fw fa-user"></i> Asesor<br>
                @endif

            @php($opcion = true)
            @foreach($actividad->participantes as $participante)
                @if($participante->status == "Inscrito")
                    <i class="far fa-fw fa-user"></i> Participante<br>
                @endif
                @if($participante->status == "AGENDA" && $participante->datos_id == $datos->id)
                    @if($opcion)
                        @php($opcion = false)
                        <i class="far fa-fw fa-user"></i> Exponente<br>
                        @php($contador = 0)
                        @foreach($participante->agendas as $agenda)
                            @php($contador = $contador + 1)
                            &emsp;&emsp;<em>Mensaje {{ $contador }}: <span class="text-info">{{ $agenda->mensaje }}</span></em><br>
                        @endforeach
                    @endif
                @endif
            @endforeach
            </p>
            <p>
                <a href="{{ route('mieventos.show', $actividad->id) }}" class="text-primary text-sm mr-2"><i class="fas fa-folder"></i> Ver</a>
                {{--<a href="#" class="text-success text-sm"><i class="fas fa-plus"></i> Participar</a>--}}
                <span class="float-right">
                                  <a href="#" class="link-black text-sm">
                                    <i class="far fa-comments mr-1"></i> Comments (5)
                                  </a>
                                </span>
            </p>
        </div>

@endforeach
@endif
<div class="timeline timeline-inverse">
<div>
    <i class="far fa-clock bg-gray"></i>
</div>
</div>
@if($actividades)
<div class="float-right">
    {{ $actividades->render() }}
</div>
@endif
{{--<div class="post">
    <div class="user-block">
        <img class="img-circle img-bordered-sm" src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="user image">
        <span class="username">
                          <a href="#">Leandro Acosta</a>
                      --}}{{--<a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>--}}{{--
                        </span>
        <span class="description">Publico Evento - 7:30 PM today</span>
    </div>
    <!-- /.user-block -->
    <p>
        Lorem ipsum represents a long-held tradition for designers,
        typographers and the like. Some people hate it and argue for
        its demise, but others ignore the hate as they create awesome
        tools to help create filler text for everyone from bacon lovers
        to Charlie Sheen fans.
    </p>

    <p>
        <a href="#" class="text-primary text-sm mr-2"><i class="fas fa-folder"></i> Ver</a>
        <a href="#" class="text-success text-sm"><i class="fas fa-plus"></i> Participar</a>
        <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments (5)
                          </a>
                        </span>
    </p>
</div>

<div class="post">
    <div class="user-block">
        <img class="img-circle img-bordered-sm" src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="user image">
        <span class="username">
                          <a href="#">Leandro Acosta</a>
                      --}}{{--<a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>--}}{{--
                        </span>
        <span class="description">Publico Evento - 7:30 PM today</span>
    </div>
    <!-- /.user-block -->
    <p>
        Lorem ipsum represents a long-held tradition for designers,
        typographers and the like. Some people hate it and argue for
        its demise, but others ignore the hate as they create awesome
        tools to help create filler text for everyone from bacon lovers
        to Charlie Sheen fans.
    </p>

    <p>
        <a href="#" class="text-primary text-sm mr-2"><i class="fas fa-folder"></i> Ver</a>
        <a href="#" class="text-success text-sm"><i class="fas fa-plus"></i> Participar</a>
        <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments (5)
                          </a>
                        </span>
    </p>
</div>--}}
