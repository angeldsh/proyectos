<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alquiler;
use App\Models\Pelicula;
use App\Models\User;
use Illuminate\Http\Request;

class AlquileresAdminController extends Controller
{
    public function index()
    {
        $alquileres = Alquiler::orderBy('fecha_alquiler')->paginate(10);
        return view('admin.alquileres.index')->with('alquileres', $alquileres);
    }

    public function create()
    {
        $peliculas = Pelicula::all();
        $usuarios = User::all();
        $alquileres = Alquiler::latest()->paginate(10);
        $alquiler = new Alquiler();
        return view('admin.alquileres.create')
            ->with('peliculas', $peliculas)
            ->with('usuarios', $usuarios)
            ->with('alquileres', $alquileres)
            ->with('alquiler', $alquiler);

    }

    public function store(Request $request)
    {
        $request->validate([
            'pelicula_id' => 'required',
            'usuario_id' => 'required',
            'fecha_alquiler' => 'required|date',
            'fecha_devolucion' => 'required|date|after:fecha_alquiler',
        ], [
            'pelicula_id.required' => 'El campo Película es obligatorio.',
            'usuario_id.required' => 'El campo Usuario es obligatorio.',
            'fecha_alquiler.required' => 'La fecha de alquiler es obligatoria.',
            'fecha_alquiler.date' => 'La fecha de alquiler debe ser una fecha válida.',
            'fecha_devolucion.required' => 'La fecha de devolución es obligatoria.',
            'fecha_devolucion.date' => 'La fecha de devolución debe ser una fecha válida.',
            'fecha_devolucion.after' => 'La fecha de devolución debe ser posterior a la fecha de alquiler.',
        ]);


        $requestData = $request->all();

        try {
            $alquiler = Alquiler::create($requestData);
            return redirect()->route('admin.alquileres.create')->with(['alert-success' => 'Alquiler creado correctamente']);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['alert-error' => 'Error al crear el alquiler']);
        }
    }

    public function show(Alquiler $alquiler)
    {
        $peliculas = Pelicula::all();
        $usuarios = User::all();
        $alquileres = Alquiler::orderBy('fecha_alquiler')->paginate(10);
        return view('admin.alquileres.show')
            ->with('peliculas', $peliculas)
            ->with('usuarios', $usuarios)
            ->with('alquileres', $alquileres)
            ->with('alquiler', $alquiler);
    }

    public function edit(Alquiler $alquiler)
    {
        $peliculas = Pelicula::all();
        $usuarios = User::all();
        $alquileres = Alquiler::orderBy('updated_at','desc')->paginate(10);
        return view('admin.alquileres.edit')
            ->with('peliculas', $peliculas)
            ->with('usuarios', $usuarios)
            ->with('alquileres', $alquileres)
            ->with('alquiler', $alquiler);
    }

    public function update(Request $request, Alquiler $alquiler)
    {
        $request->validate([
            'pelicula_id' => 'required',
            'usuario_id' => 'required',
            'fecha_alquiler' => 'required|date',
            'fecha_devolucion' => 'required|date|after:fecha_alquiler',
        ], [
            'pelicula_id.required' => 'El campo Película es obligatorio.',
            'usuario_id.required' => 'El campo Usuario es obligatorio.',
            'fecha_alquiler.required' => 'La fecha de alquiler es obligatoria.',
            'fecha_alquiler.date' => 'La fecha de alquiler debe ser una fecha válida.',
            'fecha_devolucion.required' => 'La fecha de devolución es obligatoria.',
            'fecha_devolucion.date' => 'La fecha de devolución debe ser una fecha válida.',
            'fecha_devolucion.after' => 'La fecha de devolución debe ser posterior a la fecha de alquiler.',
        ]);

        $requestData = $request->all();

        try {
            $alquiler->update($requestData);
            return redirect()->route('admin.alquileres.index')->with(['alert-success' => 'Alquiler actualizado correctamente']);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['alert-error' => 'Error al actualizar el alquiler']);
        }
    }

    public function destroy(Alquiler $alquiler)
    {
        try {
            $alquiler->delete();
            return redirect()->route('admin.alquileres.index')->with(['alert-success' => 'Alquiler eliminado correctamente']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['alert-error' => 'Error al eliminar el alquiler']);
        }
    }
}
