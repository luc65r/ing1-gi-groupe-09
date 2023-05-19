<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start',
        'end',
    ];

    public function projects() {
        return $this->hasMany(Project::class);
    }
}
