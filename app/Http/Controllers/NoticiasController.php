<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoticiaRequest;
use App\Noticia;
use App\Users_image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticiasController extends Controller
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
        $noticias = Noticia::buscar($request->buscar)->orderBy('fecha', 'DESC')->orderBy('id', 'DESC')->paginate(10);
        return view("admin.noticias.index")
            ->with('imagen', $imagen)
            ->with('carbon', $carbon)
            ->with('noticias', $noticias);
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
        return view('admin.noticias.create')
            ->with('imagen', $imagen);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoticiaRequest $request)
    {
        //dd($request->all());
        $noticia = new Noticia($request->all());

        // Manipulacion de imagen
        $file = $request->file('imagen');
        $name = 'imagen_noticia_'.time().'.'.$file->getClientOriginalExtension();
        $path = public_path().'/img/noticias/';
        $file->move($path, $name);

        // guardar en Base de datos
        $noticia->titulo = strtoupper($request->titulo);
        $noticia->lugar = ucwords($request->lugar);
        $noticia->imagen = $name;
        $noticia->save();

        flash('<a href="'.route('noticias.edit', $noticia->id).'"><strong><i class="far fa-bookmark"></i> '.$noticia->titulo.'</strong></a> <em>Creada Exitosamente</em>', 'success')->important();
        return redirect()->route('noticias.index');
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
        $carbon = new Carbon();
        $noticias = Noticia::orderBy('fecha', 'DESC')->orderBy('id', 'DESC')->paginate(20);
        $ver = Noticia::findOrFail($id);
        return view('admin.noticias.show')
            ->with('imagen', $imagen)
            ->with('carbon', $carbon)
            ->with('noticias', $noticias)
            ->with('ver', $ver);
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
        $noticia = Noticia::find($id);
        return view('admin.noticias.edit')
            ->with('imagen', $imagen)
            ->with('noticia', $noticia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoticiaRequest $request, $id)
    {
        $noticia = Noticia::find($id);

        // Manipulacion de imagen
        $img_path = public_path().'/img/noticias/'.$noticia->imagen;
        unlink($img_path);

        $file = $request->file('imagen');
        $name = 'imagen_noticia_'.time().'.'.$file->getClientOriginalExtension();
        $path = public_path().'/img/noticias/';
        $file->move($path, $name);

        // guardar en Base de datos
        $noticia->titulo = strtoupper($request->titulo);
        $noticia->lugar = ucwords($request->lugar);
        $noticia->fecha = $request->fecha;
        $noticia->resumen = $request->resumen;
        $noticia->descripcion = $request->descripcion;
        $noticia->imagen = $name;
        $noticia->update();

        flash('<a href="'.route('noticias.edit', $noticia->id).'"><strong><i class="far fa-bookmark"></i> '.$noticia->titulo.'</strong></a> <em>Actualizada Exitosamente</em>', 'primary')->important();
        return redirect()->route('noticias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $noticia = Noticia::find($id);
        $path = public_path().'/img/noticias/'.$noticia->imagen;
        $noticia->delete();
        unlink($path);

        flash('<a href="'.route('noticias.index').'"><strong><i class="far fa-bookmark"></i> '.$noticia->titulo.'</strong></a> <em>Eliminada Exitosamente</em>', 'danger')->important();
        return redirect()->route('noticias.index');
    }
}
