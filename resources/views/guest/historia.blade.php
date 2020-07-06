@extends("layouts.guest.layout")

@section('container-title')
    <span>Nuestro Historia</span>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Nuestra Historia</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">

                    <img src="{{ asset('img/inicio/fundador_2.png') }}" alt="..." class="d-block w-100 img-thumbnail">

                </div>
            </div>
            <div class="card card-primary card-outline">
                {{--<div class="card-header">
                    <h5 class="card-title m-0 text-bold">LOS ENCUENTROS DE PROMOCION JUVENIL</h5>
                </div>--}}
                <div class="card-body">
                    <p class="card-text text-justify">
                        El carisma propio de los Encuentros y de su fundador es promover al joven para que descubra su
                        vocación integral dentro del plan de Dios, lo acepte como una experiencia de fe, lo potencie al
                        máximo y lo realice en todos sus valores, desde el marco de grupos o comunidades cristianas juveniles
                        de evangelización.
                    </p>
                    <p class="card-text text-justify">
                        Siempre y cuando se sigan los pensamientos del P. Pujadas, se pretende un triple encuentro.
                    <ul>
                        <li class="text-justify">
                            Que el joven descubra su vocación dentro del plan de Dios, su propia identidad,
                            sus posibilidades y limitaciones, que en definitiva es encontrarse a sí mismo.
                        </li>
                        <li class="text-justify">
                            Ayuda a hacer del hombre un ser social cristiano, capaz de vivir en comunidad,
                            dando importancia al amor, al servicio a los demás y a la propia realización cumpliendo
                            la vocación cristiana.
                        </li>
                        <li class="text-justify">
                            Reafirma el compromiso bautismal, exigencia de la fe adulta, opción del Dios único.
                        </li>
                    </ul>
                    </p>
                    <p class="card-text text-justify">
                        Un punto fundamental de los Encuentros es que los jóvenes sigan el apostolado de los propios jóvenes.
                        Este es otro aspecto de la confianza depositada en los seglares.
                    </p>
                </div>
            </div>

        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0 text-bold">LOS ENCUENTROS DE PROMOCION JUVENIL</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-justify">
                        Eran los comienzos del año 1960, cuando nuestra juventud insatisfecha por la situación política
                        y los cambios sicológicos, políticos y culturales, se aferraba a cualquier esquema que los motivara.
                        Las universidades impregnaban de ideas marxistas a nuestros estudiantes, en una especie de oasis
                        ideológico para superar el sopor del momento.
                    </p>
                    <p class="card-text text-justify">
                        Los Encuentros de Promoción Juvenil son la obra más querida del P. Pujadas. El fue su fundador principal.
                        Mientras él trabajaba en los cursillos de cristiandad se daba cuenta de la preocupación de muchos padres
                        por el distanciamiento de sus hijos en la práctica religiosa.
                    </p>
                    <p class="card-text text-justify">
                        Siguiendo los consejos de Pablo VI y acorde a la acción prioritaria por la juventud de los Obispos
                        latinoamericanos, reunidos en Medellín y en colaboración con otros sacerdotes y laicos, en 1968,
                        comenzó en Colombia el Movimiento Encuentros de Promoción Juvenil, que luego se extendió por Centro
                        América, por lo que el Padre Pujadas permaneció largas temporadas en Costa Rica, Guatemala, El Salvador,
                        Honduras y Nicaragua. Pasó a Costa Rica donde trabajó como director arquidiocesano de Pastoral Orgánica
                        de Juventudes y Encuentros de Promoción Juvenil de la arquidiócesis de San José, hasta que en 1972,
                        viajó y permaneció 2 años en Los Ángeles (Estados Unidos), dedicándose a los Encuentros y Cursillos.
                        En 1974, regresó a Barcelona, reclamado por su Obispo, el Cardenal Narcís, Juvany, donde inició y
                        dirigió los Encuentros de Promoción Juvenil, alternando esta actividad con la coordinación y dirección
                        a nivel Internacional del Movimiento, que llevó a otras naciones (Italia, Alemania, Venezuela, Santo
                        Domingo).
                    </p>
                    <p class="card-text text-justify">
                        La experiencia vivencial de la fe, en lo profundo del corazón, es indispensable, dice el Cardenal
                        Juvany refiriéndose a los Encuentros. La personalización de una experiencia de la fe conduce a que
                        todo el mundo participe de la nueva vida.
                    </p>
                </div>
            </div>
            <div class="card card-primary card-outline">
                {{--<div class="card-header">
                    <h5 class="card-title m-0 text-bold">LOS ENCUENTROS DE PROMOCION JUVENIL</h5>
                </div>--}}
                <div class="card-body">
                    <p class="card-text text-justify">
                        El 22 de Septiembre de 1984, pocos días después de su regreso del V Encuentro Internacional de los
                        Encuentros de Promoción Juvenil, celebrado en Lima, Perú, sufrió un grave quebranto de salud, del
                        que no se recuperaría. Su ánimo no recae, su conciencia de “ser un grano de trigo” y su experiencia
                        del gran don de la amistad, le hacen conseguir nuevos proyectos e ilusiones.
                    </p>
                    <p class="card-text text-justify">
                        El segundo domingo de Adviento, 9 de diciembre de 1984 a las dos y cuarto de la tarde, nos dejó
                        su ánimo, su ilusión y su espíritu; y comenzó a vivir su quinto día. Es por esta razón que se
                        celebra en esta fecha en los países donde existe el Movimiento de Encuentros de Promoción Juvenil,
                        el día Internacional del Emproísta.
                    </p>
                </div>
            </div>

        </div>
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->

@endsection
