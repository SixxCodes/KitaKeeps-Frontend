<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
    // Table name 
    protected $table = 'attendance';
    // ID (PK)
    protected $primaryKey = 'attendance_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'employee_id',
        'att_date',
        'status',
        'note',
    ];

    // Cast dates
    protected $casts = [
        'att_date' => 'date',
        'created_at' => 'datetime',
    ];

    // Relationships
    // Allows each Attendance record to “know” which Employee it belongs to.
    // ERD: Employee: one and only one - has - one to many :attendance
    public function employees_function()
    {
        return $this->belongsTo(employees::class, 'employee_id', 'employee_id');
    }
}
