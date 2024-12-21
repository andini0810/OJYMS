<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan daftar pengguna.
     */
    public function index()
{
    $users = User::all();
    return view('admin.users', ['action' => 'index', 'users' => $users]);
}

public function create()
{
    return view('admin.users', ['action' => 'create']);
}

public function store(Request $request)
{
    User::create($request->all());
    return redirect()->route('admin.users.index');
}

public function edit(User $user)
{
    return view('admin.users', ['action' => 'edit', 'user' => $user]);
}

public function update(Request $request, User $user)
{
    $user->update($request->all());
    return redirect()->route('admin.users.index');
}

public function show(User $user)
{
    return view('admin.users', ['action' => 'show', 'user' => $user]);
}

public function destroy(User $user)
{
    $user->delete();
    return redirect()->route('admin.users.index');
}

public function test()
{
    $users = User::with('role')->get();

    return response()->json([
        'user' => $users,
    ]);
}

}