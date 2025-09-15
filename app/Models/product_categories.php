<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_categories extends Model
{
    // Table name
    protected $table = 'product_categories';
    // ID (PK)
    protected $primaryKey = 'category_id';

    // Fillable fields for mass assignment
    protected $fillable = [
        'cat_name',
        'cat_description',
    ];

    // Relationships
    // A category can have many products
    public function products_function_two()
    {
        return $this->hasMany(products::class, 'category_id', 'category_id');
    }
}
