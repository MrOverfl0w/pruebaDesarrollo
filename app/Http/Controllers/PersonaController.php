<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::all();
        return $personas;
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
            'identificacion'=>'required',
            'nombre'=>'required',
            'apellidos'=>'required',
            'nacimiento'=>'required',
            'profesion'=>'required',
            'casado'=>'required',
            'ingresos'=>'required'
        ]);

        $persona = new Persona();
        $persona->identificacion = $request->identificacion;
        $persona->nombre = $request->nombre;
        $persona->apellidos = $request->apellidos;
        $persona->nacimiento = $request->nacimiento;
        $persona->profesion = $request->profesion;
        $persona->casado = $request->casado;
        $persona->ingresos = $request->ingresos;
        $persona->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $persona = Persona::find($id);
        return $persona;
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
        $persona = Persona::findOrFail($id);
        if (!is_null($request->nombre)){
            $persona->nombre = $request->nombre;
        }
        if (!is_null($request->apellidos)){
            $persona->apellidos = $request->apellidos;
        }
        if (!is_null($request->nacimiento)){
            $persona->nacimiento = $request->nacimiento;
        }
        if (!is_null($request->profesion)){
            $persona->profesion = $request->profesion;
        }
        if (!is_null($request->casado)){
            $persona->casado = $request->casado;
        }
        if (!is_null($request->ingresos)){
            $persona->ingresos = $request->ingresos;
        }

        $vehiculo = $request->vehiculo;
        if (!is_null($vehiculo)){
            $new = $persona->vehiculos()->where('idvehiculo',$vehiculo)->get()->first();
            if (!is_null($new)){
                $new->pivot->activo = 1;
                $new->pivot->save();
            }else{
                $persona->vehiculos()->attach($vehiculo);
            }
        }

        $persona->save();
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
        $persona = Persona::find($id);
        if ($persona){
            $destroy = Persona::destroy($id);
        }
        if ($destroy){
            return response('Success', 200);
        }
        return response('Failed', 404);
    }
}
