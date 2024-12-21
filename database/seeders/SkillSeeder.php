<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Parent Skills
        $design = Skill::create(['name' => 'Design']);
        $programming = Skill::create(['name' => 'Programming']);

        // Child Skills
        Skill::create(['name' => 'UI/UX', 'parent_id' => $design->id]);
        Skill::create(['name' => 'Logo', 'parent_id' => $design->id]);
        Skill::create(['name' => 'Backend', 'parent_id' => $programming->id]);
        Skill::create(['name' => 'Frontend', 'parent_id' => $programming->id]);
    }
}
