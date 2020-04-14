<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehiculo;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!$request->ajax()) return redirect('/');
        $vehiculos = Vehiculo::all();
        return $vehiculos;
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
        if (!$request->ajax()) return redirect('/');
        $request->validate([
            'placa'=>'required',
            'marca'=>'required',
            'modelo'=>'required',
            'puertas'=>'required',
            'tipo'=>'required'
        ]);

        $vehiculo = new Vehiculo();
        $vehiculo->placa = $request->placa;
        $vehiculo->marca = $request->marca;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->puertas = $request->puertas;
        $vehiculo->tipo = $request->tipo;
        $vehiculo->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$request->ajax()) return redirect('/');
        $vehiculo = Vehiculo::find($id);
        return $vehiculo;
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
        if (!$request->ajax()) return redirect('/');
        $vehiculo = Vehiculo::findOrFail($id);
        if (!is_null($request->placa)){
            $vehiculo->placa = $request->placa;
        }
        if (!is_null($request->marca)){
            $vehiculo->marca = $request->marca;
        }
        if (!is_null($request->modelo)){
            $vehiculo->modelo = $request->modelo;
        }
        if (!is_null($request->puertas)){
            $vehiculo->puertas = $request->puertas;
        }
        if (!is_null($request->tipo)){
            $vehiculo->tipo = $request->tipo;
        }
        $vehiculo->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$request->ajax()) return redirect('/');
        $vehiculo = Vehiculo::find($id);
        if ($vehiculo){
            $destroy = Vehiculo::destroy($id);
        }
        if ($destroy){
            return response('Success', 200);
        }
        return response('Failed', 404);
    }

    public function desactivar($request){
        if (!$request->ajax()) return redirect('/');
        $vehiculo = Vehiculo::find($request->id)->personas()->where('activo',1)->get()->first();
        if (!is_null($vehiculo)){
            $vehiculo->pivot->activo = 0;
            $vehiculo->pivot->save();
        }
    }
}
