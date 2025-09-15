<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    // Table name
    protected $table = 'forecasts';
    // ID (PK)
    protected $primaryKey = 'forecast_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'branch_product_id',
        'period_start',
        'period_end',
        'forecast_qty',
        'method',
    ];

    // Casts for proper data types
    protected $casts = [
        'period_start' => 'date',
        'period_end' => 'date',
        'forecast_qty' => 'integer',
        'created_at' => 'datetime',
    ];

    // Relationships

    // Forecast belongs to a BranchProduct
    public function branchProduct()
    {
        return $this->belongsTo(BranchProduct::class, 'branch_product_id', 'branch_product_id');
    }
}
