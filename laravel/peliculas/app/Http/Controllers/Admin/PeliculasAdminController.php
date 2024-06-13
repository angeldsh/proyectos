<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculasAdminController extends Controller
{
    public function index()
    {
        $peliculas = Pelicula::orderBy('titulo')->paginate(10);
        return view('admin.peliculas.index')->with('peliculas', $peliculas);
    }

    public function create()
    {
        $peliculas = Pelicula::latest()->paginate(10);
        $pelicula = new Pelicula();
        return view('admin.peliculas.create')
            ->with('peliculas', $peliculas)
            ->with('pelicula', $pelicula);

    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|unique:peliculas,titulo',
            'director' => 'nullable|string|max:255',
            'fechaEstreno' => 'nullable|date',
            'edad' => 'nullable|integer|min:0',
            'reparto' => 'nullable|string',
            'genero' => 'required|string',
            'sinopsis' => 'nullable|string',
            'duracion' => 'nullable|integer|min:0',
            'precio' => 'required|integer|min:0',
        ], [
            'titulo.required' => 'El campo Título es obligatorio.',
            'titulo.unique' => 'El campo Título debe ser único.',
            'director.string' => 'El campo Director debe ser una cadena de texto.',
            'director.max' => 'El campo Director no puede tener más de 255 caracteres.',
            'fechaEstreno.date' => 'El campo Fecha de Estreno debe ser una fecha válida.',
            'edad.integer' => 'El campo Edad debe ser un número entero.',
            'edad.min' => 'El campo Edad no puede ser un número negativo.',
            'genero.required' => 'El campo Género es obligatorio.',
            'sinopsis.string' => 'El campo Sinopsis debe ser una cadena de texto.',
            'duracion.integer' => 'El campo Duración debe ser un número entero.',
            'duracion.min' => 'El campo Duración no puede ser un número negativo.',
            'precio.required' => 'El campo Precio es obligatorio.',
            'precio.integer' => 'El campo Precio debe ser un número entero.',
            'precio.min' => 'El campo Precio no puede ser un número negativo.',
        ]);


        $requestData = $request->all();

        // Lógica para manejar la subida de imágenes
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $destino = env('DIR_UPLOAD_PELICULAS');
            $uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $fileName = $uuid . '-' . $file->getClientOriginalName();
            $uploaded = $request->file('foto')->move($destino, $fileName);
            $requestData['foto'] = $destino . $fileName;
        }

        try {
            $pelicula = Pelicula::create($requestData);
            return redirect()->route('admin.peliculas.create')->with(['alert-success' => 'Película creada correctamente']);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['alert-error' => 'Error al crear la película']);
        }
    }

    public function show(Pelicula $pelicula)
    {
        $peliculas = Pelicula::orderBy('titulo')->paginate(10);
        return view('admin.peliculas.show')
            ->with('peliculas', $peliculas)
            ->with('pelicula', $pelicula);

    }

    public function edit(Pelicula $pelicula)
    {
        $peliculas = Pelicula::orderBy('updated_at', 'desc')->paginate(10);
        return view('admin.peliculas.edit')
            ->with('peliculas', $peliculas)
            ->with('pelicula', $pelicula);
    }

    public function update(Request $request, Pelicula $pelicula)
    {
        $request->validate([
            'titulo' => 'required',
            'director' => 'nullable|string|max:255',
            'fechaEstreno' => 'nullable|date',
            'edad' => 'nullable|integer|min:0',
            'reparto' => 'nullable|string',
            'genero' => 'required|string',
            'sinopsis' => 'nullable|string',
            'duracion' => 'nullable|integer|min:0',
            'precio' => 'required|integer|min:0',
        ], [
            'titulo.required' => 'El campo Título es obligatorio.',
            'director.string' => 'El campo Director debe ser una cadena de texto.',
            'director.max' => 'El campo Director no puede tener más de 255 caracteres.',
            'fechaEstreno.date' => 'El campo Fecha de Estreno debe ser una fecha válida.',
            'edad.integer' => 'El campo Edad debe ser un número entero.',
            'edad.min' => 'El campo Edad no puede ser un número negativo.',
            'genero.required' => 'El campo Género es obligatorio.',
            'sinopsis.string' => 'El campo Sinopsis debe ser una cadena de texto.',
            'duracion.integer' => 'El campo Duración debe ser un número entero.',
            'duracion.min' => 'El campo Duración no puede ser un número negativo.',
            'precio.required' => 'El campo Precio es obligatorio.',
            'precio.integer' => 'El campo Precio debe ser un número entero.',
            'precio.min' => 'El campo Precio no puede ser un número negativo.',
        ]);


        $requestData = $request->all();

        // Lógica para manejar la subida de imágenes
        if ($request->hasFile('foto')) {
            $destino = env('DIR_UPLOAD_PELICULAS');
            // Borrar imagen anterior en caso de que exista la nueva
            if (file_exists($pelicula->foto)) {
                unlink($pelicula->foto);
            }
            $file = $request->file('foto');
            $uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $fileName = $uuid . '-' . $requestData['titulo'];
            $uploaded = $request->file('foto')->move($destino, $fileName);
            $requestData['foto'] = $destino . $fileName;
        }

        try {
            $pelicula->update($requestData);
            return redirect()->route('admin.peliculas.index')->with(['alert-success' => 'Película actualizada correctamente']);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with(['alert-error' => 'Error al actualizar la película']);
        }
    }

    public function destroy(Pelicula $pelicula)
    {
        try {
            $pelicula->delete();
            return redirect()->route('admin.peliculas.index')->with(['alert-success' => 'Película eliminada correctamente']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['alert-error' => 'Error al eliminar la película']);
        }
    }

    public function filtro(Request $request)
    {
        $requestData = $request->all();
        $peliculas = Pelicula::query();

        if (isset($requestData['filtroTitulo'])) {
            $peliculas->where('titulo', 'like', '%' . $requestData['filtroTitulo'] . '%');
        }

        $peliculas = $peliculas->paginate(10);
        return view('admin.peliculas.index')->with('peliculas', $peliculas);
    }
}
