<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    // Table
    protected $table = 'users';
    // ID (PK)
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'username',
        'password',
        'user_firstname',
        'user_lastname',
        'user_email',
        'last_login',
        'profile_pic',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'last_login' => 'datetime',
        'created_at' => 'datetime',
    ];

    // Automatically hash password
    public function setPasswordAttribute($password)
    {
        if ($password) {
            $this->attributes['password'] = Hash::make($password);
        }
    }
}
