<?php

namespace App\Http\Controllers;

use App\Models\Alquiler;
use App\Models\Pelicula;
use App\Models\User;
use Illuminate\Http\Request;

class AlquilerController extends Controller
{
    public function create(Request $request)
    {
        $peliculaId = $request->get('pelicula_id'); // Obtener el ID de la película desde la ruta
        $pelicula = Pelicula::findOrFail($peliculaId); // Encontrar la película con ese ID o sino fallar

        $usuario = auth()->user();
        $alquileres = Alquiler::latest()->paginate(10);
        $alquiler = new Alquiler();

        return view('alquiler')
            ->with('pelicula', $pelicula)
            ->with('usuario', $usuario)
            ->with('alquileres', $alquileres)
            ->with('alquiler', $alquiler);
    }
    public function store(Request $request)
    {
        $request->validate([
            'pelicula_id' => 'required|exists:peliculas,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'fecha_alquiler' => 'required|date',
            'fecha_devolucion' => 'nullable|date|after_or_equal:fecha_alquiler',
        ]);

        $requestData = $request->all();

        try {
            $alquiler = Alquiler::create($requestData);
            return redirect()->route('mis-peliculas')->with(['alert-success' => 'Alquiler creado correctamente']);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['alert-error' => 'Error al crear el alquiler']);
        }
    }
}
