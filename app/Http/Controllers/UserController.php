<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los usuarios activos de la base de datos
        $users = User::where('is_active', 1)->get();

        // Pasar los usuarios activos a la vista
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
    */

    public function create()
    {
        // Obtener todos los tipos de documentos disponibles
        $documentTypes = DocumentType::all();

        // Pasar los tipos de documentos a la vista del formulario de creación
        return view('users.create', ['documentTypes' => $documentTypes]);
    }

    /**
     * Store a newly created resource in storage.
    */

    public function store(Request $request)
    {
        // Validar los datos recibidos del formulario
        $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'document' => 'required|unique:users,document',
            'document_type_id' => 'required',
        ]);

        // Crear un nuevo usuario con los datos recibidos del formulario
        $user = new User();
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->document = $request->document;
        $user->document_type_id = $request->document_type_id;
        $user->password = '';
        $user->is_active = 1; // Establecer el usuario como activo por defecto

        // Guardar el nuevo usuario en la base de datos
        $user->save();

        // Devolver una respuesta exitosa
        return response()->json(['message' => 'Usuario creado correctamente'], 201);
    }

    /**
     * Display the specified resource.
    */

    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
    */

    public function update(Request $request)
    {
        // Validar los datos recibidos en la solicitud
        $request->validate([
            'id' => 'required|exists:users,id',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'phone' => 'required|string',
            'address' => 'required|string',
            'document' => 'required|unique:users,document,' . $request->id,
        ]);

        // Obtener el ID del usuario a actualizar
        $userId = $request->id;

        // Buscar el usuario por su ID
        $user = User::findOrFail($userId);

        // Actualizar los datos del usuario
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->document = $request->document;

        // Guardar los cambios en la base de datos
        $user->save();

        // Devolver una respuesta exitosa
        return response()->json(['message' => 'Usuario actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
    */
    
    public function destroy(string $id)
    {
        // Buscar el usuario por su ID
        $user = User::findOrFail($id);

        // Cambiar el valor de is_active a 2
        $user->is_active = 2;

        // Guardar los cambios en la base de datos
        $user->save();

        // Devolver una respuesta exitosa
        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }

}
