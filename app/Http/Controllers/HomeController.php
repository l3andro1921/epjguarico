<?php

namespace App\Http\Controllers;

use App\Datos_personal;
use App\Evento;
use App\Eventos_agenda;
use App\Http\Requests\Datos_personalRequest;
use App\Miembro;
use App\Miembros_tipo;
use App\Noticia;
use App\Participante;
use App\Representante;
use App\User;
use App\Users_image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$date = Carbon::createFromDate(1970,19,12)->age; // 43
        $edad = null;
        $representante = null;
        $tipo_miembro =  null;
        $actividades = null;
        $verificar = null;
		$eventos = null;
		$eventos2 = null;
		$mitipo = null;
        $date = new Carbon();
        $id = auth()->user()->id;
        $tipo = auth()->user()->type;

        if ($tipo == "Miembro"){

            $imagen = Users_image::where('users_id', $id)->first();
            $datos = Datos_personal::where('users_id', '=', $id)->first();
            if ($datos) {
                $representante = Representante::where('datos_id', $datos->id)->first();
                $explode = explode( '-', $datos->fecha_nac );
                $edad    = $date->createFromDate( $explode[0], $explode[1], $explode[2] )->age; // 43
                $miembro_user = Miembro::where('datos_id', '=', $datos->id)->first();
				if($miembro_user){
					$mitipo = Miembros_tipo::where('id', '=', $miembro_user->tipos_id)->first();
				}
                if ($mitipo){
                    $tipo_miembro = $mitipo->tipo_miembro;

                    //////////////////////////////////////////////////////////////////////////////
                    ///
                        $eventos = Evento::where('fecha_inicio', '>', $date->now())
                                         ->orderBY('updated_at', 'DESC')->paginate(10);

                        $eventos->each(function ($evento){
                            $participantes = Participante::where('eventos_id', '=', $evento->id)
                                                            ->orderBy('status', 'DESC')
                                                            ->get();
                            $participantes->each(function ($participante){
                                $agenda = Eventos_agenda::where('eventos_id', '=', $participante->eventos_id)
                                                        ->where('datos_id', '=', $participante->datos_id)
                                                        ->get();
                                $participante->agendas = $agenda;
                            });
                            $evento->participantes = $participantes;
                        });

                        //dd($eventos);

                    //////////////////////////////////////////////////////////////////////////////

                    $eventos2 = Evento::where('fecha_inicio', '<', $date->now())
                                     ->orderBY('fecha_inicio', 'DESC')->get();

                    $eventos2->each(function ($evento){
                        $participantes = Participante::where('eventos_id', '=', $evento->id)
                                                     ->orderBy('status', 'DESC')
                                                     ->get();
                        $participantes->each(function ($participante){
                            $agenda = Eventos_agenda::where('eventos_id', '=', $participante->eventos_id)
                                                    ->where('datos_id', '=', $participante->datos_id)
                                                    ->get();
                            $participante->agendas = $agenda;
                        });
                        $evento->participantes = $participantes;
                    });

                    //dd($eventos);
                    //////////////////////////////////////////////////////////////////////////////


                }
            }


            $entrada = array("bg-red", "bg-green", "bg-blue", "bg-yellow", "bg-purple", "bg-maroon", "bg-indigo",
                            "bg-lightblue", "bg-navy", "bg-fuchsia", "bg-pink", "bg-orange", "bg-lime", "bg-teal", "bg-olive");



            if ($imagen){
                return view('miembro.home')
                    ->with('imagen', $imagen)
                    ->with('edad', $edad)
                    ->with('tipo_miembro', $tipo_miembro)
                    ->with('representante', $representante)
                    ->with('datos', $datos)
                    ->with('actividades', $eventos)
                    ->with('timelines', $eventos2)
                    ->with('color', $entrada)
                    ->with('carbon', $date);
            }else{
                flash('<em>Para usar nuestra Plataforma Web <br>
                        requerimos que por favor subas <br>
                        tu foto de Perfil Actualizada</em>', 'warning')->important();
                return view('miembro.imagen.create')
                    ->with('imagen', $imagen)
                    ->with('edad', $edad)
                    ->with('tipo_miembro', $tipo_miembro)
                    ->with('representante', $representante)
                    ->with('datos', $datos);
            }


        }else{

            $imagen = Users_image::where('users_id', $id)->first();
            $datos = Datos_personal::where('users_id', '=', $id)->first();
            //(auth()->user()->images->user_id);
            if ($datos) {
                $representante = Representante::where('datos_id', $datos->id)->first();
                $explode = explode( '-', $datos->fecha_nac );
                $edad    = $date->createFromDate( $explode[0], $explode[1], $explode[2] )->age; // 43
            }
            if ($imagen){
                $usuarios = User::orderBy('created_at', 'DESC')->paginate(8);
                $usuarios->each(function ($usuario){
                    $imagen = Users_image::where('users_id', '=', $usuario->id)->first();
                    $usuario->imagen = $imagen;
                });
                $cnoticias = Noticia::count();
                $ceventos = Evento::count();
                $cusuarios = User::count();
                $cmiembros = Miembro::count();
                return view('admin.home')
                    ->with('imagen', $imagen)
                    ->with('usuarios', $usuarios)
                    ->with('carbon', $date)
                    ->with('cnoticias', $cnoticias)
                    ->with('ceventos', $ceventos)
                    ->with('cusuarios', $cusuarios)
                    ->with('cmiembros', $cmiembros);
            }else{
                flash('<em>Para usar nuestra Plataforma Web <br>
                        requerimos que por favor subas <br>
                        tu foto de Perfil Actualizada</em>', 'warning')->important();
                return view('miembro.imagen.create')
                    ->with('imagen', $imagen)
                    ->with('edad', $edad)
                    ->with('representante', $representante)
                    ->with('datos', $datos);
            }

        }
    }

    public function create()
    {
        $id = auth()->user()->id;
        $imagen = Users_image::where('users_id', $id)->first();
        $datos = Datos_personal::where('users_id', '=', $id)->first();
        return view('miembro.imagen.create')
            ->with('imagen', $imagen)
            ->with('datos', $datos);
    }

    public function store(Request $request)
    {
        $id = auth()->user()->id;

        if ($request->file('image')){
            // Manipulacion de Imagenes
            $file = $request->file('image');
            $name = 'img_user_id_'.$id.'.'.$file->getClientOriginalExtension();
            $path = public_path().'/img/users_img/';
            $file->move($path, $name);

            //guardamos en la base de datos
            $imagen = new Users_image();
            $imagen->users_id = $id;
            $imagen->nombre_imagen = $name;
            $imagen->save();

            flash('<em>Imagen Subida Exitosamente</em>', 'primary')->important();
            return redirect()->route('home');
        }
    }

    public function edit($id)
    {
        $edad = null;
        //$id = auth()->user()->id;
        $imagen = Users_image::find($id);
        $date = new Carbon();
        $datos = Datos_personal::where('users_id', '=', $id)->first();

        if ($datos) {
            $explode = explode( '-', $datos->fecha_nac );
            $edad    = $date->createFromDate( $explode[0], $explode[1], $explode[2] )->age; // 43
        }

        return view('miembro.imagen.edit')
            ->with('imagen', $imagen)
            ->with('datos', $datos)
            ->with('edad', $edad);
    }

    public function update(Request $request, $id)
    {
        $id_user = auth()->user()->id;
        if ($request->file('image')){
            // Manipulacion de Imagenes
            $file = $request->file('image');
            $name = 'img_user_id_'.$id_user.'.'.$file->getClientOriginalExtension();
            $path = public_path().'/img/users_img/';
            $file->move($path, $name);

            //guardamos en la base de datos
            $imagen = Users_image::find($id);
            $imagen->nombre_imagen = $name;
            $imagen->update();

            flash('<em>Imagen Subida Exitosamente</em>', 'primary')->important();
            return redirect()->route('home');
        }
    }

    public function datos_store(Datos_personalRequest $request)
    {
        $datos = new Datos_personal();

        $datos->users_id = $request->users_id;
        $datos->cedula = $request->cedula;
        $datos->nombre_completo = strtoupper($request->nombre_completo);
        $datos->fecha_nac = $request->fecha_nac;
        $datos->telefono = $request->telefono;
        $datos->lugar_nac = $request->lugar_nac;
        if ($request->estudio == null){
            $request->estudio = "NO";
            $request->nombre_estudio = null;
        }
        $datos->estudio = $request->estudio;
        $datos->nombre_estudio = strtoupper($request->nombre_estudio);
        if ($request->trabajo == null){ $request->trabajo = "NO"; }
        $datos->trabajo = $request->trabajo;
        $datos->nombre_trabajo = strtoupper($request->nombre_trabajo);
        $datos->cargo_trabajo = strtoupper($request->cargo_trabajo);
        $datos->pasatiempo = strtoupper($request->pasatiempo);
        if ($request->bautizo == null){ $request->bautizo = "NO"; }
        $datos->bautizo = $request->bautizo;
        if ($request->comunion == null){ $request->comunion = "NO"; }
        $datos->comunion = $request->comunion;
        if ($request->confirmacion == null){ $request->confirmacion = "NO";}
        $datos->confirmacion = $request->confirmacion;
        $datos->parroquia = strtoupper($request->parroquia);
        $datos->arquidiosesis = strtoupper($request->arquidiosesis);
        if ($request->grupo == null){ $request->grupo = "NO";}
        $datos->grupo = $request->grupo;
        $datos->nombre_grupo = strtoupper($request->nombre_grupo);
        $datos->tiempo_grupo = strtoupper($request->tiempo_grupo);
        $datos->practica_grupo = strtoupper($request->practica_grupo);
        $datos->motivo_registro = strtoupper($request->motivo_registro);
        $datos->referencia = strtoupper($request->referencia);
        $datos->sexo = $request->sexo;
        $datos->save();

        $representante = new Representante();

        $representante->datos_id = $datos->id;
        $representante->nombre_representante = strtoupper($request->nombre_representante);
        $representante->telefono_representante = $request->telefono_representante;
        $representante->save();

        flash('<em>Actualizado Exitosamente</em>', 'primary')->important();
        return redirect()->route('home');
    }

    public function datos_update(Request $request, $id)
    {
        $datos = Datos_personal::find($id);

       // dd($id);
        $datos->cedula = $request->cedula;
        $datos->nombre_completo = strtoupper($request->nombre_completo);
        $datos->fecha_nac = $request->fecha_nac;
        $datos->telefono = $request->telefono;
        $datos->lugar_nac = strtoupper($request->lugar_nac);
        if ($request->estudio == null){
            $request->estudio = "NO";
            $request->nombre_estudio = null;
        }
        $datos->estudio = $request->estudio;
        $datos->nombre_estudio = strtoupper($request->nombre_estudio);
        if ($request->trabajo == null){
            $request->trabajo = "NO";
            $request->nombre_trabajo = null;
            $request->cargo_trabajo = null;
        }
        $datos->trabajo = $request->trabajo;
        $datos->nombre_trabajo = strtoupper($request->nombre_trabajo);
        $datos->cargo_trabajo = strtoupper($request->cargo_trabajo);
        $datos->pasatiempo = strtoupper($request->pasatiempo);
        if ($request->bautizo == null){ $request->bautizo = "NO"; }
        $datos->bautizo = $request->bautizo;
        if ($request->comunion == null){ $request->comunion = "NO"; }
        $datos->comunion = $request->comunion;
        if ($request->confirmacion == null){ $request->confirmacion = "NO";}
        $datos->confirmacion = $request->confirmacion;
        $datos->parroquia = strtoupper($request->parroquia);
        $datos->arquidiosesis = strtoupper($request->arquidiosesis);
        if ($request->grupo == null){
            $request->grupo = "NO";
            $request->nombre_grupo = null;
            $request->tiempo_grupo = null;
            $request->practica_grupo = null;
        }
        $datos->grupo = $request->grupo;
        $datos->nombre_grupo = strtoupper($request->nombre_grupo);
        $datos->tiempo_grupo = strtoupper($request->tiempo_grupo);
        $datos->practica_grupo = strtoupper($request->practica_grupo);
        $datos->motivo_registro = strtoupper($request->motivo_registro);
        if ($request->referido == null){
            $request->referencia = null;
        }
        $datos->referencia = strtoupper($request->referencia);
        $datos->sexo = $request->sexo;
        $datos->update();

        $representante = Representante::where('datos_id', '=', $id)->first();
        $representante->datos_id = $datos->id;
        $representante->nombre_representante = strtoupper($request->nombre_representante);
        $representante->telefono_representante = $request->telefono_representante;
        $representante->update();

        flash('<em>Actualizado Exitosamente</em>', 'primary')->important();
        return redirect()->route('home');
        //dd($request->all());
    }

    public function settings_update(Request $request, $id)
    {
        $user = User::find($id);
        $clave = $request->clave;

        if (Hash::check($clave, $user->password)) {
            $user->fill($request->all());
            $user->update();
            flash('<em>Actualizado Exitosamente</em>', 'primary')->important();
            return redirect()->route('home');
        }else{
            flash('<em>Clave Incorrecta</em>', 'warning')->important();
            return redirect()->route('home');
        }


    }

    public function seguridad_update(Request $request, $id)
    {
        $user = User::find($id);
        $clave = $request->actual;

        if (Hash::check($clave, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->update();
            flash('<em>Actualizado Exitosamente</em>', 'primary')->important();
            return redirect()->route('home');
        }else{
            flash('<em>Clave Incorrecta</em>', 'warning')->important();
            return redirect()->route('home');
        }


    }

}
