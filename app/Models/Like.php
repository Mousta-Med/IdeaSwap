<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    use HasFactory;

    protected $fillable = ['user_id', 'post_id'];

    public function Users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function Posts()
    {
        return $this->belongsTo(Posts::class, 'post_id');
    }
}
