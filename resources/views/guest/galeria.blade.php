@extends("layouts.guest.layout")

@section('container-title')
    <span>Galeria</span>
@endsection

@section('breadcrumb')
    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Layout</a></li>--}}
    {{--<li class="breadcrumb-item active">Noticias</li>--}}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                {{--<div class="card-header">
                    <div class="card-title">
                        Galeria de Imagenes
                    </div>
                </div>--}}
                <div class="card-body">
                    <div class="row">
                        @forelse($galleries as $gallery)
                            <div class="col-sm-3">
                            <a href="{{ Storage::disk('public')->url($gallery->imagen) }}" data-toggle="lightbox" data-title="Imagen" data-gallery="gallery">
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
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->

@endsection
