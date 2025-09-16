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

    // suppliers hasMany product_suppliers
    public function suppliershasManyproduct_suppliers()
    {
        return $this->hasMany(product_suppliers::class, 'supplier_id', 'supplier_id');
    }

    // suppliers hasMany purchases
    public function suppliershasManypurchases()
    {
        return $this->hasMany(purchases::class, 'supplier_id', 'supplier_id');
    }
}
