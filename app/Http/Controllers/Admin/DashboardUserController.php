<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function showDashboard()
    {
        $users = User::orderBy('role_id', '!=', 3)->get(); // Hanya menampilkan non-admin
        return view('admin.dashboard', compact('users'));
    }

    // public function index()
    // {
    //     $users = User::where('role_id', '!=', 3)->get(); // Hanya menampilkan non-admin
    //     return view('admin.dashboard', compact('users'));
    // }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user); // Mengirim data sebagai JSON untuk form edit
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route('admin.users')->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Data user berhasil dihapus.');
    }
}
