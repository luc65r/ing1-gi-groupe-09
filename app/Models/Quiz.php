<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'project_id',
        'start',
        'end',
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function grades() {
        return $this->hasMany(Grade::class);
    }
}
