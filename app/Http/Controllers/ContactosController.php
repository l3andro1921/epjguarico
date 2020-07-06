<?php

namespace App\Http\Controllers;

use App\Datos_personal;
use App\User;
use App\Users_image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactosController extends Controller
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
        $users = User::buscar($request->buscar)->orderBy('id', 'DESC')->paginate(12);
        $users->each(function ($user){
            $user->img = Users_image::where('users_id', $user->id)->first();
            $user->datos = Datos_personal::where('users_id', '=', $user->id)->first();
        });
        return view('admin.contactos.index')
            ->with('imagen', $imagen)
            ->with('carbon', $carbon)
            ->with('users', $users);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

}
