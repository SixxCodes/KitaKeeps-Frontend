<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    // Table name
    protected $table = 'sale_items';

    // Primary key
    protected $primaryKey = 'id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'sale_id',
        'branch_product_id',
        'quantity',
        'unit_price',
        'subtotal',
    ];

    // Casts for proper data types
    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    // Relationships

    // sale_items belongsTo sales
    public function sale_itemsbelongsTosales()
    {
        return $this->belongsTo(sales::class, 'sale_id', 'sale_id');
    }

    // sale_items belongsTo branch_products
    public function sale_itemsbelongsTobranch_products()
    {
        return $this->belongsTo(branch_products::class, 'branch_product_id', 'branch_product_id');
    }
}
