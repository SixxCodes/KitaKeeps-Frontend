<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    // Table name
    protected $table = 'purchase';

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

    // Relationships:

    // purchase belongsTo branch
    public function purchasebelongsTobranch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    // purchase belongsTo User
    public function purchasebelongsToUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }

    // polymorphic relationship to stock movements
    // purchase hasMany stock_movement
    public function purchasehasManystock_movement()
    {
        return $this->hasMany(StockMovement::class, 'reference_id', 'purchase_id')
                    ->where('movement_type', 'Purchase');
    }

    // purchase hasMany purchase_item
    public function purchasehasManypurchase_item()
    {
        return $this->hasMany(PurchaseItem::class, 'purchase_id', 'purchase_id');
    }

    // purchase belongsTo supplier
    public function purchasebelongsTosupplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }
}
