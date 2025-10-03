<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    // Table name
    protected $table = 'sale';

    // ID (PK)
    protected $primaryKey = 'sale_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'branch_id',
        'customer_id',
        'total_amount',
        'payment_type',
        'due_date',
        'sale_date',
        'created_by',
        'notes',
    ];

    // no updated_at
    public $timestamps = false;

    // Casts for proper data types
    protected $casts = [
        'total_amount' => 'decimal:2',
        'due_date' => 'date',
        'sale_date' => 'datetime',
    ];

    // Relationships:

    // sale belongsTo branch
    public function salebelongsTobranch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    // polymorphic relationship to stock movements
    // sale hasMany stock_movement
    public function salehasManystock_movement()
    {
        return $this->hasMany(StockMovement::class, 'reference_id', 'sale_id')
                    ->where('movement_type', 'Sale');
    }

    // sale hasMany sale_item
    public function sale_items()
    {
        return $this->hasMany(SaleItem::class, 'sale_id', 'sale_id');
    }

    // sale belongsTo customer
    public function salebelongsTocustomer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    // sale hasMany payment_sale
    public function salehasManypayment_sale()
    {
        return $this->hasMany(PaymentSale::class, 'sale_id', 'sale_id');
    }

    // sale belongsTo User
    public function salebelongsToUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }
}
