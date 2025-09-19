<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    // Table name
    protected $table = 'sale_item';

    // Primary key
    protected $primaryKey = 'sale_item_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'sale_id',
        'branch_product_id',
        'quantity',
        'unit_price',
        'subtotal',
    ];  

    // No timestamps
    public $timestamps = false;

    // Casts for proper data types
    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    // Relationships:

    // sale_item belongsTo sale
    public function sale_itembelongsTosale()
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'sale_id');
    }

    // sale_item belongsTo branch_product
    public function sale_itembelongsTobranch_product()
    {
        return $this->belongsTo(BranchProduct::class, 'branch_product_id', 'branch_product_id');
    }
}
