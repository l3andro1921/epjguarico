@extends("layouts.admin.layout")
@section('title', 'Noticias')
@section('noticias', 'active')
@section('container-title', 'Noticias')
@section('breadcrumb', '')

@section('buscar')
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="text" name="buscar" placeholder="Buscar Noticia" aria-label="Buscar" required>
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
                    <h3 class="card-title">Noticias Registradas</h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </a>
                        <a href="{{ route('noticias.create') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        {{--<a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-bars"></i>
                        </a>--}}
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <table class="table table-hover table-valign-middle table-sm table-bordered table-responsive-sm">
                            <thead class="thead-dark">
                            <tr class="text-center">
                                <th>Titulo</th>
                                <th>Lugar</th>
                                <th>Fecha</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($noticias as $noticia)

                                <tr class="text-center table-primary text-sm">
                                    <td class="text-left">
                                        <a href="{{ asset('img/noticias/'.$noticia->imagen) }}"
                                           data-rel="lightcase" title="{{ $noticia->titulo }}">
                                            <img src="{{ asset('img/noticias/'.$noticia->imagen) }}" alt="{{ $noticia->titulo }}" class="img-circle img-size-32 mr-2">
                                        </a>
                                        {{ $noticia->titulo }}
                                    </td>
                                    <td class="text-left">{{ strtolower($noticia->lugar) }}</td>
                                    <td>{{ $carbon->parse($noticia->fecha)->format('d-m-Y') }}</td>
                                    <td style="width: 10px">
                                        {!! Form::open(['route' => ['noticias.destroy', $noticia->id], 'method' => 'DELETE']) !!}
                                        <div class="btn-group">
                                            <a href="{{ route('noticias.show', $noticia->id) }}" class="btn btn-default btn-sm text-info" title="Ver">
                                                <i class="fas fa-eye"></i></a>
                                            <a href="{{ route('noticias.edit', $noticia->id) }}" class="btn btn-default btn-sm text-warning" title="Editar">
                                                <i class="fas fa-pencil-alt"></i></a>
                                            {{--<a href="#" class="btn btn-default btn-sm" title="Cambiar Tipo">
                                                <i class="fas fa-cog"></i></a>--}}
                                            <button type="submit" onclick="return confirm('Desea Eliminar la Noticia {{ $noticia->titulo }}')" class="btn btn-default btn-sm text-danger" title="Eliminar">
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
                        {!! $noticias->render() !!}
                    </div>
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


