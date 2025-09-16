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

    // Relationships:

    // branches has many branch_products
    public function brancheshasManybranch_products()
    {
        return $this->hasMany(branch_products::class, 'branch_id', 'branch_id');
    }

    // branches has many purchases
    public function brancheshasManypurchases()
    {
        return $this->hasMany(purchases::class, 'branch_id', 'branch_id');
    }

    // branches has many employees
    public function brancheshasManyemployees()
    {
        return $this->hasMany(employees::class, 'branch_id', 'branch_id');
    }

    // branches has many sales
    public function brancheshasManysales()
    {
        return $this->hasMany(sales::class, 'branch_id', 'branch_id');
    }
}
