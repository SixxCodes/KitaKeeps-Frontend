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
    ];

    // Casts for proper data types
    // protected $casts = [
    //     'created_at' => 'datetime',
    // ];

    public $timestamps = false;

    // Relationships

    // category hasMany product
    public function categoryhasManyproduct()
    {
        return $this->hasMany(Product::class, 'customer_id', 'customer_id');
    }
    
}
