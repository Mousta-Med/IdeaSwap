<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    public function Users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function Posts()
    {
        return $this->belongsTo(Posts::class, 'post_id');
    }
}
