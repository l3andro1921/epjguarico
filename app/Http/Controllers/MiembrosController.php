<?php

namespace App\Http\Controllers;

use App\Comunidad;
use App\Datos_personal;
use App\Evento;
use App\Eventos_agenda;
use App\Http\Requests\Miembros_tipoRequest;
use App\Iglesia;
use App\Miembro;
use App\Miembros_tipo;
use App\Participante;
use App\Users_image;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MiembrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('home');
        }
        $imagen = Users_image::where('users_id', auth()->user()->id)->first();
        $tipos = Miembros_tipo::orderBy('tipo_miembro', 'ASC')->get();
        $tipos->each(function ($tipo){
            $tipo->miembros = Miembro::where('tipos_id', '=', $tipo->id)->count();
        });
        $miembros = Miembro::orderBy('id', 'DESC')->paginate(10);
        $miembros->each(function ($miembro){
            $miembro->datos;
            $miembro->tipos;
            $miembro->comunidades;
        });
        //dd($miembros);
        return view('admin.miembros.index')
            ->with('imagen', $imagen)
            ->with('miembros', $miembros)
            ->with('tipos', $tipos);
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
        $miembro = new Miembro($request->all());
        $miembro->save();

        flash('<a href="'.route('miembros.edit', $miembro->id).'"><strong><i class="fas fa-user"></i> 
                Miembro </strong></a> <em>Creado Exitosamente</em>', 'success')->important();
        return redirect()->route('miembros.index');
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
        $imagen = Users_image::where('users_id', auth()->user()->id)->first();
        $tipos = Miembros_tipo::orderBy('tipo_miembro', 'ASC')->get();
        $tipos->each(function ($tipo){
            $tipo->miembros = Miembro::where('tipos_id', '=', $tipo->id)->count();
        });
        $miembros = Miembro::where('tipos_id', '=', $id)->orderBy('id', 'DESC')->paginate(10);
        $miembros->each(function ($miembro){
            $miembro->datos;
            $miembro->tipos;
            $miembro->comunidades;
        });
        //dd($miembros);
        return view('admin.miembros.index')
            ->with('imagen', $imagen)
            ->with('miembros', $miembros)
            ->with('tipos', $tipos);
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
        $miembro = Miembro::find($id);
        /*$miembros->each(function ($miembro){
            $miembro->datos;
            $miembro->tipos;
            $miembro->comunidades;
        });*/
        $tipos = Miembros_tipo::orderBy('tipo_miembro', 'ASC')->pluck('tipo_miembro', 'id');
        $comunidades = Comunidad::orderBy('nombre_comunidad', 'ASC')->pluck('nombre_comunidad', 'id');
        $datos = Datos_personal::where('id', '=', $miembro->datos_id)->first();
        $user_imagen = Users_image::where('users_id', $datos->users->id)->first();

        return view('admin.miembros.edit')
            ->with('imagen', $imagen)
            ->with('tipos', $tipos)
            ->with('comunidades', $comunidades)
            ->with('miembro', $miembro)
            ->with('user_imagen', $user_imagen);
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
        $miembro = Miembro::find($id);
        $miembro->fill($request->all());
        $miembro->update();

        flash('<a href="'.route('miembros.edit', $miembro->id).'"><strong><i class="fas fa-user"></i> 
                Miembro </strong></a> <em>Editado Exitosamente</em>', 'info')->important();
        return redirect()->route('miembros.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $miembro = Miembro::find($id);
        $miembro->delete();

        flash('<a href="'.route('miembros.index', $miembro->id).'"><strong><i class="fas fa-user"></i> 
                Miembro </strong></a> <em>Eliminado Exitosamente</em>', 'danger')->important();
        return redirect()->route('miembros.index');
    }

    public function create_tipos()
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('home');
        }
        $imagen = Users_image::where('users_id', auth()->user()->id)->first();
        $tipos = Miembros_tipo::orderBy('tipo_miembro', 'ASC')->get();
        return view('admin.miembros.create_tipos')
            ->with('imagen', $imagen)
            ->with('tipos', $tipos);
    }

    public function store_tipos(Miembros_tipoRequest $request)
    {
        $tipo = new Miembros_tipo();
        $tipo->tipo_miembro = strtoupper($request->tipo_miembro);
        $tipo->save();

        flash('<a href="'.route('miembros_tipos.edit', $tipo->id).'"><strong><i class="fas fa-cog"></i> 
                '.strtoupper($request->tipo_miembro).'</strong></a> <em>Creado Exitosamente</em>', 'success')->important();
        return redirect()->route('miembros.index');
    }

    public function edit_tipos($id)
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('home');
        }
        $imagen = Users_image::where('users_id', auth()->user()->id)->first();
        $actual = Miembros_tipo::find($id);
        $tipos = Miembros_tipo::orderBy('tipo_miembro', 'ASC')->get();
        return view('admin.miembros.edit_tipos')
            ->with('imagen', $imagen)
            ->with('actual', $actual)
            ->with('tipos', $tipos);
    }

    public function update_tipos(Miembros_tipoRequest $request, $id)
    {
        $tipo = Miembros_tipo::find($id);
        $tipo->tipo_miembro = strtoupper($request->tipo_miembro);
        $tipo->update();

        flash('<a href="'.route('miembros_tipos.edit', $tipo->id).'"><strong><i class="fas fa-cog"></i> 
                '.strtoupper($request->tipo_miembro).'</strong></a> <em>Editado Exitosamente</em>', 'info')->important();
        return redirect()->route('miembros.index');
    }

    public function destroy_tipos($id)
    {
        $tipo = Miembros_tipo::find($id);
        $tipo->delete();

        flash('<a href="'.route('miembros.index').'"><strong><i class="fas fa-cog"></i> 
                '.strtoupper($tipo->tipo_miembro).'</strong></a> <em>Eliminado Exitosamente</em>', 'danger')->important();
        return redirect()->route('miembros.index');
    }

    public function create_cedula(Request $request)
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('home');
        }
        $imagen = Users_image::where('users_id', auth()->user()->id)->first();
        $datos = Datos_personal::where('cedula', '=', $request->cedula)->first();
        //dd($datos->cedula);
        if ($datos){
            $miembro = Miembro::where('datos_id', '=', $datos->id)->first();

            if (!$miembro){
                $tipos = Miembros_tipo::orderBy('tipo_miembro', 'ASC')->pluck('tipo_miembro', 'id');
                $comunidades = Comunidad::orderBy('nombre_comunidad', 'ASC')->pluck('nombre_comunidad', 'id');

                $user_imagen = Users_image::where('users_id', $datos->users->id)->first();

                return view('admin.miembros.create_cedula')
                    ->with('imagen', $imagen)
                    ->with('tipos', $tipos)
                    ->with('comunidades', $comunidades)
                    ->with('datos', $datos)
                    ->with('user_imagen', $user_imagen);
            }else{
                flash('<a href="'.route('miembros.index').'"><strong><i class="fas fa-search"></i> 
                '.strtoupper($request->cedula).'</strong></a> <em> Miembro Registrado </em>', 'info')->important();
                return redirect()->route('miembros.index');
            }

        }else{
            flash('<em> Sin resultados para </em> <a href="'.route('miembros.index').'"><strong><i class="fas fa-search"></i> 
                '.strtoupper($request->cedula).'</strong></a>', 'warning')->important();
            return redirect()->route('miembros.index');
        }

    }

    public function timeline($id)
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('home');
        }
        $date = new Carbon();
        $imagen = Users_image::where('users_id', auth()->user()->id)->first();

        $miembro = Miembro::find($id);
        $mitipo = Miembros_tipo::where('id', '=', $miembro->tipos_id)->first();
        $tipo_miembro = $mitipo->tipo_miembro;

        $datos = Datos_personal::where('id', '=', $miembro->datos_id)->first();

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

        $entrada = array("bg-red", "bg-green", "bg-blue", "bg-yellow", "bg-purple", "bg-maroon", "bg-indigo",
            "bg-lightblue", "bg-navy", "bg-fuchsia", "bg-pink", "bg-orange", "bg-lime", "bg-teal", "bg-olive");


        return view('admin.miembros.timeline')
            ->with('imagen', $imagen)
            ->with('tipo_miembro', $tipo_miembro)
            ->with('datos', $datos)
            ->with('timelines', $eventos2)
            ->with('color', $entrada)
            ->with('carbon', $date);
    }


}
