<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // Table name
    protected $table = 'customers';
    // ID (PK)
    protected $primaryKey = 'customer_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'cust_name',
        'cust_contact',
        'cust_address',
        'notes',
    ];

    // Casts for proper data types
    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Relationships

    // customers hasMany sales
    public function customershasManysales()
    {
        return $this->hasMany(Sale::class, 'customer_id', 'customer_id');
    }
    
}
