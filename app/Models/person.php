<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    // Table name
    protected $table = 'person';
    // ID (PK)
    protected $primaryKey = 'person_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'firstname',
        'lastname',
        'contact_number',
        'email',
        'address',
        'gender',
    ];

    // wlay timestamps
    public $timestamps = false;

    // Relationships:

    // person hasOne employee
    public function personhasOneemployee()
    {
        return $this->hasOne(Employee::class, 'person_id', 'person_id');
    }

    // person hasOne User
    public function personhasOneUser()
    {
        return $this->hasOne(User::class, 'person_id', 'person_id');
    }
}
