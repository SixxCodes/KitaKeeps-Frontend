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

    // purchases belongsTo suppliers
    public function purchasesbelongsTosuppliers()
    {
        return $this->belongsTo(suppliers::class, 'supplier_id', 'supplier_id');
    }

    // purchases hasMany purchase_items
    public function purchaseshasManypurchase_items()
    {
        return $this->hasMany(purchase_items::class, 'purchase_id', 'purchase_id');
    }

    // purchases belongsTo User
    public function purchasesbelongsToUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }

    // purchases belongsTo branches
    public function purchasesbelongsTobranches()
    {
        return $this->belongsTo(branches::class, 'branch_id', 'branch_id');
    }
}
