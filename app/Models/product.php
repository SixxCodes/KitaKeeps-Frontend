<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Table name
    protected $table = 'product';
    // ID (PK)
    protected $primaryKey = 'product_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'sku',
        'prod_name',
        'prod_description',
        'category_id',
        'unit_cost',
        'selling_price',
        'is_active',
        'prod_image_path',
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

    // product hasMany branch_product
    public function branch_product()
    {
        return $this->hasMany(BranchProduct::class, 'product_id', 'product_id');
    }

    // product belongsTo category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    // product hasMany product_supplier
    // public function product_supplier()
    // {
    //     return $this->hasMany(ProductSupplier::class, 'product_id', 'product_id');
    // }
}
