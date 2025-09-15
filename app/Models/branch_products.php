<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class branch_products extends Model
{
    // Table name
    protected $table = 'branch_products';
    // ID (PK)
    protected $primaryKey = 'branch_product_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'branch_id',
        'product_id',
        'stock_qty',
        'reorder_level',
        'is_active',
    ];

    // Casts for proper data types
    protected $casts = [
        'stock_qty' => 'integer',
        'reorder_level' => 'integer',
        'is_active' => 'boolean',
    ];

    // Relationships:

    // BranchProduct belongs to a Branch
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    // BranchProduct belongs to a Product
    public function products_function()
    {
        return $this->belongsTo(products::class, 'product_id', 'product_id');
    }
}
