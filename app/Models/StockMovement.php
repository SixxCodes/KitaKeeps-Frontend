<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    // Table name
    protected $table = 'stock_movement';

    // ID (PK)
    protected $primaryKey = 'movement_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'branch_product_id',
        'change_qty',
        'movement_type',
        'reference_id',
        'note',
        'movement_date',
        'created_by',
    ];

    // no updated_at
    public $timestamps = false;

    // Casts for proper data types
    protected $casts = [
        'reference_id' => 'integer',
        'change_qty' => 'integer',
        'movement_date' => 'datetime',
    ];

    // Relationships

    // stock_movement belongsTo branch_product
    public function stock_movementbelongsTobranch_product()
    {
        return $this->belongsTo(BranchProduct::class, 'branch_product_id', 'branch_product_id');
    }

    // polymorphic relationship to reference (Sale, Purchase, Adjustment)
    public function reference()
    {
        return match ($this->movement_type) {
            'Sale' => $this->hasOne(Sale::class, 'reference_id', 'sale_id'),
            'Purchase' => $this->hasOne(Purchase::class, 'reference_id', 'purchase_id'),
            default => null, // Adjustment = no reference
        };
    }

    // stock_movementhasOneUser 
    public function stock_movementhasOneUser()
    {
        return $this->hasOne(User::class, 'created_by', 'user_id');
    }
}
