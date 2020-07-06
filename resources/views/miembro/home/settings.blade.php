<div class="tab-pane" id="settings">


    <div class="row justify-content-center">
        <div class="col-md-6">



            <!-- general form elements -->
            <div class="card bg-gradient-lightblue">
                <!-- form start -->
                {!! Form::open(['route' => ['settings.update', auth()->user()->id], 'method' => 'PUT', 'role' => 'form']) !!}
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        {!! Form::text('name', auth()->user()->name, ['class' => 'form-control', 'placeholder' => __('Name'), 'required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        {!! Form::email('email', auth()->user()->email, ['class'=> 'form-control', 'placeholder' => __('E-Mail Address'), 'required']) !!}
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer text-right">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-sm-user">Guardar</button>
                </div>



                <div class="modal fade" id="modal-sm-user">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-muted">Ingrese Clave</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input class="form-control" type="password" name="clave" placeholder="Ingrese Clave" required>
                                </div>
                                <div class="form-group float-right">
                                    {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                                    <button type="submit" class="btn btn-primary">Confirmar</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->





                {!! Form::close() !!}
            </div>
            <!-- /.card -->




        </div>
    </div>


</div>
