<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    // Table name
    protected $table = 'purchase_item';

    // ID (PK)
    protected $primaryKey = 'purchase_item_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'purchase_id',
        'branch_product_id',
        'quantity',
        'unit_cost',
        'subtotal',
    ];

    // No timestamps
    public $timestamps = false;

    // Casts for proper data types
    protected $casts = [
        'quantity' => 'integer',
        'unit_cost' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    // Relationships:

    // purchase_item belongsTo purchase
    public function purchase_itembelongsTopurchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'purchase_id');
    }

    // purchase_item belongsTo branch_product
    public function purchase_itembelongsTobranch_product()
    {   
        return $this->belongsTo(BranchProduct::class, 'branch_product_id', 'branch_product_id');
    }
}
