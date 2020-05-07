<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $fillable = [
        'category_name_en',
        'category_name_bn',
    ]; 

    public function posts()
    {
        return $this->hasMany(Post::class, 'post_category_id');
    }
}
