<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobsApply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jobsapply_id',
        'full_name',
        'email',
        'cv_link',
    ];

    public function job()
    {
        return $this->belongsTo(JobsCreate::class, 'jobs_creates_id');
        return $this->belongsTo(JobsCreate::class, 'jobsapply_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

    
}
