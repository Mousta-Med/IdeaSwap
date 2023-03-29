<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }
    public function Categories()
    {
        return $this->belongsToMany(Categories::class, 'category_post', 'post_id', 'category_id');
    }
    public function Comments()
    {
        return $this->hasMany(Comments::class, 'post_id')->latest();
    }
    use HasFactory;
}
