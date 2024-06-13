<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Pelicula;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{
    public function create(Request $request)
    {
        $peliculaId = $request->get('pelicula_id');
        $pelicula = Pelicula::findOrFail($peliculaId);

        $usuario = auth()->user();
        $calificaciones = Calificacion::latest()->paginate(10);
        $calificacion = new Calificacion();

        return view('calificacion')
            ->with('pelicula', $pelicula)
            ->with('usuario', $usuario)
            ->with('calificaciones', $calificaciones)
            ->with('calificacion', $calificacion);
    }
    public function store(Request $request)
    {
        $request->validate([
            'pelicula_id' => 'required',
            'usuario_id' => 'required',
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string',
        ], [
            'pelicula_id.required' => 'El campo Película es obligatorio.',
            'usuario_id.required' => 'El campo Usuario es obligatorio.',
            'calificacion.required' => 'La calificación es obligatoria.',
            'calificacion.integer' => 'La calificación debe ser un número entero.',
            'calificacion.min' => 'La calificación mínima permitida es 1.',
            'calificacion.max' => 'La calificación máxima permitida es 5.',
            'comentario.string' => 'El comentario debe ser una cadena de texto.',
        ]);


        try {
            Calificacion::create($request->all());
            return redirect()->route('mis-peliculas')->with('alert-success', 'Calificación creada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('alert-error', 'Error al crear la calificación');
        }
    }
}
