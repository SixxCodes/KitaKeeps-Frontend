<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class branches extends Model
{
    // Table name
    protected $table = 'branches';
    // ID (PK)
    protected $primaryKey = 'branch_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'branch_name',
        'location',
    ];

    // Cast created_at as datetime
    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Relationships
    // Branch has many branch_products
    public function branch_products_function()
    {
        return $this->hasMany(branch_products::class, 'branch_id', 'branch_id');
    }
}
