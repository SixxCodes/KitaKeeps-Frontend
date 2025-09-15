<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // Table name
    protected $table = 'employees';

    // Primary key
    protected $primaryKey = 'employee_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'emp_firstname',
        'emp_lastname',
        'emp_contact',
        'daily_rate',
        'branch_id',
    ];

    // Casts for proper data types
    protected $casts = [
        'daily_rate' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    // Relationships

    // Employee belongs to a Branch
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    // Employee has many attendances
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id', 'employee_id');
    }
}
