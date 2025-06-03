<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        return Permission::with('roles')->get();
    }

    public function store(Request $request)
    {
        $permission = Permission::create($request->only('nombre'));
        return response()->json($permission);
    }
}
