<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $calificaciones = Calificacion::all();
        $peliculas = Pelicula::orderBy('titulo')->paginate(10);
        return view('peliculas')
            ->with('calificaciones', $calificaciones)
            ->with('peliculas', $peliculas);
    }
    public function show(Pelicula $pelicula)
    {
        $peliculas = Pelicula::orderBy('titulo')->paginate(10);
        return view('peliculas-show')
            ->with('peliculas', $peliculas)
            ->with('pelicula', $pelicula);

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
