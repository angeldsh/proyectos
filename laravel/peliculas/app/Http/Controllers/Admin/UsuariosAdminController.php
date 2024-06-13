<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::orderBy('nif')->paginate(10);
        return view('admin.usuarios.index')
            ->with('usuarios', $usuarios);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = User::latest()->paginate(10);
        $usuario = new User();
        return view('admin.usuarios.create')
            ->with('usuarios', $usuarios)
            ->with('usuario', $usuario);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nif' => 'required|min:9|max:9|unique:usuarios,nif',
            'nombre' => 'required|string|max:75',
            'apellido1' => 'nullable|string|max:100',
            'apellido2' => 'nullable|string|max:100',
            'direccion' => 'nullable|string|max:255',
            'password' => 'required|min:4',
            'username' => 'required|unique:usuarios,username',
            'email' => 'required|unique:usuarios,email'

        ], [
            'nif.required' => 'El campo NIF es obligatorio.',
            'nif.max' => 'El NIF no puede tener más de 9 caracteres.',
            'nif.min' => 'El NIF no puede tener menos de 9 caracteres.',
            'nif.unique' => 'El NIF debe ser único.',
            'nombre.required' => 'El campo Nombre es obligatorio.',
            'nombre.string' => 'El campo Nombre debe ser una cadena de texto.',
            'nombre.max' => 'El campo Nombre no puede tener más de 75 caracteres.',
            'apellido1.required' => 'El campo Primer Apellido es obligatorio.',
            'apellido1.string' => 'El campo Primer Apellido debe ser una cadena de texto.',
            'apellido1.max' => 'El campo Primer Apellido no puede tener más de 100 caracteres.',
            'apellido2.string' => 'El campo Segundo Apellido debe ser una cadena de texto.',
            'apellido2.max' => 'El campo Segundo Apellido no puede tener más de 100 caracteres.',
            'direccion.string' => 'El campo Dirección debe ser una cadena de texto.',
            'direccion.max' => 'El campo Dirección no puede tener más de 255 caracteres.',
            'password.required' => 'El campo Password es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 4 caracteres.',
            'username.required' => 'El campo Username es obligatorio.',
            'username.unique' => 'El campo Username debe ser único.',
            'email.required' => 'El campo Email es obligatorio.',
            'email.unique' => 'El campo Email debe ser único.'
        ]);

        $requestData = $request->all();

        if ($request->filled('password')) {
            $requestData['password'] = Hash::make($request->input('password'));
        }

        if($request->hasFile('foto')){
            $file = $request -> file('foto');
            $destino = env('DIR_UPLOAD_USUARIOS');
            $uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $fileName = $uuid . '-' . $file->getClientOriginalName();
            $uploaded = $request->file('foto')->move($destino, $fileName);
            $requestData['foto']=$destino.$fileName;
        }

        try {
            $usuario = User::create($requestData);
            return redirect()->route('admin.usuarios.create')
                ->with(['alert-success' => 'Usuario creado correctamente']);
        } catch (\Exception $e) {

            return redirect()->back()->withInput()
                ->with(['alert-error' => 'Error al crear el usuario']);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(User $usuario)
    {
        $usuarios = User::orderBy('nif')->paginate(10);
        return view('admin.usuarios.show')
            ->with('usuarios', $usuarios)
            ->with('usuario', $usuario);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {
        $usuarios = User::orderBy('updated_at','desc')->paginate(10);
        return view('admin.usuarios.edit')
            ->with('usuarios', $usuarios)
            ->with('usuario', $usuario);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuario
    )
    {
        $request->validate([
            'nif' => 'required|min:9|max:9',
            'nombre' => 'required|string|max:75',
            'apellido1' => 'nullable|string|max:100',
            'apellido2' => 'nullable|string|max:100',
            'direccion' => 'nullable|string|max:255',
            'username' => 'required',
            'email' => 'required'

        ], [
            'nif.required' => 'El campo NIF es obligatorio.',
            'nif.max' => 'El NIF no puede tener más de 9 caracteres.',
            'nif.min' => 'El NIF no puede tener menos de 9 caracteres.',
            'nombre.required' => 'El campo Nombre es obligatorio.',
            'nombre.string' => 'El campo Nombre debe ser una cadena de texto.',
            'nombre.max' => 'El campo Nombre no puede tener más de 75 caracteres.',
            'apellido1.required' => 'El campo Primer Apellido es obligatorio.',
            'apellido1.string' => 'El campo Primer Apellido debe ser una cadena de texto.',
            'apellido1.max' => 'El campo Primer Apellido no puede tener más de 100 caracteres.',
            'apellido2.string' => 'El campo Segundo Apellido debe ser una cadena de texto.',
            'apellido2.max' => 'El campo Segundo Apellido no puede tener más de 100 caracteres.',
            'direccion.string' => 'El campo Dirección debe ser una cadena de texto.',
            'direccion.max' => 'El campo Dirección no puede tener más de 255 caracteres.',
            'username.required' => 'El campo Username es obligatorio.',
            'email.required' => 'El campo Email es obligatorio.'
        ]);

        $requestData = $request->all();
        if ($request->filled('password')) {
            // Hashea la nueva contraseña
            $requestData['password'] = Hash::make($request->input('password'));
        } else {
            // Si no se proporciona una nueva contraseña, elimina la clave del array
            unset($requestData['password']);
        }

        if($request->hasFile('foto')){
            $destino = env('DIR_UPLOAD_USUARIOS');
            //BORRAR IMAGEN ANTERIOR
            if (file_exists($usuario->foto)) {
                unlink($usuario->foto);
            }
            $file = $request -> file('foto');
            $uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $fileName = $uuid . '-' . $requestData['nif'];
            $uploaded = $request->file('foto')->move($destino, $fileName);
            $requestData['foto']=$destino.$fileName;
        }

        try {
            $usuario->update($requestData);
            return redirect()->route('admin.usuarios.index')
                ->with(['alert-success' => 'Usuario modificado correctamente']);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->with(['alert-error' => 'Error al modificar el usuario']);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        try{
            $usuario->delete();
            return to_route('admin.usuarios.index')
                ->with(['alert-success' => 'El usuario ha sido eliminado']);
        }catch (\Exception $e){

            return to_route('admin.usuarios.index')
                ->with(['alert-error' => 'El usuario NO ha sido eliminado']);
        }
    }

    //--------------------------------------------------------------------------------

    public function filtro(Request $request)
    {
        $requestData = $request->all();
        $usuarios = User::orderBy('nif');
        if (isset($requestData['filtroNombre'])) {
            $usuarios = $usuarios
                ->where('nombre', 'like', '%' . $requestData['filtroNombre'] . '%');
        }
        if (isset($requestData['filtroApellido1'])) {
            $usuarios = $usuarios
                ->where('apellido1', 'like', '%' . $requestData['filtroApellido1'] . '%');
        }
        if (isset($requestData['filtroApellido2'])) {
            $usuarios = $usuarios
                ->where('apellido2', 'like', '%' . $requestData['filtroApellido2'] . '%');
        }
        $usuarios = $usuarios->paginate(10);
        return view('admin.usuarios.index')
            ->with('usuarios', $usuarios);
    }

}
