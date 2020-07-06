<?php

namespace App\Http\Controllers;

use App\Datos_personal;
use App\Evento;
use App\Eventos_agenda;
use App\Eventos_cerrado;
use App\Eventos_rango;
use App\Eventos_tipo;
use App\Miembro;
use App\Miembros_tipo;
use App\Participante;
use App\Users_image;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventosMiembrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carbon = new Carbon();
        $edad = null;
        $tipo_miembro = null;
		$mitipo = null;
        $id = auth()->user()->id;
        $imagen = Users_image::where('users_id', '=', $id)->first();

        if (!$imagen){
            return redirect()->route('home');
        }

        $date = new Carbon();
        $datos = Datos_personal::where('users_id', '=', $id)->first();

        if ($datos) {
            $explode = explode( '-', $datos->fecha_nac );
            $edad    = $date->createFromDate( $explode[0], $explode[1], $explode[2] )->age; // 43
            $miembro_user = Miembro::where('datos_id', '=', $datos->id)->first();
			if($miembro_user){
				$mitipo = Miembros_tipo::where('id', '=', $miembro_user->tipos_id)->first();
			}
            
            if ($mitipo){
                $tipo_miembro = $mitipo->tipo_miembro;
            }
        }

        $eventos = Evento::whereYear('fecha_inicio', date('Y'))->orderBy('fecha_inicio', 'DESC')->paginate(10);
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

        return view('miembro.eventos.index')
            ->with('imagen', $imagen)
            ->with('datos', $datos)
            ->with('edad', $edad)
            ->with('tipo_miembro', $tipo_miembro)
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $evento = Evento::find($request->id);
        $participante = new Participante();
        $participante->eventos_id = $request->id;
        $participante->datos_id = $request->datos_id;
        $participante->status = "Inscrito";
        $participante->save();

        $confirmados = $evento->confirmados + 1;
        $evento->confirmados = $confirmados;
        $evento->update();

        $datos = Datos_personal::find($request->datos_id);

        flash('<strong><i class="far fa-flag"></i>
                    '.strtoupper($datos->nombre_completo).'</strong> <em>Agreagado Exitosamente</em>', 'success')->important();
        return redirect()->route('mieventos.show', $request->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $boton = null;
        $mensaje = null;
        $edad = null;
        $tipo_miembro = null;
        $verificar = null;
		$mitipo = null;
        $id_user = auth()->user()->id;

        $imagen = Users_image::where('users_id', '=', $id_user)->first();
        if (!$imagen){
            return redirect()->route('home');
        }

        $carbon = new Carbon();
        $evento = Evento::find($id);
        $date = new Carbon();

        $datos = Datos_personal::where('users_id', '=', $id_user)->first();

        if ($datos) {
            $explode = explode( '-', $datos->fecha_nac );
            $edad    = $date->createFromDate( $explode[0], $explode[1], $explode[2] )->age; // 43
            $miembro_user = Miembro::where('datos_id', '=', $datos->id)->first();
            if($miembro_user){
				$mitipo = Miembros_tipo::where('id', '=', $miembro_user->tipos_id)->first();
			}
            if ($mitipo){
                $tipo_miembro = $mitipo->tipo_miembro;
            }

            if($evento->status != "Libre"){
                $miembro = Miembro::where('datos_id', '=', $datos->id)->first();
                if($miembro){

                    if ($evento->status == "Abierto"){

                        $verificar = Eventos_rango::where('tipos_id', '=', $evento->tipos_id)->where('miembros_tipos_id', '=', $miembro->tipos_id)->first();
                        if (!$verificar){
                            $boton = "disabled";
                            $mensaje = "No eres del tipos de miembro aceptado <br> Consulta con tu Administrador";
                        }

                    }else{

                        $verificar = Eventos_cerrado::where('eventos_id', '=', $evento->id)->where('datos_id', '=', $datos->id)->first();
                        if(!$verificar){
                            $boton = "disabled";
                            $mensaje = "NO estas en la lista de Invitados <br> Consulta con tu administrador";
                        }

                    }

                }else{
                    $boton = "disabled";
                    $mensaje = "Aun no eres Miembro Activo <br> Consulta con tu Administrador";
                }
            }


        }else{
            $boton = 'disabled';
            $mensaje = "Para participar completa tus <strong>Datos Personales</strong>
                        <br> en <span class='text-primary'>Home</span>, Pestaña <span class='text-primary'>Datos Personales</span>";
        }

        $img_coordinador = null;
        $img_administrador = null;
        $img_asesor = null;



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



        return view('miembro.eventos.show')
            ->with('imagen', $imagen)
            ->with('datos', $datos)
            ->with('edad', $edad)
            ->with('tipo_miembro', $tipo_miembro)
            ->with('carbon', $carbon)
            ->with('evento', $evento)
            ->with('coordinador', $coordinador)
            ->with('administrador', $administrador)
            ->with('asesor', $asesor)
            ->with('img_coordinador', $img_coordinador)
            ->with('img_administrador', $img_administrador)
            ->with('img_asesor', $img_asesor)
            ->with('participantes', $participantes)
            ->with('rangos', $rangos)
            ->with('boton', $boton)
            ->with('mensaje', $mensaje);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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
        return redirect()->route('mieventos.show', $volver);

    }
}
