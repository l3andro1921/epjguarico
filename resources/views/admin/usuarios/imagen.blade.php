@extends("layouts.admin.layout")
@section('title', 'Usuarios | Imagen')
@section('usuarios', 'active')
@section('container-title', 'Usuarios')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios Registrados</a></li>
    <li class="breadcrumb-item active">Cambiar Imagen</li>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">



            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title text-bold">{{ ucwords($usuario->name) }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'imagen.cambiar', 'method' => 'POST', 'files' => true, 'id' => 'form1']) !!}
                <div class="card-body">

                    <div class="form-group">
                        <label>Imagen de Perfil</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="imgInp" accept="image/png, image/jpeg" required>
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
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                    <input type="hidden" name="id_user" value="{{ $usuario->id }}">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.card -->




        </div>
    </div>
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

