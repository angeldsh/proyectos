<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Calificacion;
use App\Models\Pelicula;
use App\Models\User;
use Illuminate\Http\Request;

class CalificacionesAdminController extends Controller
{
    public function index()
    {

        $calificacion = new Calificacion();
        $calificaciones = Calificacion::orderBy('id', 'DESC')->paginate(10);
        return view('admin.calificaciones.index')
            ->with('calificacion', $calificacion)
            ->with('calificaciones', $calificaciones);

    }

    public function create()
    {
        $peliculas = Pelicula::all();
        $usuarios = User::all();
        $calificacion = new Calificacion();
        $calificaciones = Calificacion::latest()->paginate(10);
        return view('admin.calificaciones.create')
            ->with('calificacion', $calificacion)
            ->with('calificaciones', $calificaciones)
            ->with('peliculas', $peliculas)
            ->with('usuarios', $usuarios);
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
            return redirect()->route('admin.calificaciones.index')->with('alert-success', 'Calificación creada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('alert-error', 'Error al crear la calificación');
        }
    }

    public function show(Calificacion $calificacion)
    {
        $peliculas = Pelicula::all();
        $usuarios = User::all();
        $calificaciones = Calificacion::orderBy('id', 'DESC')->paginate(10);
        return view('admin.calificaciones.show')
            ->with('calificacion', $calificacion)
            ->with('calificaciones', $calificaciones)
            ->with('peliculas', $peliculas)
            ->with('usuarios', $usuarios);
    }

    public function edit(Calificacion $calificacion)
    {
        $peliculas = Pelicula::all();
        $usuarios = User::all();
        $calificaciones = Calificacion::orderBy('updated_at', 'DESC')->paginate(10);
        return view('admin.calificaciones.edit')
            ->with('calificacion', $calificacion)
            ->with('calificaciones', $calificaciones)
            ->with('peliculas', $peliculas)
            ->with('usuarios', $usuarios);
    }

    public function update(Request $request, Calificacion $calificacion)
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
            $calificacion->update($request->all());
            return redirect()->route('admin.calificaciones.index')->with('alert-success', 'Calificación actualizada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('alert-error', 'Error al actualizar la calificación');
        }
    }

    public function destroy(Calificacion $calificacion)
    {
        try {
            $calificacion->delete();
            return redirect()->route('admin.calificaciones.index')->with('alert-success', 'Calificación eliminada correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('alert-error', 'Error al eliminar la calificación');
        }
    }
}
