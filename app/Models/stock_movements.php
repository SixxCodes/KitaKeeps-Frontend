<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    // Table name
    protected $table = 'stock_movements';

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

    // Casts for proper data types
    protected $casts = [
        'change_qty' => 'integer',
        'movement_date' => 'datetime',
    ];

    // Relationships

    // StockMovement belongs to a BranchProduct
    public function branchProduct()
    {
        return $this->belongsTo(BranchProduct::class, 'branch_product_id', 'branch_product_id');
    }

    // StockMovement belongs to a User (creator)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }
}
