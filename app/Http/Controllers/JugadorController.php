<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use App\Models\Equipo;
use Illuminate\Http\Request;

class JugadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipos = Equipo::where('user_id', auth()->id())->get();
        $equiposConJugadores = $equipos->map(function ($equipo) {
            $equipo->jugadores = Jugador::where('equipo_id', $equipo->id)->get();
            return $equipo;
        });
        return view('jugadores.indexJugadores', compact('equiposConJugadores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipos = Equipo::where('user_id', auth()->id())->get();

        return view('jugadores.formJugadores')->with('equipos', $equipos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'nullable|email|unique:jugadores,correo',
            'telefono' => 'nullable|numeric|min:10',
            'fecha_ingreso' => 'nullable|date|before_or_equal:today',
            'equipo_id' => 'required|exists:equipos,id',
        ]);
        $jugador = new Jugador();
        $jugador->nombre = $request->input('nombre');
        $jugador->correo = $request->input('correo');
        $jugador->telefono = $request->input('telefono');
        $jugador->fecha_ingreso = $request->input('fecha_ingreso');
        $jugador->equipo_id = $request->input('equipo_id');

        if ($jugador->save()){
            return redirect()->route('jugadores.index')->with('exito', 'El jugador se guardó correctamente.');
        }else{
            return redirect()->route('jugadores.index')->with('fracaso', 'El jugador no se pudo guardar.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jugador = Jugador::findOrFail($id);
        $equipos = Equipo::where('user_id', auth()->id())->get();
        return view('jugadores.formJugadores', ['jugador' => $jugador, 'equipos' => $equipos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'nullable|email|unique:jugadores,correo,'.$id,
            'telefono' => 'nullable|numeric|min:10',
            'fecha_ingreso' => 'nullable|date|before_or_equal:today',
            'equipo_id' => 'nullable|exists:equipos,id',
        ]);
        $jugador = Jugador::findOrFail($id);
        $jugador->nombre = $request->input('nombre');
        $jugador->correo = $request->input('correo');
        $jugador->telefono = $request->input('telefono');
        $jugador->fecha_ingreso = $request->input('fecha_ingreso');
        $jugador->equipo_id = $request->input('equipo_id');

        if ($jugador->save()){
            return redirect()->route('jugadores.index')->with('exito', 'El jugador se modificó correctamente.');
        }else{
            return redirect()->route('jugadores.index')->with('fracaso', 'El jugador no se pudo modificar.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $eliminados = Jugador::destroy($id);
        if ($eliminados <= 0){
            return redirect()->route('jugadores.index')->with('fracaso', 'El jugador no se pudo borrar.');
        } else {
            return redirect()->route('jugadores.index')->with('exito', 'El jugador se eliminó correctamente.');
        }
    }
}
