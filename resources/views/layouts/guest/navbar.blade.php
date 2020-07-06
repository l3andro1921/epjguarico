<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="{{ route('inicio') }}" class="navbar-brand">
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

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ ucwords(Auth::user()->name) }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest

        </ul>
    </div>
</nav>
