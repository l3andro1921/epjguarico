@extends("layouts.guest.layout")

@section('container-title')
    <span>Encuentro de Promoción Juvenil</span>
@endsection

@section('breadcrumb')
    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Layout</a></li>--}}

    @if($ultima === null)
        <li class="breadcrumb-item active">Noticias</li>
        @else
        <li class="breadcrumb-item"><a href="{{ route('welcome.show', $ultima->id) }}">Noticias</a></li>
    @endif

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    {{--<h5 class="card-title">Card title</h5>--}}

                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class=""></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2" class="active"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('img/carousel/1.jpg') }}" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('img/carousel/2.jpg') }}" alt="Second slide">
                            </div>
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset('img/carousel/3.jpg') }}" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    {{--<p class="card-text">
                        Some quick example text to build on the card title and make up the bulk of the card's
                        content.
                    </p>
--}}
                    {{--<a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>--}}
                </div>
            </div>

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0 text-bold">¿Que es el Movimiento EPJ?</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-justify">
                        El Movimiento de Encuentros de Promoción Juvenil (EPJ) es una Asociación internacional privada de
                        fieles de derecho pontificio para la evangelización de la juventud. Mediante un método propio
                        posibilita la vivencia y convivencia de lo que es común cristiano, para impulsar grupos
                        juveniles que vayan fermentando de evangelio los ambientes y ayude a potenciar la vocación
                        integral, el liderazgo y la personalidad del joven y la joven.
                    </p>
                    {{--<a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>--}}
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">

            @if(!$noticias->isEmpty())

                @foreach($noticias as $noticia)

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
                        <p class="text-justify">{{ $noticia->resumen }}</p>


                        <!-- Social sharing buttons -->
                        {{--<button type="button" class="btn btn-default btn-sm"><i class="fas fa-folder"></i> Ver</button>--}}
                        <a href="{{ route('welcome.show', $noticia->id) }}" class="btn btn-default btn-sm"><i class="fas fa-folder"></i> Ver</a>
                        {{--<button type="button" class="btn btn-default btn-sm"><i class="fas fa-plus"></i> Participar</button>--}}
                        <small class="float-right text-muted text-xs"><i class="far fa-clock"></i>
                        {{ $carbon->parse($noticia->updated_at)->diffForHumans() }}
                        </small>
                    </div>
                    <!-- /.card-body -->
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
