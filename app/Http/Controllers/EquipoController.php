<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipos = Equipo::where('user_id', auth()->id())->get();
        return view('equipos.indexEquipos')->with('equipos',$equipos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipos.formEquipos');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_creacion' => 'nullable|date',
            'ubicacion' => 'nullable|string|max:255',
        ]);
        $equipo = new Equipo();
        $equipo->nombre = $request->input('nombre');
        $equipo->descripcion = $request->input('descripcion');
        $equipo->fecha_creacion = $request->input('fecha_creacion');
        $equipo->ubicacion = $request->input('ubicacion');
        $equipo->user_id = auth()->id();

        if ($equipo->save()){
            return redirect()->route('dashboard')->with('exito', 'El equipo se guardó correctamente.');
        }else{
            return redirect()->route('dashboard')->with('fracaso', 'El equipo no se pudo guardar.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $equipo = Equipo::findorFail($id);
        $jugadores = Jugador::where('equipo_id', $id)->get();
        return view('equipos.verEquipos')->with(['equipo' => $equipo, 'jugadores' => $jugadores]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $equipo = Equipo::findOrFail($id);
        return view('equipos.formEquipos', ['equipo'=>$equipo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_creacion' => 'nullable|date',
            'ubicacion' => 'nullable|string|max:255',
        ]);
        $equipo = Equipo::findOrFail($id);
        $equipo->nombre = $request->input('nombre');
        $equipo->descripcion = $request->input('descripcion');
        $equipo->fecha_creacion = $request->input('fecha_creacion');
        $equipo->ubicacion = $request->input('ubicacion');
        $equipo->user_id = auth()->id();

        if ($equipo->save()){
            return redirect()->route('dashboard')->with('exito', 'El equipo se modificó correctamente.');
        }else{
            return redirect()->route('dashboard')->with('fracaso', 'El equipo no se pudo modificar.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $eliminados = Equipo::destroy($id);
        if ($eliminados <= 0){
            return redirect()->route('dashboard')->with('fracaso', 'El equipo no se pudo borrar.');
        } else {
            return redirect()->route('dashboard')->with('exito', 'El equipo se eliminó correctamente.');
        }
    }
}
