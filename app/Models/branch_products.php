<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchProduct extends Model
{
    // Table name
    protected $table = 'branch_products';
    // ID (PK)
    protected $primaryKey = 'branch_product_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'branch_id', // FK
        'product_id', // FK
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

    // branch_products hasMany forecasts
    public function branch_productshasManyforecasts()
    {
        return $this->hasMany(Forecast::class, 'branch_product_id', 'branch_product_id');
    }

    // branch_products hasMany stock_movements
    public function branch_productshasManystock_movements()
    {
        return $this->hasMany(StockMovement::class, 'branch_product_id', 'branch_product_id');
    }

    // branch_products hasMany sale_items
    public function branch_productshasManysale_items()
    {
        return $this->hasMany(SaleItem::class, 'branch_product_id', 'branch_product_id');
    }

    // branch_products belongs to branches
    public function branch_productsBelongsTobranches()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    // branch_products belongs to products
    public function branch_productsBelongsToproducts()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    // branch_products hasMany purchase_items
    public function branch_productshasManypurchase_items()
    {
        return $this->hasMany(PurchaseItem::class, 'branch_product_id', 'branch_product_id');
    }
}