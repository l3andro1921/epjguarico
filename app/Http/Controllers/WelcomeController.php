<?php

namespace App\Http\Controllers;

use App\Noticia;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $carbon = new Carbon();
        $noticias = Noticia::orderBy('fecha', 'DESC')->orderBy('id', 'DESC')->paginate(3);
        $ultima = Noticia::orderBy('fecha', 'DESC')->orderBy('id', 'DESC')->first();
        
        return view('welcome')
            ->with('carbon', $carbon)
            ->with('noticias', $noticias)
            ->with('ultima', $ultima);
    }

    public function show($id)
    {
        $carbon = new Carbon();
        $noticias = Noticia::orderBy('fecha', 'DESC')->orderBy('id', 'DESC')->paginate(20);
        $ver = Noticia::findOrFail($id);
        return view('guest.noticias')
            ->with('carbon', $carbon)
            ->with('noticias', $noticias)
            ->with('ver', $ver);
    }
}
