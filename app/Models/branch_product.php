<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchProduct extends Model
{
    // Table name
    protected $table = 'branch_product';
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

    // branch_product hasMany forecast
    public function branch_producthasManyforecast()
    {
        return $this->hasMany(Forecast::class, 'branch_product_id', 'branch_product_id');
    }

    // branch_product belongs to branch
    public function branch_productBelongsTobranch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    // branch_product belongs to product
    public function branch_productBelongsToproduct()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    // branch_product hasMany purchase_item
    public function branch_producthasManypurchase_item()
    {
        return $this->hasMany(PurchaseItem::class, 'branch_product_id', 'branch_product_id');
    }

    // branch_product hasMany stock_movement
    public function branch_producthasManystock_movement()
    {
        return $this->hasMany(StockMovement::class, 'branch_product_id', 'branch_product_id');
    }

    // branch_product hasMany sale_item
    public function branch_producthasManysale_item()
    {
        return $this->hasMany(SaleItem::class, 'branch_product_id', 'branch_product_id');
    }



    



    

    
    

    

    // branch_products hasMany purchase_item
    public function branch_productshasManypurchase_item()
    {
        return $this->hasMany(PurchaseItem::class, 'branch_product_id', 'branch_product_id');
    }
}