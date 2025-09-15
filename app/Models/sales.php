<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    // Table name
    protected $table = 'sales';

    // ID (PK)
    protected $primaryKey = 'sale_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'branch_id',
        'customer_id',
        'total_amount',
        'payment_type',
        'due_date',
        'sale_date',
        'created_by',
        'notes',
    ];

    // Casts for proper data types
    protected $casts = [
        'total_amount' => 'decimal:2',
        'due_date' => 'date',
        'sale_date' => 'datetime',
    ];

    // Relationships

    // Sale belongs to a Branch
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    // Sale belongs to a Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    // Sale belongs to a User (created_by)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }

    // Sale has many sale items (optional, if you have a sale_items table)
    /*
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class, 'sale_id', 'sale_id');
    }
    */
}
