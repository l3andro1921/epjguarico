<nav class="main-header navbar navbar-expand-md navbar-light navbar-primary navbar-dark">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ asset('img/logo_movimiento.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">EPJ Guárico</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">¿Quienes Somos?</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="{{ route('historia') }}" class="dropdown-item">Nuestra Historia</a></li>
                        <li><a href="{{ route('fundador') }}" class="dropdown-item">Nuestro Fundador</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a href="{{ route('metas') }}" class="dropdown-item">Metas y Objetivos</a></li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-submenu">
                            <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Donde Estamos</a>
                            <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                                <li><a href="#" class="dropdown-item">Aragua</a></li>
                                <li><a href="#" class="dropdown-item">Barcelona</a></li>
                                <li><a href="#" class="dropdown-item">Carabobo</a></li>
                                <li><a href="#" class="dropdown-item">Distrito Capital</a></li>
                                <li><a href="#" class="dropdown-item">Lara</a></li>
                                <li><a href="#" class="dropdown-item">Maturín</a></li>
                                <li><a href="#" class="dropdown-item">Mérida</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mieventos.index') }}" class="nav-link">Eventos</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('galeria') }}" class="nav-link">Galeria</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Documentos</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li>
                            <a href="{{ asset('docs/documento_1.pdf') }}" class="dropdown-item" target="_blank">
                                Documento 1
                            </a>
                        </li>
                        <li>
                            <a href="{{ asset('docs/documento_2.pdf') }}" class="dropdown-item" target="_blank">
                                Documento 2
                            </a>
                        </li>

                        <li class="dropdown-divider"></li>

                        <!-- Level two dropdown-->
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false" class="dropdown-item dropdown-toggle">
                                <i class="fas fa-plus-square"></i> Documentos
                            </a>
                            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                <li>
                                    <a href="{{ asset('docs/documento_3.pdf') }}" class="dropdown-item" target="_blank">
                                        Documento 3
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ asset('docs/documento_4.pdf') }}" class="dropdown-item" target="_blank">
                                        Documento 4
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ asset('docs/documento_5.pdf') }}" class="dropdown-item" target="_blank">
                                        Documento 5
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- End Level two -->
                    </ul>
                </li>
                {{--<li class="nav-item">
                    <a href="#" class="nav-link">Contactanos</a>
                </li>--}}
            </ul>

            <!-- SEARCH FORM -->
            {{--<form class="form-inline ml-0 ml-md-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>--}}
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

            <!-- Messages Dropdown Menu -->
        {{--<li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>--}}
        <!-- Notifications Dropdown Menu -->
            {{--<li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>--}}
            <li class="nav-item">
                <a href="https://meet.jit.si/epj_guarico" class="nav-link" target="_blank">Video Conferencia</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('inicio') }}" class="nav-link">Inicio</a>
            </li>
            <li class="nav-item dropdown user-menu">
                @if($imagen)
                    @php($foto = 'img/users_img/'.$imagen->nombre_imagen)
                @else
                    @php($foto = 'img/user.jpg')
                @endif
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ asset($foto) }}" class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline">{{ ucwords(Auth::user()->name) }}{{--Alexander Pierce--}}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="{{ asset($foto) }}" class="img-circle elevation-2" alt="User Image">
                        <p>
                            {{ Auth::user()->email }}
                            @if(Auth::user()->type != 'Miembro')
                                <small>{{ Auth::user()->type }}</small>
                            @endif
                        </p>
                    </li>
                    <!-- Menu Body -->
                {{--<li class="user-body">
                    <div class="row">
                        <div class="col-4 text-center">
                            <a href="#">Followers</a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="#">Sales</a>
                        </div>
                        <div class="col-4 text-center">
                            <a href="#">Friends</a>
                        </div>
                    </div>
                    <!-- /.row -->
                </li>--}}
                <!-- Menu Footer-->
                    <li class="user-footer text-center">
                        {{--<a href="#settings" data-toggle="tab" class="btn btn-default btn-flat">Perfil</a>--}}
                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            {{--<li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>--}}

        </ul>
    </div>
</nav>
