<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    // Table name
    protected $table = 'branch';
    // ID (PK)
    protected $primaryKey = 'branch_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'branch_name',
        'location',
    ];

    // Cast created_at as datetime
    // protected $casts = [
    //     'created_at' => 'datetime',
    // ];

    // disable timestamps
    public $timestamps = false;

    // Relationships:

    // branch hasMany branch_product
    public function branchhasManybranch_product()
    {
        return $this->hasMany(BranchProduct::class, 'branch_id', 'branch_id');
    }

    // branch hasMany purchase
    public function branchhasManypurchase()
    {
        return $this->hasMany(Purchase::class, 'branch_id', 'branch_id');
    }

    // branch hasMany user_branch
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_branch', 'branch_id', 'user_id');
    }

    // branch hasMany employee
    // public function branchhasManyemployee()
    // {
    //     return $this->hasMany(Employee::class, 'branch_id', 'branch_id');
    // }

    // branch hasMany sale
    public function branchhasManysale()
    {
        return $this->hasMany(Sale::class, 'branch_id', 'branch_id');
    }
}
