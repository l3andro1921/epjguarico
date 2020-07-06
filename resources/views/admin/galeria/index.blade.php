@extends("layouts.admin.layout")
@section('title', 'Galeria')
@section('galeria', 'active')
@section('container-title', 'Galeria')
@section('breadcrumb', '')

@section('buscar')
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="text" name="buscar" placeholder="Buscar En Galeria" aria-label="Buscar" required>
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
@endsection

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-lg-11">

            <div class="card">
               <div class="card-header border-0">
                    <h3 class="card-title">Galeria de Imagenes</h3>
                    <div class="card-tools">
                        <a href="{{ route('galeria.carga') }}" class="btn btn-primary btn-sm mb-2">Agregar Imagen</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($galleries as $gallery)
                            <div class="col-sm-3">
                            <a href="{{ Storage::disk('public')->url($gallery->imagen) }}" data-toggle="lightbox" data-title="Imagen 1" data-gallery="gallery">
                                <img src="{{ Storage::disk('public')->url($gallery->imagen) }}" class="img-thumbnail mb-2" alt="imagen">
                            </a>
                        </div>
                        @empty
                            <span class="text-center text-danger">No Hay Imagenes Disponibles</span>
                        @endforelse
                    </div>
                </div>
                @if(count($galleries))
                <div class="mt-2 mx-auto">
                    {{ $galleries->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection


