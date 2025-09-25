<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    // Table name
    protected $table = 'supplier';

    // ID (PK)
    protected $primaryKey = 'supplier_id';

    // Fillable fields
    protected $fillable = [
        'supp_name',
        'supp_contact',
        'supp_address',
        'notes',
        'supp_image_path',
        'branch_id', // ← add this
    ];

    // no updated_at;
    public $timestamps = false;

    // Casts for proper data types
    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Relationships: 

    // supplier hasMany product_supplier
    public function supplierhasManyproduct_supplier()
    {
        return $this->hasMany(ProductSupplier::class, 'supplier_id', 'supplier_id');
    }

    // supplier hasMany purchase
    public function supplierhasManypurchase()
    {
        return $this->hasMany(Purchase::class, 'supplier_id', 'supplier_id');
    }

    // Supplier model
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

}
