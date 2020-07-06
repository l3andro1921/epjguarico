<div class="tab-pane" id="settings">


    <div class="row justify-content-center">
        <div class="col-md-6">



            <!-- general form elements -->
            <div class="card bg-gradient-lightblue">
                <!-- form start -->
                {!! Form::open(['route' => ['seguridad.update', auth()->user()->id], 'method' => 'PUT', 'role' => 'form']) !!}
                <div class="card-body">

                    <div class="form-group">
                        <label for="actual">{{ __('Password') }} Actual</label>
                        {!! Form::password('actual', ['class' => 'form-control', 'placeholder' => __('Contraseña Actual'), 'required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="password">Nueva {{ __('Password') }}</label>
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => __('Nueva Contraseña'), 'required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="confirmar">{{ __('Confirm Password') }}</label>
                        {!! Form::password('confirmar', ['class' => 'form-control', 'placeholder' => __('Confirmar contraseña'), 'required']) !!}
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer text-right">
                    <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.card -->




        </div>
    </div>


</div>
