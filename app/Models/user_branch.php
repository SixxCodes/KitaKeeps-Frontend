<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBranch extends Model
{
    // Table name
    protected $table = 'person';
    // ID (PK)
    protected $primaryKey = 'user_branch_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'branch_id',
    ];

    // wlay timestamps
    public $timestamps = false;

    // Relationships:

    // user_branch belongsTo User
    public function user_branchbelongsToUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // user_branch belongsTo branch
    public function user_branchbelongsTobranch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }
}
