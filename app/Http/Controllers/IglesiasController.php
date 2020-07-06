<?php

namespace App\Http\Controllers;

use App\Comunidad;
use App\Http\Requests\ComunidadRequest;
use App\Http\Requests\IglesiaRequest;
use App\Iglesia;
use App\Users_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IglesiasController extends Controller
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
        $iglesias = Iglesia::orderBy('nombre_iglesia', 'ASC')->get();
        $comunidades = Comunidad::orderBy('nombre_comunidad', 'ASC')->paginate(10);
        $comunidades->each(function ($comunidad){
            $comunidad->iglesias;
        });
        return view('admin.iglesias.index')
            ->with('imagen', $imagen)
            ->with('iglesias', $iglesias)
            ->with('comunidades', $comunidades);
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
        $iglesias = Iglesia::orderBy('nombre_iglesia', 'ASC')->get();
        return view('admin.iglesias.create_iglesia')
            ->with('imagen', $imagen)
            ->with('iglesias', $iglesias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IglesiaRequest $request)
    {
        $iglesia = new Iglesia();
        $iglesia->nombre_iglesia = strtoupper($request->nombre_iglesia);
        $iglesia->save();

        flash('<a href="'.route('iglesias.show', $iglesia->id).'"><strong><i class="fas fa-home"></i> '.strtoupper($request->nombre_iglesia).'</strong></a> <em>Creada Exitosamente</em>', 'success')->important();
        return redirect()->route('iglesias.index');
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
        $actual = Iglesia::find($id);
        $iglesias = Iglesia::orderBy('nombre_iglesia', 'ASC')->get();
        return view('admin.iglesias.edit_iglesia')
            ->with('imagen', $imagen)
            ->with('actual', $actual)
            ->with('iglesias', $iglesias);
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
    public function update(IglesiaRequest $request, $id)
    {
        $iglesia = Iglesia::find($id);
        $iglesia->nombre_iglesia = strtoupper($request->nombre_iglesia);
        $iglesia->update();

        flash('<a href="'.route('iglesias.show', $iglesia->id).'"><strong><i class="fas fa-home"></i> '.strtoupper($request->nombre_iglesia).'</strong></a> <em>Editada Exitosamente</em>', 'info')->important();
        return redirect()->route('iglesias.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $iglesia = Iglesia::find($id);
        $iglesia->delete();

        flash('<a href="'.route('iglesias.index').'"><strong><i class="fas fa-home"></i> '.strtoupper($iglesia->nombre_iglesia).'</strong></a> <em>Eliminada Exitosamente</em>', 'danger')->important();
        return redirect()->route('iglesias.index');
    }

    public function create_comunidades()
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('home');
        }
        $imagen = Users_image::where('users_id', auth()->user()->id)->first();
        $comunidades = Comunidad::orderBy('nombre_comunidad', 'ASC')->paginate(10);
        $comunidades->each(function ($comunidad){
            $comunidad->iglesias;
        });

        $iglesias = Iglesia::orderBy('nombre_iglesia', 'ASC')->pluck('nombre_iglesia', 'id');
        $vacio = $iglesias->isEmpty();
        if (!$vacio) {
            return view( 'admin.iglesias.create_comunidad' )
                ->with('imagen', $imagen)
                ->with( 'iglesias', $iglesias )
                ->with( 'comunidades', $comunidades );
        }else{
            $iglesias = Iglesia::orderBy('nombre_iglesia', 'ASC')->get();
            return view('admin.iglesias.create_iglesia')
                ->with('imagen', $imagen)
                ->with('iglesias', $iglesias);
        }
    }

    public function store_comunidades(ComunidadRequest $request)
    {
        $comunidad = new Comunidad();
        $comunidad->iglesias_id = $request->iglesias_id;
        $comunidad->nombre_comunidad = strtoupper($request->nombre_comunidad);
        $comunidad->save();

        flash('<a href="'.route('comunidades.edit', $comunidad->id).'"><strong><i class="fas fa-home"></i> '.strtoupper($request->nombre_comunidad).'</strong></a> <em>Creada Exitosamente</em>', 'success')->important();
        return redirect()->route('iglesias.index');
    }

    public function edit_comunidades($id)
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('home');
        }
        $imagen = Users_image::where('users_id', auth()->user()->id)->first();
        $actual = Comunidad::find($id);

        $comunidades = Comunidad::orderBy('nombre_comunidad', 'ASC')->paginate(10);
        $comunidades->each(function ($comunidad){
            $comunidad->iglesias;
        });

        $iglesias = Iglesia::orderBy('nombre_iglesia', 'ASC')->pluck('nombre_iglesia', 'id');
        $vacio = $iglesias->isEmpty();

        if (!$vacio) {
            return view( 'admin.iglesias.edit_comunidad' )
                ->with('imagen', $imagen)
                ->with( 'iglesias', $iglesias )
                ->with( 'actual', $actual )
                ->with('comunidades', $comunidades);
        }else{
            $iglesias = Iglesia::orderBy('nombre_iglesia', 'ASC')->get();
            return view('admin.iglesias.create_iglesia')
                ->with('imagen', $imagen)
                ->with('iglesias', $iglesias);
        }
    }

    public function update_comunidades(Request $request, $id)
    {
        $comunidad = Comunidad::find($id);
        $comunidad->iglesias_id = $request->iglesias_id;
        $comunidad->nombre_comunidad = strtoupper($request->nombre_comunidad);
        $comunidad->update();

        flash('<a href="'.route('comunidades.edit', $comunidad->id).'"><strong><i class="fas fa-home"></i> 
                '.strtoupper($request->nombre_comunidad).'</strong></a> <em>Editada Exitosamente</em>', 'info')->important();
        return redirect()->route('iglesias.index');

    }
    public function destroy_comunidades($id)
    {
        $comunidad = Comunidad::find($id);
        $comunidad->delete();

        flash('<a href="'.route('iglesias.index').'"><strong><i class="fas fa-home"></i>
                '.strtoupper($comunidad->nombre_comunidad).'</strong></a> <em>Eliminada Exitosamente</em>',
            'danger')->important();
        return redirect()->route('iglesias.index');
    }
}
