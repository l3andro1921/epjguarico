<?php

namespace App\Http\Controllers;

use App\Datos_personal;
use App\Evento;
use App\Eventos_agenda;
use App\Eventos_cerrado;
use App\Http\Requests\AgendaRequest;
use App\Participante;
use App\Users_image;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd("hola mundo");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgendaRequest $request)
    {
        $agenda = new Eventos_agenda($request->all());
        //$agenda->mensaje = strtoupper($request->mensaje);
        $agenda->save();

        $participante = new Participante($request->all());
        $participante->status = "AGENDA";
        $participante->save();

        flash('<a href="'.route('agenda.edit', $agenda->id).'"><strong><i class="far fa-flag"></i>
                '.strtoupper($agenda->mensaje).'</strong></a> <br><em>Agregado Exitosamente</em>', 'success')->important();
        return  redirect()->route('agenda.show', $agenda->eventos_id);
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
        $evento = Evento::find($id);
        $rangos = Eventos_agenda::where('eventos_id', '=', $id)->get();
        $rangos->each(function ($rango){
            $datos = Datos_personal::find($rango->datos_id);
            $rango->nombre_completo = $datos->nombre_completo;
        });
        return view('admin.eventos.agenda')
            ->with('imagen', $imagen)
            ->with('evento', $evento)
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
        $agenda = Eventos_agenda::find($id);
        $evento = Evento::where('id', '=', $agenda->eventos_id)->first();
        $miembros = Datos_personal::all()->pluck('nombre_completo', 'id');
        return view('admin.eventos.agenda_edit')
            ->with('imagen', $imagen)
            ->with('agenda', $agenda)
            ->with('evento', $evento)
            ->with('miembros', $miembros);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AgendaRequest $request, $id)
    {
        $agenda = Eventos_agenda::find($id);
        $revisar = Participante::where('eventos_id', '=', $agenda->eventos_id)
                               ->where('datos_id', '=', $agenda->datos_id)
                               ->where('status', "AGENDA")
                               ->first();

        //dd($agenda->eventos_id.' - da '. $agenda->datos_id);
        //dd($revisar->id);
        $agenda->fill($request->all());
        //$agenda->mensaje = strtoupper($request->mensaje);
        $agenda->update();

        $participante = Participante::find($revisar->id);
        $participante->eventos_id = $agenda->eventos_id;
        $participante->datos_id = $agenda->datos_id;
        $participante->update();

        flash('<a href="'.route('agenda.edit', $agenda->id).'"><strong><i class="far fa-flag"></i>
                '.strtoupper($agenda->mensaje).'</strong></a> <br><em>Editado Exitosamente</em>', 'primary')->important();
        return  redirect()->route('agenda.show', $agenda->eventos_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agenda = Eventos_agenda::find($id);
        $volver = $agenda->eventos_id;

        $revisar = Participante::where('eventos_id', '=', $agenda->eventos_id)
                               ->where('datos_id', '=', $agenda->datos_id)
                               ->where('status', "AGENDA")
                               ->first();

        $participante = Participante::find($revisar->id);
        $participante->delete();
        $agenda->delete();

        flash('<strong><i class="far fa-flag"></i>
                '.strtoupper($agenda->mensaje).'</strong> <em>Eliminado Exitosamente</em>', 'danger')->important();
        return redirect()->route('agenda.show', $volver);
    }

    public function agenda_create($id)
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('home');
        }
        $imagen = Users_image::where('users_id', auth()->user()->id)->first();
        $evento = Evento::find($id);
        $miembros = Datos_personal::all()->pluck('nombre_completo', 'id');
        return view('admin.eventos.agenda_create')
            ->with('imagen', $imagen)
            ->with('evento', $evento)
            ->with('miembros', $miembros);
    }
}
