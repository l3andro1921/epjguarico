@extends("layouts.guest.layout")

@section('container-title')
    <span>Metas y Objetivos</span>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Metas y Objetivos</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0 text-bold">METAS</h5>
                </div>
                <div class="card-body">

                    <ol>
                        <li class="text-justify callout callout-info">
                            Aspiramos a la formación de hombres y mujeres nuevos, según la imagen de Jesús de
                            Nazaret, muerto y resucitado.
                        </li>
                        <li class="text-justify callout callout-info">
                            Aspiramos que cada joven se realice con autenticidad, mediante el encuentro de su propia
                            Vocación.
                        </li>
                        <li class="text-justify callout callout-info">
                            Aspiramos a ser una juventud cristiana creativa, con iniciativa y liderazgo, con sentido y
                            destino en la HISTORIA.
                        </li>
                        <li class="text-justify callout callout-info">
                            Aspiramos a una promoción juvenil con la familia y el diálogo de generaciones.
                        </li>
                        <li class="text-justify callout callout-info">
                            Aspiramos a cubrir los ambientes de grupos juveniles cristianos, evangelizados y
                            evangelizadores.
                        </li>
                        <li class="text-justify callout callout-info">
                            Aspiramos a vivir la experiencia y manifestar la fuerza del poder del Espíritu Santo.
                        </li>
                        <li class="text-justify callout callout-info">
                            Aspiramos a construir el Reino de Dios en el mundo y con trascendencia a la eternidad.
                        </li>
                    </ol>

                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0 text-bold">OBJETIVOS</h5>
                </div>
                <div class="card-body">

                    <div class="callout callout-success">
                        <h5>Objetivo General:</h5>
                        <p class="text-justify">
                            Promover a los jóvenes y las jóvenes a vivir su vocación integral mediante el carisma del Movimiento,
                            para formarlos como líderes cristianos y que sean protagonistas de la nueva civilización del amor.
                        </p>
                    </div>
                    <div class="callout callout-success">
                        <h5>Objetivo específicos:</h5>
                        <ul>
                            <li class="text-justify">
                                Promover a los jóvenes y las jóvenes a la realización de una vocación integral.
                            </li>
                            <li class="text-justify">
                                Promover a la juventud a la libre opción a la fe.
                            </li>
                            <li class="text-justify">
                                Promover a los jóvenes a un servicio de liderazgo en sus grupos y comunidades.
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->

@endsection
