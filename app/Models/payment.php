<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // Table name
    protected $table = 'payment';
    // ID (PK)
    protected $primaryKey = 'payment_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'payment_date',
        'payment_method',
        'payment_status',
        'created_by',
        'notes',
    ];

    // Casts
    protected $casts = [
        'payment_date' => 'datetime',
    ];

    // Relationships

    // payment belongsTo User
    public function paymentbelongsToUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }

    // payment hasMany payment_sale
    public function paymenthasManypayment_sale()
    {
        return $this->hasMany(PaymentSale::class, 'payment_id', 'payment_id');
    }
}
