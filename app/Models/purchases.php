<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    // Table name
    protected $table = 'purchases';

    // ID (PK)
    protected $primaryKey = 'purchase_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'supplier_id',
        'branch_id',
        'total_amount',
        'purchase_date',
        'received',
        'created_by',
        'notes',
    ];

    // Casts for proper data types
    protected $casts = [
        'total_amount' => 'decimal:2',
        'purchase_date' => 'datetime',
        'received' => 'boolean',
    ];

    // Relationships

    // Purchase belongs to a Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }

    // Purchase belongs to a Branch
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    // Purchase belongs to a User (created_by)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }

    // Optional: Purchase has many items (if you have a purchase_items table)
    /*
    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class, 'purchase_id', 'purchase_id');
    }
    */
}
