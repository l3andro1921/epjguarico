@extends("layouts.miembro.layout")

@section('container-title')
    Bienvenido
@endsection

@section('breadcrumb')
    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Layout</a></li>--}}
    <li class="breadcrumb-item active">Home</li>
@endsection

@section('botoncambiar')
    @if($imagen)
        <a href="{{ route("imagen.edit", $imagen->id) }}" class="btn btn-primary btn-block"><b>Cambiar Imagen</b></a>
    @else
        <a href="{{ route("imagen.create") }}" class="btn btn-primary btn-block"><b>Cambiar Imagen</b></a>
    @endif
@endsection

@section('content')

    <div class="card">

        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Actividades</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                <li class="nav-item"><a class="nav-link" href="#datos" data-toggle="tab">Datos Personales</a></li>
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                <li class="nav-item"><a class="nav-link" href="#seguridad" data-toggle="tab">Seguridad</a></li>
            </ul>
        </div><!-- /.card-header -->

        <div class="card-body">

            <div class="tab-content">

                <div class="active tab-pane" id="activity">
                    @include('miembro.home.actividades')
                </div>

                <div class="tab-pane" id="timeline">
                    @include('miembro.home.timeline')
                </div>

                <div class="tab-pane" id="datos">
                    @if($datos)
                        @include('miembro.home.edit')
                        @else
                        @include('miembro.home.create')
                    @endif
                </div>

                <div class="tab-pane" id="settings">
                    @include('miembro.home.settings')
                </div>

                <div class="tab-pane" id="seguridad">
                    @include('miembro.home.seguridad')
                </div>

            </div>

        </div>

    </div>

@endsection

@section('script')
    <script>
        $('[data-mask]').inputmask()
    </script>
@endsection
