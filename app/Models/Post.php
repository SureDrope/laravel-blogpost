<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['category', 'author'];
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function author() // by having function called user, laravel will try to find user_id inside the table
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
