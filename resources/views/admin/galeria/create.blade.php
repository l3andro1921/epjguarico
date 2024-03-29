@extends("layouts.admin.layout")
@section('galeria', 'active')
@section('container-title', 'Carga De Imagen')

@section('content')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('galeria.home') }}">Galeria</a></li>
    <li class="breadcrumb-item active">Cargar Imagen</li>
@endsection 

    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                {!! Form::open(['route' => 'galeria.create','method' => 'POST', 'files' => true, ]) !!}
                <div class="card-body">
                    <div class="form-group">
                        <label>Agregar Imagen a galeria</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="imgInp" accept="image/png, image/jpeg" required>
                                <label class="custom-file-label" for="exampleInputFile">Seleccionar Imagen</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center">
                        <img id="blah" src="" class="img-fluid" width="50%" height="50%" />
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer text-right">
                    <input type="hidden" name="id_user" value="#">
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