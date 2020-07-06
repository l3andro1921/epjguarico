<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('noticias.index') }}" class="nav-link @yield('noticias')">
                    <i class="nav-icon far fa-bookmark"></i>
                    <p>
                        Noticias
                        {{--<span class="right badge badge-danger">New</span>--}}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('galeria.home') }}" class="nav-link @yield('galeria')">
                   <i class="far fa-dot-circle nav-icon"></i>
                    <p>
                        Galeria
                        {{--<span class="right badge badge-danger">New</span>--}}
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                        Administrar Eventos
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('eventos.index') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Eventos</p>
                        </a>
                    </li>
                    {{--<li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Level 2
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Level 3</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Level 3</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Level 3</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    --}}
                    {{--<li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Pagos</p>
                        </a>
                    </li>--}}
                    <li class="nav-item">
                        <a href="{{ route('configuracion.index') }}" class="nav-link @yield('configuracion')">
                            <i class="fas fa-cog nav-icon"></i>
                            <p>Configuración</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('usuarios.index') }}" class="nav-link @yield('usuarios')">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Usuarios
                        {{--<span class="right badge badge-danger">New</span>--}}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('miembros.index') }}" class="nav-link @yield('miembros')">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Miembros
                        {{--<span class="right badge badge-danger">New</span>--}}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('iglesias.index') }}" class="nav-link @yield('iglesias')">
                    {{--<i class="nav-icon fas fa-map-marker-alt mr-1"></i>--}}
                    <i class="nav-icon fas fa-lg fa-home"></i>
                    <p>
                        Iglesias & Comunidades
                        {{--<span class="right badge badge-danger">New</span>--}}
                    </p>
                </a>
            </li>
            {{--<li class="nav-header">MULTI LEVEL EXAMPLE</li>--}}
            {{--<li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Level 1</p>
                </a>
            </li>--}}
            {{--<li class="nav-header">LABELS</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle text-danger"></i>
                    <p class="text">Important</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle text-warning"></i>
                    <p>Warning</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle text-info"></i>
                    <p>Informational</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Simple Link
                        <span class="right badge badge-danger">New</span>
                    </p>
                </a>
            </li>--}}
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
