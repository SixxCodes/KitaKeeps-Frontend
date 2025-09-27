<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSupplier extends Model
{
    // Table name
    protected $table = 'product_supplier';
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

    // no updated_at
    public $timestamps = false;

    // Casts
    protected $casts = [
        'supplier_cost' => 'decimal:2',
        'preferred' => 'boolean',
        'created_at' => 'datetime',
    ];

    // Relationships: (Tulay table)

    // product_supplier belongsTo product
    public function product_supplierbelongsToproduct()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    // product_supplier belongsTo supplier
    public function product_supplierbelongsTosupplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }
}
