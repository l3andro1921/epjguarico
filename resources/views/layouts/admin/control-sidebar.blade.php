<div class="p-3">
    {{--<h5>Title</h5>
    <p>Sidebar content</p>--}}

    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a href="/" class="nav-link" target="_blank">
                {{--<i class="far fa-envelope"></i>--}} Inicio
            </a>
        </li>
        <li class="dropdown-divider"></li>
        <li class="nav-item">
            <span class="text-small text-muted float-right">¿Quienes Somos?</span>
        </li>
        <li class="nav-item active">
            <a href="{{ route('historia') }}" class="nav-link" target="_blank">
                {{--<i class="fas fa-inbox"></i>--}} Nuestra Historia
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('fundador') }}" class="nav-link"target="_blank">
                {{--<i class="far fa-file-alt"></i>--}} Nuestro Fundador
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('metas') }}" class="nav-link" target="_blank">
                {{--<i class="fas fa-filter"></i>--}} Metas y Objetivos
               {{-- <span class="badge bg-warning float-right">65</span>--}}
            </a>
        </li>
        {{--<li class="nav-item">
            <a href="#" class="nav-link">
                --}}{{--<i class="far fa-trash-alt"></i> --}}{{-- Donde Estamos
            </a>
        </li>--}}
        <li class="dropdown-divider"></li>
        <li class="nav-item">
            <a href="{{ route('mieventos.index') }}" class="nav-link" target="_blank">
                {{--<i class="far fa-envelope"></i>--}} Eventos
            </a>
        </li>
        <li class="dropdown-divider"></li>
        <li class="nav-item">
            <a href="{{ route('galeria') }}" class="nav-link" target="_blank">
                {{--<i class="far fa-envelope"></i>--}} Galeria
            </a>
        </li>
        <li class="dropdown-divider"></li>
    </ul>

</div>
