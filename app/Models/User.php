<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable; // trait, adds methods to User model so that users can receive notifications (email, database, SMS, etc.).

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

    // Relationships:

    // User hasMany audit_log
    public function userhasManyaudit_log()
    {
        return $this->hasMany(AuditLog::class, 'user_id', 'user_id');
    }

    // User hasMany sales
    public function userhasManysales()
    {
        return $this->hasMany(Sale::class, 'created_by', 'user_id');
    }

    // User hasMany purchases
    public function UserhasManypurchases()
    {
        return $this->hasMany(Purchase::class, 'created_by', 'user_id');
    }

    // User hasMany stock_movements
    public function UserhasManystock_movements()
    {
        return $this->hasMany(StockMovement::class, 'created_by', 'user_id');
    }

    // User hasMany payments
    public function UserhasManypayments()
    {
        return $this->hasMany(Payment::class, 'user_id', 'user_id');
    }

    // User hasMany branches
    public function UserhasManybranches()
    {
        return $this->hasMany(Branch::class, 'user_id', 'user_id');
    }
}
