<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSale extends Model
{
    // Table name
    protected $table = 'payment_sale';
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

    // payment_sale belongsTo payment
    public function payment_salebelongsTopayment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'payment_id');
    }

    // payment_sale belongsTo sale
    public function payment_salebelongsTosale()
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'sale_id');
    }
}
