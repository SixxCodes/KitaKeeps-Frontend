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

    // Relationships:

    // sales belongsTo customers
    public function salesbelongsTocustomers()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    // sales belongsTo branches
    public function salesbelongsTobranches()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    // sales hasMany sale_items
    public function saleshasManysale_items()
    {
        return $this->hasMany(SaleItem::class, 'sale_id', 'sale_id');
    }

    // sales hasMany payment_sales
    public function saleshasManypayment_sales()
    {
        return $this->hasMany(PaymentSale::class, 'sale_id', 'sale_id');
    }
    
    // sales belongsTo User
    public function salesbelongsToUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }
}
