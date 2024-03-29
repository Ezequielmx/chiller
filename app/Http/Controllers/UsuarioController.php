<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\Client;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:users',
            'pass' => 'required|min:8',
        ]);

        $passhash = Hash::make($request->pass);

        $newus = User::create([
            'name' => $request->nombre,
            'email' => $request->email,
            'password' => $passhash,
        ]);

        $newus->roles()->sync(1);

        return redirect()->route('admin.usuarios.index')->with('info', 'Usuario agregado con éxito');
    }

    public function show($id)
    {
        //
    }

    public function edit($userv)
    {
        $user = User::find($userv);
        $roles = Role::all();
        return view('admin.usuarios.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $userM)
    {
        $user = User::find($userM);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'pass' => 'nullable|min:8',
            'copiamail' => 'nullable'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->copiamail = $request->copiamail;
        //if user->copiamail is null set to 0
        if ($user->copiamail == null) {
            $user->copiamail = 0;
        }

        if ($request->pass != null) {
            $passhash = Hash::make($request->pass);
            $user->password = $passhash;
        }

        if ($request->client_id != null) {
            $user->client_id = $request->client_id;
        }

        $user->save();
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.usuarios.index')->with('info', 'Usuario modificado con éxito');
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect()->route('admin.usuarios.index')->with('info', 'Usuario eliminado con éxito');
    }
}
