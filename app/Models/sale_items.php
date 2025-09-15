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

    // SaleItem belongs to a Sale
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'sale_id');
    }

    // SaleItem belongs to a BranchProduct
    public function branchProduct()
    {
        return $this->belongsTo(BranchProduct::class, 'branch_product_id', 'branch_product_id');
    }
}
