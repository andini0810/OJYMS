<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'name' => 'required|string|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Simpan user ke database
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id, // Ambil role_id dari input form
            'name' => $request->name, // Bisa ditambahkan input nama di form
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
        $user = auth()->user();

        $request->validate([
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'full_name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'company_location' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'skill_id' => 'nullable|integer',
        ]);

        if ($request->hasFile('profile_photo')) {
            // Hapus file lama jika ada
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }
        
            // Simpan file baru
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $path;
        }

        $user->update([
            'profile_photo' => $user->profile_photo,
            'full_name' => $request->full_name,
            'location' => $request->location,
            'experience' => $request->experience,
            'company_name' => $request->company_name,
            'company_location' => $request->company_location,
            'job_title' => $request->job_title,
            'skill_id' => $request->skill_id,
            'status' => "aktif",
        ]);

        $user->save();

        return redirect()->route('home')->with('success', 'Profile updated successfully.');
    }

    public function deletePhoto()
    {
        $user = auth()->user();

        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
            $user->profile_photo = null;
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile photo deleted successfully.');
    }
}
