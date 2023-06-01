<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'team_id',
        'answer',
    ];

    public $timestamps = false;

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
