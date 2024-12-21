<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserprofileController extends Controller
{
    public function showUserprofile()
    {
        $user = auth()->user();
        $parentSkills = Skill::whereNull('parent_id')->get(); // Ambil parent skill
        $skills = Skill::where('parent_id', $user->skill_id)->get();

        return view('userprofile', compact('user', 'parentSkills', 'skills'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'full_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'skill_id' => 'required|exists:skills,id',
            'experience' => 'required|string',
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
        ]);  

        return redirect()->route('home')->with('success', 'Profile updated successfully');
    }

    public function destroy()
    {
        $user = auth()->user();
        
        if ($user->avatar) {
            Storage::delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('home')->with('success', 'Profile deleted successfully');
    }

    public function getChildSkills($parentId)
    {
        $childSkills = Skill::where('parent_id', $parentId)->get();
        return response()->json($childSkills);
    }
}
