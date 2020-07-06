<?php

namespace App\Http\Controllers;

use App\Eventos_rango;
use App\Eventos_tipo;
use App\Http\Requests\ConfiguracionRequest;
use App\Miembros_tipo;
use App\Users_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfiguracionController extends Controller
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
        $tipo_evento = Eventos_tipo::all();
        return view('admin.configuracion.index')
            ->with('imagen', $imagen)
            ->with('tipos', $tipo_evento);
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
        $tipo_evento = Eventos_tipo::all();
        $tipo_miembros = Miembros_tipo::orderBy('tipo_miembro', 'ASC')->pluck('tipo_miembro', 'id');
        return view('admin.configuracion.create')
            ->with('imagen', $imagen)
            ->with('miembros', $tipo_miembros)
            ->with('tipos', $tipo_evento);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConfiguracionRequest $request)
    {
        $tipo_evento = new Eventos_tipo($request->all());
        $tipo_evento->tipo_evento = strtoupper($request->tipo_evento);
        $tipo_evento->save();

        $rango = new Eventos_rango($request->all());
        $rango->tipos_id = $tipo_evento->id;
        $rango->save();

        flash('<a href="'.route('configuracion.edit', $tipo_evento->id).'"><strong><i class="fas fa-user"></i>
                '.strtoupper($tipo_evento->tipo_evento).'</strong></a> <em>Creado Exitosamente</em>', 'success')->important();
        return redirect()->route('configuracion.show', $tipo_evento->id);
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
        $tipo_miembros = Miembros_tipo::orderBy('tipo_miembro', 'ASC')->pluck('tipo_miembro', 'id');
        $tipo_evento = Eventos_tipo::all();
        $tipo = Eventos_tipo::find($id);
        $rangos = Eventos_rango::where('tipos_id', '=', $id)->paginate(10);
        $rangos->each(function ($rango){
            $tipo = Miembros_tipo::where('id', '=', $rango->miembros_tipos_id)->first();
            $rango->tipo = strtoupper($tipo->tipo_miembro);
        });
        return view('admin.configuracion.show')
            ->with('imagen', $imagen)
            ->with('miembros', $tipo_miembros)
            ->with('tipos', $tipo_evento)
            ->with('actual', $tipo)
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
        $tipo_evento = Eventos_tipo::all();
        $tipo = Eventos_tipo::find($id);
        return view('admin.configuracion.edit')
            ->with('imagen', $imagen)
            ->with('tipos', $tipo_evento)
            ->with('actual', $tipo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConfiguracionRequest $request, $id)
    {
        $tipo_evento = Eventos_tipo::find($id);
        $tipo_evento->fill($request->all());
        $tipo_evento->tipo_evento = strtoupper($request->tipo_evento);
        $tipo_evento->update();

        flash('<a href="'.route('configuracion.edit', $tipo_evento->id).'"><strong><i class="fas fa-user"></i>
                '.strtoupper($tipo_evento->tipo_evento).'</strong></a> <em>Editado Exitosamente</em>', 'primary')->important();
        return redirect()->route('configuracion.show', $tipo_evento->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_evento = Eventos_tipo::find($id);
        $tipo_evento->delete();

        flash('<strong><i class="fas fa-user"></i>
                '.strtoupper($tipo_evento->tipo_evento).'</strong> <em>Eliminado Exitosamente</em>', 'danger')->important();
        return redirect()->route('configuracion.index');
    }

    public function rango_destroy($id)
    {
        $tipo_evento = Eventos_rango::find($id);
        $tipo = Miembros_tipo::where('id', '=', $tipo_evento->miembros_tipos_id)->first();
        $tipo_evento->delete();

        flash('<strong><i class="fas fa-user"></i>
                '.strtoupper($tipo->tipo_miembro).'</strong> <em>Eliminado Exitosamente</em>', 'danger')->important();
        return redirect()->route('configuracion.show', $tipo_evento->tipos_id);
    }

    public function rango_store(Request $request)
    {
        $rango = new Eventos_rango($request->all());
        $rango->save();
        $tipo = Miembros_tipo::where('id', '=', $rango->miembros_tipos_id)->first();

        flash('<strong><i class="fas fa-user"></i>
                '.strtoupper($tipo->tipo_miembro).'</strong></a> <em>Agregado Exitosamente</em>', 'primary')->important();
        return redirect()->route('configuracion.show', $rango->tipos_id);
    }
}
