<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
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

    // Relationships:

    // branches hasMany branch_products
    public function brancheshasManybranch_products()
    {
        return $this->hasMany(BranchProduct::class, 'branch_id', 'branch_id');
    }

    // branches hasMany purchases
    public function brancheshasManypurchases()
    {
        return $this->hasMany(Purchase::class, 'branch_id', 'branch_id');
    }

    // branches hasMany employees
    public function brancheshasManyemployees()
    {
        return $this->hasMany(Employee::class, 'branch_id', 'branch_id');
    }

    // branches hasMany sales
    public function brancheshasManysales()
    {
        return $this->hasMany(Sale::class, 'branch_id', 'branch_id');
    }
}
