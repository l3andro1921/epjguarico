<?php

namespace App\Http\Controllers;

use App\Datos_personal;
use App\Evento;
use App\Eventos_agenda;
use App\Eventos_cerrado;
use App\Eventos_rango;
use App\Eventos_tipo;
use App\Http\Requests\EventoRequest;
use App\Miembro;
use App\Miembros_tipo;
use App\Participante;
use App\Users_image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('home');
        }
        $imagen = Users_image::where('users_id', auth()->user()->id)->first();
        $carbon = new Carbon();
        $eventos = Evento::buscar($request->buscar)->orderBy('fecha_inicio', 'DESC')->paginate(10);
        $eventos->each(function ($evento){
            $tipo = Eventos_tipo::find($evento->tipos_id);
            $evento->tipos = $tipo->tipo_evento;
            $coordinador = Datos_personal::where('id', '=', $evento->id_coordinador)->first();
            $administrador = Datos_personal::where('id', '=', $evento->id_administrador)->first();
            $asesor = Datos_personal::where('id', '=', $evento->id_asesor)->first();

            if($coordinador){
                $evento->img_coordinador = Users_image::where('users_id', $coordinador->users->id)->first();
            }
            if ($administrador){
                $evento->img_administrador = Users_image::where('users_id', $administrador->users->id)->first();
            }
            if($asesor){
                $evento->img_asesor = Users_image::where('users_id', $asesor->users->id)->first();
            }

        });
        return view('admin.eventos.index')
            ->with('imagen', $imagen)
            ->with('eventos', $eventos)
            ->with('carbon', $carbon);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('home');
        }
        $imagen = Users_image::where('users_id', auth()->user()->id)->first();
        $tipos = Eventos_tipo::orderBy('tipo_evento', 'ASC')->pluck('tipo_evento', 'id');
        $miembros = Datos_personal::all()->pluck('nombre_completo', 'id');
        return view('admin.eventos.create')
            ->with('imagen', $imagen)
            ->with('tipos', $tipos)
            ->with('miembros', $miembros);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventoRequest $request)
    {
        $evento = new Evento($request->all());
        $evento->save();

        if($request->id_coordinador){
            $participante = new Participante();
            $participante->eventos_id = $evento->id;
            $participante->datos_id = $request->id_coordinador;
            $participante->status = "TEAM";
            $participante->save();
        }

        if($request->id_administrador){
            $participante = new Participante();
            $participante->eventos_id = $evento->id;
            $participante->datos_id = $request->id_administrador;
            $participante->status = "TEAM";
            $participante->save();
        }

        if($request->id_asesor){
            $participante = new Participante();
            $participante->eventos_id = $evento->id;
            $participante->datos_id = $request->id_asesor;
            $participante->status = "TEAM";
            $participante->save();
        }

        flash('<a href="'.route('eventos.edit', $evento->id).'"><strong><i class="far fa-flag"></i>
                '.strtoupper($evento->nombre_evento).'</strong></a> <em>Creado Exitosamente</em>', 'success')->important();
        if ($evento->status == "Cerrado"){
            return redirect()->route('eventos.cerrado.show', $evento->id);
        }else{
            return  redirect()->route('eventos.show', $evento->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('home');
        }
        $img_coordinador = null;
        $img_administrador = null;
        $img_asesor = null;

        $imagen = Users_image::where('users_id', auth()->user()->id)->first();
        $carbon = new Carbon();
        $evento = Evento::find($id);

        $coordinador = Datos_personal::where('id', '=', $evento->id_coordinador)->first();
        $administrador = Datos_personal::where('id', '=', $evento->id_administrador)->first();
        $asesor = Datos_personal::where('id', '=', $evento->id_asesor)->first();

        if($coordinador){
            $img_coordinador = Users_image::where('users_id', $coordinador->users->id)->first();
        }
        if ($administrador){
            $img_administrador = Users_image::where('users_id', $administrador->users->id)->first();
        }
        if($asesor){
            $img_asesor = Users_image::where('users_id', $asesor->users->id)->first();
        }


        $rangos = Eventos_agenda::where('eventos_id', '=', $id)->get();
        $rangos->each(function ($rango){
            $datos = Datos_personal::find($rango->datos_id);
            $rango->nombre_completo = $datos->nombre_completo;
            $rango->img = Users_image::where('users_id', $datos->users->id)->first();
            $miembro = Miembro::where('datos_id', '=', $datos->id)->first();
            //dd($datos->id);
            if ($miembro) {
                $tipo        = Miembros_tipo::where( 'id', '=', $miembro->tipos_id )->first();
                $rango->tipo = $tipo->tipo_miembro;
            }
        });

        $participantes = Participante::where('eventos_id', '=', $evento->id)->where('status', '=', "Inscrito")->get();
        $participantes->each(function ($participante){
            $datos = Datos_personal::find($participante->datos_id);
            $participante->img = Users_image::where('users_id', $datos->users->id)->first();
            $participante->nombre_completo = $datos->nombre_completo;
            $participante->cedula = $datos->cedula;
            $participante->telefono = $datos->telefono;
            $participante->sexo = $datos->sexo;
            $participante->parroquia = $datos->parroquia;
            $participante->arquidiosesis = $datos->arquidiosesis;
        });

        return view('admin.eventos.show')
            ->with('imagen', $imagen)
            ->with('carbon', $carbon)
            ->with('evento', $evento)
            ->with('coordinador', $coordinador)
            ->with('administrador', $administrador)
            ->with('asesor', $asesor)
            ->with('img_coordinador', $img_coordinador)
            ->with('img_administrador', $img_administrador)
            ->with('img_asesor', $img_asesor)
            ->with('participantes', $participantes)
            ->with('rangos', $rangos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('home');
        }
        $imagen = Users_image::where('users_id', auth()->user()->id)->first();
        $evento = Evento::find($id);
        $tipos = Eventos_tipo::orderBy('tipo_evento', 'ASC')->pluck('tipo_evento', 'id');
        $miembros = Datos_personal::all()->pluck('nombre_completo', 'id');
        return view('admin.eventos.edit')
            ->with('imagen', $imagen)
            ->with('tipos', $tipos)
            ->with('miembros', $miembros)
            ->with('evento', $evento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventoRequest $request, $id)
    {
        $evento = Evento::find($id);
        //dd($evento->id_coordinador.' - Nu '.$request->id_coordinador);
        if($request->id_coordinador){
            if($evento->id_coordinador == null){
                $participante = new Participante();
                $participante->eventos_id = $evento->id;
                $participante->datos_id = $request->id_coordinador;
                $participante->status = "TEAM";
                $participante->save();
            }else{
                //dd($evento->id.' - Nu '.$evento->id_coordinador);
                if ($evento->id_coordinador != $request->id_coordinador){
                    $revisar = Participante::where('eventos_id', '=', $evento->id)
                                           ->where('datos_id', '=', $evento->id_coordinador)
                                           ->where('status', "TEAM")
                                           ->first();
                    $participante = Participante::find($revisar->id);
                    $participante->datos_id = $request->id_coordinador;
                    $participante->update();
                }
            }
        }else{

            if($evento->id_coordinador != null){
                $revisar = Participante::where('eventos_id', '=', $evento->id)
                                        ->where('datos_id', '=', $evento->id_coordinador)
                                        ->where('status', "TEAM")
                                        ->first();
                $participante = Participante::find($revisar->id);
                $participante->delete();
            }

        }

        if($request->id_administrador){
            if($evento->id_administrador == null){
                $participante = new Participante();
                $participante->eventos_id = $evento->id;
                $participante->datos_id = $request->id_administrador;
                $participante->status = "TEAM";
                $participante->save();
            }else{
                //dd($evento->id.' - Nu '.$evento->id_coordinador);
                if ($evento->id_administrador != $request->id_administrador){
                    $revisar = Participante::where('eventos_id', '=', $evento->id)
                                            ->where('datos_id', '=', $evento->id_administrador)
                                            ->where('status', "TEAM")
                                            ->first();
                    $participante = Participante::find($revisar->id);
                    $participante->datos_id = $request->id_administrador;
                    $participante->update();
                }
            }
        }else{

            if($evento->id_administrador != null){
                $revisar = Participante::where('eventos_id', '=', $evento->id)
                                        ->where('datos_id', '=', $evento->id_administrador)
                                        ->where('status', "TEAM")
                                        ->first();
                $participante = Participante::find($revisar->id);
                $participante->delete();
            }

        }

        if($request->id_asesor){
            if($evento->id_asesor == null){
                $participante = new Participante();
                $participante->eventos_id = $evento->id;
                $participante->datos_id = $request->id_asesor;
                $participante->status = "TEAM";
                $participante->save();
            }else{
                //dd($evento->id.' - Nu '.$evento->id_coordinador);
                if ($evento->id_asesor != $request->id_asesor){
                    $revisar = Participante::where('eventos_id', '=', $evento->id)
                                            ->where('datos_id', '=', $evento->id_asesor)
                                            ->where('status', "TEAM")
                                            ->first();

                    $participante = Participante::find($revisar->id);
                    $participante->datos_id = $request->id_asesor;
                    $participante->update();
                }
            }
        }else{

            if($evento->id_asesor != null){
                $revisar = Participante::where('eventos_id', '=', $evento->id)
                                        ->where('datos_id', '=', $evento->id_asesor)
                                        ->where('status', "TEAM")
                                        ->first();
                $participante = Participante::find($revisar->id);
                $participante->delete();
            }

        }

        $evento->fill($request->all());
        if ($request->pago == null){
            $evento->pago = null;
            $evento->monto_pago = null;
        }
        $evento->update();



        flash('<a href="'.route('eventos.edit', $evento->id).'"><strong><i class="far fa-flag"></i>
                '.strtoupper($evento->nombre_evento).'</strong></a> <em>Editado Exitosamente</em>', 'primary')->important();
        return  redirect()->route('eventos.show', $evento->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evento = Evento::find($id);
        $evento->delete();

        flash('<strong><i class="far fa-flag"></i>
                '.strtoupper($evento->nombre_evento).'</strong> <em>Eliminado Exitosamente</em>', 'danger')->important();
        return redirect()->route('eventos.index');
    }

    public function cerrado_show($id)
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('home');
        }
        $imagen = Users_image::where('users_id', auth()->user()->id)->first();
        $carbon = new Carbon();
        $evento = Evento::find($id);
        $miembros = Datos_personal::all()->pluck('nombre_completo', 'id');

        $rangos = Eventos_cerrado::where('eventos_id', '=', $id)->get();
        $rangos->each(function ($rango){
            $datos = Datos_personal::find($rango->datos_id);
            $rango->img = Users_image::where('users_id', $datos->users->id)->first();
            $rango->nombre_completo = $datos->nombre_completo;
            $rango->cedula = $datos->cedula;
            $rango->telefono = $datos->telefono;
            $rango->sexo = $datos->sexo;
            $rango->parroquia = $datos->parroquia;
            $rango->arquidiosesis = $datos->arquidiosesis;

        });
        $cupos = $evento->cupos - $rangos->count();
        return view('admin.eventos.cerrado')
            ->with('imagen', $imagen)
            ->with('carbon', $carbon)
            ->with('evento', $evento)
            ->with('miembros', $miembros)
            ->with('rangos', $rangos)
            ->with('cupos', $cupos);
    }

    public function cerrado_store(Request $request, $id)
    {
        $evento = Evento::find($id);
        $cedula = $request->cedula;
        $datos = Datos_personal::where('cedula', '=', $cedula)->first();

        if ($datos){

            $miembro = Miembro::where('datos_id', '=', $datos->id)->first();

            if ($miembro){
				$tipo = Miembros_tipo::find($miembro->tipos_id);
                $rango = Eventos_rango::where('miembros_tipos_id', '=', $tipo->id)->where('tipos_id', '=', $evento->tipos_id)->first();
                if ($rango){

                    $cerrado = new Eventos_cerrado();
                    $cerrado->eventos_id = $id;
                    $cerrado->datos_id = $datos->id;
                    $cerrado->save();

                    flash('<a href="'.route('eventos.edit', $evento->id).'"><strong><i class="far fa-flag"></i>
                '.strtoupper($datos->nombre_completo).'</strong></a> <em>Agreagado Exitosamente</em>', 'success')->important();
                    return redirect()->route('eventos.cerrado.show', $id);

                }else{

                    flash('<a href="'.route('eventos.edit', $evento->id).'"><strong><i class="far fa-flag"></i>
                '.strtoupper($datos->nombre_completo).'</strong></a> <em> No es del tipo de Miembro Permitido para este Evento</em>', 'warning')->important();
                    return redirect()->route('eventos.cerrado.show', $id);

                }

            }else{

                flash('<a href="'.route('eventos.edit', $evento->id).'"><strong><i class="far fa-flag"></i>
                '.strtoupper($datos->nombre_completo).'</strong></a> <em> Aun NO ha sido Agregado Como Miembro</em>', 'warning')->important();
                return redirect()->route('eventos.cerrado.show', $id);
            }


        }else{

            flash(' Cedula <strong>'.$cedula.'</strong> 
                    <em> NO encontrada</em>', 'danger')->important();
            return redirect()->route('eventos.cerrado.show', $id);

        }


        /*flash('<a href="'.route('eventos.edit', $evento->id).'"><strong><i class="far fa-flag"></i>
                '.strtoupper($evento->nombre_evento).'</strong></a> <em>Creado Exitosamente</em>', 'success')->important();
        return redirect()->route('eventos.index');*/
    }

    public function cerrado_destroy($id)
    {
        $evento = Eventos_cerrado::find($id);
        $volver = $evento->eventos_id;
        $datos = Datos_personal::where('id', '=', $evento->datos_id)->first();
        $evento->delete();

        flash('<strong><i class="far fa-flag"></i>
                '.strtoupper($datos->nombre_completo).'</strong> <em>Eliminado Exitosamente</em>', 'danger')->important();
        return redirect()->route('eventos.cerrado.show', $volver);
    }

    public function asistencia_show($id)
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('home');
        }
        $imagen = Users_image::where('users_id', auth()->user()->id)->first();
        $carbon = new Carbon();
        $evento = Evento::find($id);
        $miembros = Datos_personal::all()->pluck('nombre_completo', 'id');

        $rangos = Participante::where('eventos_id', '=', $id)->get();
        $rangos->each(function ($rango){
            $datos = Datos_personal::find($rango->datos_id);
            $rango->img = Users_image::where('users_id', $datos->users->id)->first();
            $rango->nombre_completo = $datos->nombre_completo;
            $rango->cedula = $datos->cedula;
            $rango->telefono = $datos->telefono;
            $rango->sexo = $datos->sexo;
            $rango->parroquia = $datos->parroquia;
            $rango->arquidiosesis = $datos->arquidiosesis;

        });
        $cupos = $evento->cupos - $rangos->count();
        return view('admin.eventos.asistencia')
            ->with('imagen', $imagen)
            ->with('carbon', $carbon)
            ->with('evento', $evento)
            ->with('miembros', $miembros)
            ->with('rangos', $rangos)
            ->with('cupos', $cupos);
    }

    public function asistencia_update(Request $request, $id)
    {
        $asistencia = null;
        $id_ = null;
        $participante = null;
        for ($i = 1; $i <= $request->cont; $i++){
          $asistencia = request('asistencia_'.$i);
          $id_ = request('id_'.$i);
          $participante = Participante::find($id_);
          $participante->asistencia = $asistencia;
          $participante->update();
        }

        flash('<em>Asistencia Guardada Exitosamente</em>', 'primary')->important();
        return  redirect()->route('eventos.show', $id);
    }

    public function participante_store(Request $request, $id)
    {
        $evento = Evento::find($id);
        $cedula = $request->cedula;
        $datos = Datos_personal::where('cedula', '=', $cedula)->first();

        if ($datos){

            if ($evento->status == "Libre"){

                $participante = new Participante();
                $participante->eventos_id = $id;
                $participante->datos_id = $datos->id;
                $participante->status = "Inscrito";
                $participante->save();

                $confirmados = $evento->confirmados +1;
                $evento->confirmados = $confirmados;
                $evento->update();

                flash('<strong><i class="far fa-flag"></i>
                    '.strtoupper($datos->nombre_completo).'</strong> <em>Agreagado Exitosamente</em>', 'success')->important();
                return redirect()->route('eventos.show', $id);

            }
            /////////////////////////////////////////////////////////////////////////////////////////////////////////
                $miembro = Miembro::where('datos_id', '=', $datos->id)->first();

                if ($miembro){
					$tipo = Miembros_tipo::find($miembro->tipos_id);
                    $rango = Eventos_rango::where('miembros_tipos_id', '=', $tipo->id)->where('tipos_id', '=', $evento->tipos_id)->first();
                    if ($rango){

                        if ($evento->status == "Abierto"){

                            $participante = new Participante();
                            $participante->eventos_id = $id;
                            $participante->datos_id = $datos->id;
                            $participante->status = "Inscrito";
                            $participante->save();

                            $confirmados = $evento->confirmados +1;
                            $evento->confirmados = $confirmados;
                            $evento->update();

                            flash('<strong><i class="far fa-flag"></i>
                    '.strtoupper($datos->nombre_completo).'</strong> <em>Agreagado Exitosamente</em>', 'success')->important();
                            return redirect()->route('eventos.show', $id);

                        }else{

                            $cerrado = Eventos_cerrado::where('eventos_id', '=', $evento->id)->where('datos_id', '=', $datos->id)->first();

                            if($cerrado){

                                $participante = new Participante();
                                $participante->eventos_id = $id;
                                $participante->datos_id = $datos->id;
                                $participante->status = "Inscrito";
                                $participante->save();

                                $confirmados = $evento->confirmados +1;
                                $evento->confirmados = $confirmados;
                                $evento->update();

                                flash('<strong><i class="far fa-flag"></i>
                    '.strtoupper($datos->nombre_completo).'</strong> <em>Agreagado Exitosamente</em>', 'success')->important();
                                return redirect()->route('eventos.show', $id);

                            }else{

                                flash('<strong><i class="far fa-flag"></i>
                    '.strtoupper($datos->nombre_completo).'</strong> <em> No esta en la Lista de Invitados.</em>', 'warning')->important();
                                return redirect()->route('eventos.show', $id);
                            }

                        }



                    }else{

                        flash('<strong><i class="far fa-flag"></i>
                    '.strtoupper($datos->nombre_completo).'</strong> <em> No es del tipo de Miembro Permitido para este Evento</em>', 'warning')->important();
                        return redirect()->route('eventos.show', $id);

                    }

                }else{

                    flash('<strong><i class="far fa-flag"></i>
                    '.strtoupper($datos->nombre_completo).'</strong> <em> Aun NO ha sido Agregado Como Miembro</em>', 'warning')->important();
                    return redirect()->route('eventos.show', $id);
                }

            //////////////////////////////////////////////////////////////////////////////////////////////////////

        }else{

            flash(' Cedula <strong>'.$cedula.'</strong> 
                    <em> NO encontrada</em>', 'danger')->important();
            return redirect()->route('eventos.show', $id);

        }

    }

    public function participante_destroy($id)
    {
        $evento = Participante::find($id);
        $volver = $evento->eventos_id;
        $min = Evento::find($volver);
        $datos = Datos_personal::where('id', '=', $evento->datos_id)->first();
        $evento->delete();

        $confirmados = $min->confirmados - 1;
        $min->confirmados = $confirmados;
        $min->update();

        flash('<strong><i class="far fa-flag"></i>
                '.strtoupper($datos->nombre_completo).'</strong> <em>Eliminado Exitosamente</em>', 'danger')->important();
        return redirect()->route('eventos.show', $volver);
    }

}
