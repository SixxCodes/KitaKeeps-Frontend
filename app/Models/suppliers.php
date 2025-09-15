<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    // Table name
    protected $table = 'suppliers';

    // ID (PK)
    protected $primaryKey = 'supplier_id';

    // Fillable fields
    protected $fillable = [
        'supp_name',
        'supp_contact',
        'supp_address',
        'notes',
    ];

    // Casts for proper data types
    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Relationships
    // If suppliers supply many products (through product_suppliers table)
    public function productSuppliers()
    {
        return $this->hasMany(ProductSupplier::class, 'supplier_id', 'supplier_id');
    }
}
