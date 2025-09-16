<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
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

    // No timestamps
    public $timestamps = false;

    // Relationships:

    // product_categories hasMany products
    public function product_categorieshasManyproducts()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
