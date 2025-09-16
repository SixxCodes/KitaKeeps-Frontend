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

    // Casts
    protected $casts = [
        'total_amount' => 'decimal:2',
        'payment_date' => 'datetime',
    ];

    // Relationships

    // payments belongsTo User
    public function paymentsbelongsToUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // payments hasMany payment_sales
    public function paymentshasManypayment_sales()
    {
        return $this->hasMany(PaymentSale::class, 'payment_id', 'payment_id');
    }
}
