@extends("layouts.guest.layout")

@section('container-title')
<span>Ver Noticias</span>
@endsection

@section('breadcrumb')
{{--<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item"><a href="#">Layout</a></li>--}}
<li class="breadcrumb-item active">Noticias</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">

        <div class="card card-widget">
            <div class="card-header">
                <div class="user-block">
                    <img class="img-circle" src="{{ asset('img/noticias/'.$ver->imagen) }}" alt="User Image">
                    <span class="username"><a href="#">{{ $ver->titulo }}</a></span>
                    <span class="description">
                                {{ $ver->lugar }} -
                                {{ $carbon->parse($ver->fecha)->toFormattedDateString() }}
                            </span>
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                    {{--<button type="button" class="btn btn-tool" data-toggle="tooltip" title="Mark as read">
                        <i class="far fa-circle"></i></button>--}}
                   {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>--}}
                    <a href="{{ route('inicio') }}" class="btn btn-tool"><i class="fas fa-times"></i></a>
                    {{--<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                    </button>--}}
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
                {{--<img class="img-fluid pad" src="{{ asset('img/noticias/'.$ver->imagen) }}" alt="Photo" width="100%">--}}
                <div class="text-center">
                    <img id="blah" src="{{ asset('img/noticias/'.$ver->imagen) }}" class="img-thumbnail" width="50%" height="50%" />
                </div>
                <hr>
                <div class="attachment-block">
                    <div class="attachment-text">
                        {{ $ver->resumen }}
                    </div>
                    <!-- /.attachment-text -->
                </div>
                <div class="attachment-block">
                    <div class="attachment-text">
                        {!! $ver->descripcion !!}
                    </div>
                    <!-- /.attachment-text -->
                </div>
                <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
                <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
                <span class="float-right text-muted">127 likes - 3 comments</span>
            </div>
            <!-- /.card-body -->
        </div>

    </div>
    <!-- /.col-md-6 -->
    <div class="col-lg-4">

        @if(!$noticias->isEmpty())

        @foreach($noticias as $noticia)

               {{-- @if($ver->id == $noticia->id)
                    @continue
                @endif--}}

        <div class="card card-widget">
            <div class="card-header">
                <div class="user-block">
                    <img class="img-circle" src="{{ asset('img/noticias/'.$noticia->imagen) }}" alt="User Image">
                    <span class="username"><a href="{{ route('welcome.show', $noticia->id) }}">{{ $noticia->titulo }}</a></span>
                    <span class="description">
                                {{ $noticia->lugar }} -
                                {{ $carbon->parse($noticia->fecha)->toFormattedDateString() }}
                            </span>
                </div>
                <!-- /.user-block -->
                {{--<div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                    </button>
                </div>
                <!-- /.card-tools -->--}}
            </div>
            <!-- /.card-header -->
            {{--<div class="card-body">
                <!-- post text -->
                <p class="text-justify">{{ $noticia->resumen }}</p>


                <!-- Social sharing buttons -->
                <button type="button" class="btn btn-default btn-sm"><i class="fas fa-folder"></i> Ver</button>
                --}}{{--<button type="button" class="btn btn-default btn-sm"><i class="fas fa-plus"></i> Participar</button>--}}{{--
                <small class="float-right text-muted text-xs"><i class="far fa-clock"></i>
                    {{ $carbon->parse($noticia->updated_at)->diffForHumans() }}
                </small>
            </div>
            <!-- /.card-body -->--}}
        </div>

        @endforeach

        @else

        <div class="card card-widget">
            <div class="card-header">
                <div class="user-block">
                    <img class="img-circle" src="{{ asset('img/logo_movimiento.jpg') }}" alt="User Image">
                    <span class="username"><a href="#">TITULO DE LA NOTICIA</a></span>
                    <span class="description">Lugar del Encuentro - 21-02-2020</span>
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- post text -->
                <p class="text-justify">Far far away, behind the word mountains, far from the
                    countries Vokalia and Consonantia, there live the blind
                    texts. Separated they live in Bookmarksgrove right at</p>


                <!-- Social sharing buttons -->
                <button type="button" class="btn btn-default btn-sm"><i class="fas fa-folder"></i> Ver</button>
                {{--<button type="button" class="btn btn-default btn-sm"><i class="fas fa-plus"></i> Participar</button>--}}
                <small class="float-right text-muted text-xs"><i class="far fa-clock"></i> 1 days</small>
            </div>
            <!-- /.card-body -->
        </div>

        @endif


    </div>
    <!-- /.col-md-6 -->
</div>
<!-- /.row -->

@endsection
