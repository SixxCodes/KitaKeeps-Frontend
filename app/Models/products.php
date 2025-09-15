<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    // Table name
    protected $table = 'products';
    // ID (PK)
    protected $primaryKey = 'product_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'sku',
        'product_image',
        'prod_name',
        'prod_description',
        'category_id',
        'unit_cost',
        'selling_price',
        'is_active',
    ];

    // Casts for proper data types
    protected $casts = [
        'unit_cost' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships

    // Product belongs to a category
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'category_id');
    }

    // Product can belong to many branches through branch_products
    public function branchProducts()
    {
        return $this->hasMany(BranchProduct::class, 'product_id', 'product_id');
    }
}
