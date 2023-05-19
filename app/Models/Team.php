<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function students() {
        return $this->belongsToMany(Student::class);
    }

    public function owner() {
        return $this->belongsTo(Student::class, 'owner');
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }
}
