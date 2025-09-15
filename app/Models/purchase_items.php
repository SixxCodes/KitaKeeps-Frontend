<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    // Table name
    protected $table = 'purchase_items';

    // ID (PK)
    protected $primaryKey = 'id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'purchase_id',
        'branch_product_id',
        'quantity',
        'unit_cost',
        'subtotal',
    ];

    // Casts for proper data types
    protected $casts = [
        'quantity' => 'integer',
        'unit_cost' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    // Relationships

    // PurchaseItem belongs to a Purchase
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'purchase_id');
    }

    // PurchaseItem belongs to a BranchProduct
    public function branchProduct()
    {
        return $this->belongsTo(BranchProduct::class, 'branch_product_id', 'branch_product_id');
    }
}
