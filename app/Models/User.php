<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telephone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function student() {
        return $this->hasOne(Student::class);
    }

    public function admin() {
        return $this->hasOne(Admin::class);
    }

    public function manager() {
        return $this->hasOne(Manager::class);
    }

    public function hasRole($role) {
        switch ($role) {
            case 'admin':
                return !!$this->admin;
            case 'student':
                return !!$this->student;
            case 'manager':
                return !!$this->manager;
            default:
                return false;
        }
    }

    public function messagesSent() {
        return $this->hasMany(Message::class, 'sender');
    }

    public function messagesRecieved() {
        return $this->belongsToMany(Message::class);
    }
}
