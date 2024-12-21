<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class FormController extends Controller
{
    public function showForm($id)
    {
        $userId = $id;
        $parentSkills = Skill::whereNull('parent_id')->get();
        
        return view('auth.form', compact('parentSkills', 'userId'));
    }
    
    
}
