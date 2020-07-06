@extends("layouts.guest.layout")

@section('container-title')
    <span>Nuestro Fundador</span>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item active">José María Pujadas</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <img src="{{ asset('img/inicio/fundador.png') }}" alt="..." class="d-block w-100 img-thumbnail">

                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0 text-bold">VIDA PARROQUIAL</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-justify">
                        Fue nombrado Vicario de Llers (Gerona) hasta el 29 de julio de 1941. De Llers pasó también como
                        vicario a Arenys de Mar. Allí funda la Acción Católica que después de cincuenta años todavía produce
                        sus frutos. La Acción Católica de Arenys fue un movimiento notable en la seglaridad de la diócesis
                        de Gerona en aquellos tiempos.
                    </p>
                    <p class="card-text text-justify">
                        El día 20 de abril de 1944 fue nombrado cura/párroco de Vilabertrán. La pastoral en aquella población
                        es recordada por todos. La Abadía de Vilabertrán fue iniciada en el año de 1080. Fue consagrada el 11
                        de noviembre de 1100. Al extremo norte está la capilla funeraria, obra del siglo XIV.
                    </p>
                    <p class="card-text text-justify">
                        La ornamentación
                        muy sobria, es de tipo floral. La abadía propiamente dicha es considerada como uno de los muchos ejemplos
                        de arquitectura civil del siglo XV en Cataluña. Sin dejar estas responsabilidades, fue nombrado asesor de
                        la acción católica en Figueras, además de servir de capellán, de las Madres Escolapias y ejercer como
                        profesor en el instituto de la ciudad, actividad que prosiguió hasta su ingreso en la casa Misión de
                        Bañolas, en 1956
                    </p>
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0 text-bold">José María Pujadas</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-justify">
                        José María Pujadas Ferrer nació en Canet de Mar, provincia de Barcelona, el 9 de agosto de 1915.
                    </p>
                    <p class="card-text text-justify">
                        Su mamá Asunción Ferrer era modista. Tuvo 9 hijos; cinco de ellos murieron prematuramente.
                        El clima familiar era de una bondad y un amor permanente. Todos los miembros de la familia Pujadas
                        se profesaban un amor entrañable entre ellos.
                    </p>
                    <p class="card-text text-justify">
                        En aquel paraje idílico en un ambiente familiar y social tan favorable fue bautizado nuestro
                        hombre el 22 de agosto siguiente a su nacimiento y en 1922 recibió su primera comunión.
                    </p>
                    <p class="card-text text-justify">
                        En 1927, a los doce años, sintió y decidió su vocación sacerdotal y entra al seminario de Gerona.
                    </p>
                    <p class="card-text text-justify">
                        Poco le duraría la placidez y la bonanza. A partir de la entrada al seminario la historia del país
                        comenzaba a acelerarse. Ingresa al seminario Francés de Perpiñán por sugerencia del Obispo y del
                        Dr. Cartañá, obispo de Gerona y pasa en Francia cuatro años de su vida de 1932 a 1936, hasta que
                        se alistó en el servicio militar. Fue destinado al cuartel de Tarragona desde donde huyó intentando
                        pasar la frontera. Al finalizar la guerra civil, se reincorporó al seminario de Gerona.
                    </p>
                    <p class="card-text text-justify">
                        Sus compañeros de seminario y amigos lo veían progresar de una manera generalizada en diversos
                        campos del conocimiento, no solamente los temas religiosos. La cultura general, la historia, la
                        pedagogía, la sicología, las ciencias, que seguía con atención en todas sus manifestaciones y por
                        supuesto la teología y la liturgia, eran objeto de su atención.
                    </p>
                    <p class="card-text text-justify">
                        El Padre no se cansaba de repetir <strong>“Que bonito es hacer el ridículo por Cristo”.</strong>
                    </p>
                    <p class="card-text text-justify">
                        El 17 de Noviembre de 1940, recibió en la catedral de Gerona, por manos del obispo Cartañá el
                        subdiaconado, el diaconado el 26 de diciembre y es ordenado sacerdote el 16 de febrero de 1941.
                        Celebra la primera misa en el Santuario de la Misericordia de Canet el 23 de febrero de aquel mismo año.
                    </p>
                    <p class="card-text text-justify">
                        El P. Pujadas, siempre seguía el pensamiento y las directrices de la Iglesia Pero también era un
                        inquieto por las ideas que podían representar progreso o enriquecimiento espiritual. Tenía un gran
                        apasionamiento por aprender las novedades eclesiales y por enriquecer y mejorar a las personas.
                    </p>
                    <p class="card-text text-justify">
                        Pero la demostración mayor de la intelectualidad del Padre Pujadas y de su ánimo sacerdotal fue
                        el Concilio Vaticano II. El estaba preparado para el gran acontecimiento, era un abanderado del
                        movimiento ecuménico, conocía perfectamente la doctrina mística del movimiento seglar.
                    </p>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0 text-bold">CURSILLOS DE CRISTIANDAD</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-justify">
                        Inicio los cursillos de Cristiandad en la Diócesis de Gerona. El padre Pujadas tenía cierta formación
                        francesa, él quería, con la experiencia que había adquirido, fundar los Cursillos de Cristiandad
                        en Francia. El creía que la experiencia demostrada de la eficacia del movimiento, en la profundidad
                        cultural de los franceses podría representar un aporte valioso para la Iglesia. Fue precisamente esta
                        actividad en Cursillos la que hizo que por primera vez viajara a Colombia.
                    </p>
                </div>
            </div>

        </div>
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->

@endsection
