<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
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

    // Relationships:

    // attendance belongsTo employees
    public function attendancebelongsToemployees()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}
