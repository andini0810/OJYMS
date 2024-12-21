<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['skill_name'];

    // Relasi ke tabel users
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
