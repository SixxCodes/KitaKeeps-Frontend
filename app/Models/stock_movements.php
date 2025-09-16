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

    // stock_movements belongsTo branch_prosducts
    public function stock_movementsbelongsTobranch_products()
    {
        return $this->belongsTo(BranchProduct::class, 'branch_product_id', 'branch_product_id');
    }

    // stock_movements belongsTo User 
    public function stock_movementsbelongsToUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }
}
