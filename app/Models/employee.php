<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // Table name
    protected $table = 'employee';

    // Primary key
    protected $primaryKey = 'employee_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'person_id',
        'daily_rate',
        'hire_date',
        'position',
        'employee_image_path',
    ];

    // Casts for proper data types
    protected $casts = [
        'daily_rate' => 'decimal:2',
        'hire_date' => 'date',
        'created_at' => 'datetime',
    ];

    // Relationships

    // employees belongsTo person
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id', 'person_id');
    }

}
