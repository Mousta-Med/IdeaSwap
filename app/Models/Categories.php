<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    public function Posts()
    {
        return $this->belongsToMany(Post::class, 'category_post', 'post_id', 'category_id');
    }
}
