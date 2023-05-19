<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'school',
        'education_level',
        'city',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function teams() {
        return $this->belongsToMany(Team::class);
    }

    public function teamsOwned() {
        return $this->hasMany(Team::class, 'owner');
    }
}
