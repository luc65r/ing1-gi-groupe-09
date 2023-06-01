<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner',
        'project_id',
        'code',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_team', 'team_id', 'student_id');
    }

    public function owner()
    {
        return $this->belongsTo(Student::class, 'owner');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function hasAnsweredQuiz($quiz)
    {
        return $this->answers()->where('quiz_id', $quiz->id)->exists();
    }
}
