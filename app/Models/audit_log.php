<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
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

    // Casts
    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Relationship:

    // audit_log belongsTo User
    public function audit_logbelongsToUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
