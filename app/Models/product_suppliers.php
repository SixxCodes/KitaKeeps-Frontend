<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSupplier extends Model
{
    // Table name
    protected $table = 'product_suppliers';
    // ID (PK)
    protected $primaryKey = 'prodsupp_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'product_id',
        'supplier_id',
        'supplier_sku',
        'supplier_cost',
        'preferred',
    ];

    // Casts for proper data types
    protected $casts = [
        'supplier_cost' => 'decimal:2',
        'preferred' => 'boolean',
        'created_at' => 'datetime',
    ];

    // Relationships

    // product_suppliers belongsTo products
    public function product_suppliersbelongsToproducts()
    {
        return $this->belongsTo(products::class, 'product_id', 'product_id');
    }

    // product_suppliers belongsTo suppliers
    public function product_suppliersbelongsTosuppliers()
    {
        return $this->belongsTo(suppliers::class, 'supplier_id', 'supplier_id');
    }
}
