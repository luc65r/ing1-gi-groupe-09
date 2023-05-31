<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'contest_id',
    ];

    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function managers()
    {
        return $this->belongsToMany(Manager::class); //, 'manager_project', 'project_id', 'manager_id');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
