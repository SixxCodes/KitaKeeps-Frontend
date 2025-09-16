<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class audit_log extends Model
{
    // Table name
    protected $table = 'audit_log';
    // ID (PK)
    protected $primaryKey = 'id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'action',
        'details',
    ];

    // Cast created_at as datetime
    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Relationship: an audit log belongs to a user
    // ERD: User: zero or one - generates - one to many :audit_log
    public function user_function()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
