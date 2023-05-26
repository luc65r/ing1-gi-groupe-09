<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'body',
        'sender',
    ];

    public function sender() {
        return $this->belongsTo(User::class, 'sender');
    }

    public function recievers() {
        return $this->belongsToMany(User::class);
    }
}
