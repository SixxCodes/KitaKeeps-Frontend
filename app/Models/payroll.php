<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    // Table name
    protected $table = 'payroll';
    // ID (PK)
    protected $primaryKey = 'payroll_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'employee_id',
        'period_start',
        'period_end',
        'gross_pay',
        'deductions',
        'net_pay',
    ];

    // Casts for proper data types
    protected $casts = [
        'period_start' => 'date',
        'period_end' => 'date',
        'gross_pay' => 'decimal:2',
        'deductions' => 'decimal:2',
        'net_pay' => 'decimal:2',
        'generated_at' => 'datetime',
    ];

    // Relationships:

    // payroll belongsTo employee
    public function payrollbelongsToemployee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}
