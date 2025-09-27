<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Table name
    protected $table = 'category';
    // ID (PK)
    protected $primaryKey = 'category_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'cat_name',
        'cat_description',
        'branch_id',
    ];

    // Casts for proper data types
    // protected $casts = [
    //     'created_at' => 'datetime',
    // ];

    public $timestamps = false;

    // Relationships

    // category hasMany product
    public function product()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }
    
}
