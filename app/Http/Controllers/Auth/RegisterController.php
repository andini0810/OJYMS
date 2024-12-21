<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Skill;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        $roles = Role::all();

        return view('auth.register', compact('roles'));
    }

    public function register(Request $request)
    {
         //dd($request->all());
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Simpan user ke database
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id, // Ambil role_id dari input form
            'name' => '', // Bisa ditambahkan input nama di form
            'status' => "nonaktif"
        ]);
        
        
        //dd($user()); // Debugging

        // Login user setelah register
        Auth::login($user);

        // Redirect berdasarkan role
        if ($user->role_id === 3) {
            return redirect()->route('admin.dashboard');
         }

        return redirect()->route('form');
    }

    public function edit()
    {
        // Ambil data user berdasarkan ID
        $user = auth()->user();
        $parentSkills = Skill::whereNull('parent_id')->get();

        // Pastikan hanya user terkait yang bisa mengedit datanya
        if (Auth::id() !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('auth.form', compact('user', 'parentSkills'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $user = auth()->user();

        // Validasi data form
        $request->validate([
            'full_name' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'company_location' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
        ]);

        // Update data user
        $user->update([
            'full_name' => $request->full_name,
            'location' => $request->location,
            'experience' => $request->experience,
            'company_name' => $request->company_name,
            'company_location' => $request->company_location,
            'job_title' => $request->job_title,
            'skill_id' => $request->skill_id,
            'status' => "aktif",
        ]);  

        return redirect()->route('home')->with('success', 'Data berhasil diperbarui.');
    }
}
