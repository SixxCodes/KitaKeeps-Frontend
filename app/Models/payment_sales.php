<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSale extends Model
{
    // Table name
    protected $table = 'payment_sales';
    // ID (PK)
    protected $primaryKey = 'payment_sale_id';

    // No timestamps
    public $timestamps = false;

    // Fillable fields
    protected $fillable = [
        'payment_id',
        'sale_id',
        'amount',
    ];

    // Casts
    protected $casts = [
        'amount' => 'decimal:2',
    ];

    // Relationships:

    // payment_sales belongsTo payments
    public function payment_salesbelongsTopayments()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'payment_id');
    }

    // payment_sales belongsTo sales
    public function payment_salesbelongsTosales()
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'sale_id');
    }
}
