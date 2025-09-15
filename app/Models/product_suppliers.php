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

    // ProductSupplier belongs to a Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    // ProductSupplier belongs to a Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }
}
