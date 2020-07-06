@extends("layouts.admin.layout")
@section('title', 'Noticias')
@section('noticias', 'active')
@section('container-title', 'Noticias')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('noticias.index') }}">Noticias Registradas</a></li>
    <li class="breadcrumb-item active">Nueva Noticia</li>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">


            {!! Form::open(['route' => 'noticias.store', 'method' => 'POST', 'files' => true]) !!}

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Nueva Noticia</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::text('titulo', null, ['class' => 'form-control', 'placeholder' => 'Titulo: ']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::text('lugar', null, ['class' => 'form-control', 'placeholder' => 'Lugar: ']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::date('fecha', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::textarea('resumen', null, ['class' => 'form-control', 'placeholder' => 'Resumen: ',
                                                                    'cols' => 30, 'rows' => 2]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'id' => 'compose-textarea',
                                                                        'style' => 'height: 300px']) !!}
                            </div>
                            <div class="form-group">
                                <div class="btn btn-default btn-file">
                                    <i class="fas fa-image"></i> Imagen
                                    {{--<input type="file" name="attachment">--}}
                                    {!! Form::file('imagen', ['accept' => 'image/png, image/jpeg', 'id' => 'imgInp']) !!}
                                </div>
                                <p class="help-block">Max. 32MB</p>
                            </div>
                            <div class="form-group text-center">
                                <img id="blah" src="" class="img-fluid" width="50%" height="50%" />
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="float-right">
                                {{--<button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button>--}}
                                <button type="submit" class="btn btn-success">{{--<i class="far fa-envelope"></i>--}} Guardar</button>
                            </div>
                            <a href="{{ route('noticias.index') }}" class="btn btn-default">{{--<i class="fas fa-times"></i> --}}Descartar</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            {!! Form::close() !!}



        </div>
    </div>
@endsection

@section('script')

    <script>
        $(function () {
            //Add text editor
            $('#compose-textarea').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname'],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table'],
                    ['link'],
                    ['video'],
                    ['fullscreen']
                ],
                placeholder: 'Descripcion: '
            })
        });

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


