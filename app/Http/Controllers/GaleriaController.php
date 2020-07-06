<?php

namespace App\Http\Controllers;

use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Gallery;
use App\Users_image;
use Carbon\Carbon;

class GaleriaController extends Controller
{
    public function index()
    {   
         $galleries = Gallery::paginate(20);
        return view('guest.galeria')->with('galleries', $galleries);
    }

    public function fundador()
    {
        return view('guest.fundador');
    }

    public function historia()
    {
        return view('guest.historia');
    }

    public function metas()
    {
        return view('guest.metas');
    }
     public function home()
    {
        if(Auth::user()->type != "Administrador"){
            return redirect()->route('galeria.home');
        }
        $imagen = Users_image::where('users_id', auth()->user()->id)->first();
        $galleries = Gallery::paginate(10);
       
        
        return view("admin.galeria.index")
            ->with('imagen', $imagen)
            ->with('galleries', $galleries);
    }
    public function agregar(Request $request)
    {
        $image = $request->file('image');

        $gallery = Gallery::create([
            'imagen' =>$image->store('gallery', 'public')
        ]);

        alert()->success('Imagen guardada con exito!', 'Excelente')->autoclose(2500);
        return back();
    }
     public function carga()
    {
         if(Auth::user()->type != "Administrador"){
            return redirect()->route('galeria.home');
        }
        $imagen = Users_image::where('users_id', auth()->user()->id)->first();

        return view("admin.galeria.create")
            ->with('imagen', $imagen);
    }
}
