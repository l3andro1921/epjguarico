<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    @if($imagen)
                        @php($foto = 'img/users_img/'.$imagen->nombre_imagen)
                        @else
                        @php($foto = 'img/user.jpg')
                    @endif
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ asset($foto) }}"
                         alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ ucwords(Auth::user()->name) }}</h3>

                @if($datos)
                    <p class="text-muted text-center">{{ $tipo_miembro }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item text-center">
                            <b>{{ $datos->nombre_completo }}</b> {{--<a class="float-right">1,322</a>--}}
                    </li>
                    <li class="list-group-item text-center">
                        <b>{{ $datos->telefono }}</b> <i class="fas fa-phone"></i>{{--<a class="float-right">543</a>--}}
                    </li>
                    <li class="list-group-item text-center">
                        <em class="text-muted">Edad:</em> <b>{{ $edad }} años</b> {{--<i class="far fa-calendar-alt"></i>--}}{{--<a class="float-right">13,287</a>--}}
                    </li>
                </ul>
                @endif

                @yield('botoncambiar')

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    @if($datos)
        <!-- About Me Box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Sobre mí</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Educación</strong>

                <p class="text-muted">
                    {{ $datos->nombre_estudio }}
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Ubicación</strong>

                <p class="text-muted">
                    {{ $datos->parroquia }}
                </p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Pasatiempos</strong>

                <p class="text-muted">
                    {{ $datos->pasatiempo }}
                </p>

                {{--<hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>--}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
     @endif

    </div>
    <!-- /.col -->
    <div class="col-md-9">
        @yield('content', '@section(\'content\')')
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->








