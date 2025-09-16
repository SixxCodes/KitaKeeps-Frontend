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

    // purchase_items belongsTo purchases
    public function purchase_itemsbelongsTopurchases()
    {
        return $this->belongsTo(purchases::class, 'purchase_id', 'purchase_id');
    }

    // purchase_items belongsTo branch_products
    public function purchase_itemsbelongsTobranch_products()
    {   
        return $this->belongsTo(branch_products::class, 'branch_product_id', 'branch_product_id');
    }
}
