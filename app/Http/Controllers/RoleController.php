<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;  // Importa User
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Devuelve todos los roles con permisos (API).
     */
    public function index()
    {
        return response()->json(Role::with('permissions')->get());
    }

    /**
     * Muestra la página de roles (vista web).
     */
    public function showRolesPage()
    {
        $users = User::all();
        return view('roles.index', compact('users'));
    }

    /**
     * Muestra la página de roles (vista web).
     */
    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = $request->has('status') ? 'active' : 'inactive';
        $user->save();
        return redirect()->route('roles.index');
    }

    /**
     * Crea un nuevo rol.
     */
    public function store(Request $request)
    {
        $role = Role::create($request->only('nombre'));
        return response()->json($role);
    }
}
