<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        'category_name', 
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id');
    }
    
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}

// Parent-Child Delete
// https://quickadminpanel.com/blog/one-to-many-with-soft-deletes-deleting-parent-restrict-or-cascade/