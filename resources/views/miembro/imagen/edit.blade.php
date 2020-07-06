@extends("layouts.miembro.layout")

@section('container-title')
    Bienvenido
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Cambiar Imagen</li>
@endsection

@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cambiar Imagen</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        {!! Form::open(['route' => ['imagen.update', $imagen->id], 'method' => 'PUT', 'files' => true, 'id' => 'form1']) !!}
        <div class="card-body">

            <div class="form-group">
                <label>Imagen de Perfil</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="imgInp" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                </div>
            </div>

            <div class="form-group text-center">
                <img id="blah" src="" class="img-fluid" width="50%" height="50%" />
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer text-right">
            <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

        {!! Form::close() !!}
    </div>
    <!-- /.card -->

@endsection

@section('script')
    <script>
        function readImage (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result); // Renderizamos la imagen
                    $('#blah').attr('class', 'img-thumbnail');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function () {
            // Código a ejecutar cuando se detecta un cambio de archivO
            readImage(this);
        });
    </script>
@endsection
