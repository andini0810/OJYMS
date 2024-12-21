<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    public function getChildren($parentId)
    {
        $children = Skill::where('parent_id', $parentId)->get();

        return response()->json($children);
    }
}
