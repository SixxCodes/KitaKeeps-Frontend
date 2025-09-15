<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // Table name
    protected $table = 'payments';
    // ID (PK)
    protected $primaryKey = 'payment_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'total_amount',
        'payment_date',
        'method',
        'payment_status',
        'created_by',
        'notes',
    ];

    // Casts for proper data types
    protected $casts = [
        'total_amount' => 'decimal:2',
        'payment_date' => 'datetime',
    ];

    // Relationships

    // Payment belongs to a User (creator)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }

    // Optional: If you link payments to sales
    /*
    public function sales()
    {
        return $this->hasMany(Sale::class, 'payment_id', 'payment_id');
    }
    */
}
