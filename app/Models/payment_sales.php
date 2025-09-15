<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSale extends Model
{
    // Table name
    protected $table = 'payment_sales';

    // Disable auto-incrementing primary key cuz this is a pivot table
    public $incrementing = false;

    // No timestamps
    public $timestamps = false;

    // // Primary key type (optional)
    // protected $keyType = 'string';

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

    // Relationships

    // PaymentSale belongs to a Payment
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'payment_id');
    }

    // PaymentSale belongs to a Sale
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'sale_id');
    }
}
