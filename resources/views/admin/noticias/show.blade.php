@extends("layouts.admin.layout")
@section('title', 'Noticias | Ver Noticia')
@section('noticias', 'active')
@section('container-title', 'Noticias')
@section('breadcrumb')
    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
    <li class="breadcrumb-item"><a href="{{ route('noticias.index') }}">Noticias Registradas</a></li>
    <li class="breadcrumb-item active">Ver Noticia</li>
@endsection

@section('buscar')
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="text" placeholder="Buscar Noticia" aria-label="Buscar" required>
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

            <div class="row">
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
                                    <a href="{{ route('noticias.index') }}" class="btn btn-tool"><i class="fas fa-times"></i></a>
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

        </div>
    </div>
@endsection

@section('script')
    <script>
        jQuery(document).ready(function($) {
            $('a[data-rel^=lightcase]').lightcase();
        });

    </script>
@endsection


