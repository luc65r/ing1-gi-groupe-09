<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'team_id',
    ];

    public function quiz() {
        return $this->belongsTo(Quiz::class);
    }

    public function team() {
        return $this->belongsTo(Team::class);
    }
}
