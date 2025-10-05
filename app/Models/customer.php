<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // Table name
    protected $table = 'customer';
    // ID (PK)
    protected $primaryKey = 'customer_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'branch_id',
        'cust_name',
        'cust_contact',
        'cust_address',
        'notes',
        'cust_image_path',
    ];

    // no updated_at
    public $timestamps = false;

    // Casts for proper data types
    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Relationships

    // customer hasMany sale
    public function sales()
    {
        return $this->hasMany(Sale::class, 'customer_id', 'customer_id');
    }

    // customer hasMany sale
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($customer) {
            // Delete all sales linked to this customer
            foreach ($customer->sales as $sale) {
                // delete related sale items
                $sale->sale_items()->delete();
                // delete related payments
                $sale->salehasManypayment_sale()->delete();
                // delete related stock movements
                $sale->salehasManystock_movement()->delete();

                $sale->delete();
            }
        });
    }
    
}
