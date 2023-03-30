<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['category', 'author'];

    public function scopeFilter($query, array $filters)
    {
//        if ($filters['search'] ?? false) {
//            $query
//                ->where('title', 'like', '%' . request('search') . '%')
//                ->orWhere('body', 'like', '%' . request('search') . '%');
//        }
        $query->when($filters['search'] ?? false, fn($query, $search) => $query
            ->where(fn($query) => $query
                ->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('body', 'like', '%' . request('search') . '%')));

//        $query->when($filters['category'] ?? false, fn($query, $category) => $query
//            ->whereExists(fn($query) => $query->from('categories')
//                ->whereColumn('categories.id', 'posts.category_id')
//                ->where('categories.slug', $category)
//            )
//        );
        $query->when($filters['category'] ?? false, fn($query, $category) => $query
            ->whereHas('category', fn($query) => $query->where('slug', $category))
        );

        $query->when($filters['author'] ?? false, fn($query, $author) => $query
            ->whereHas('author', fn($query) => $query->where('username', $author))
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // by having function called user, laravel will try to find user_id inside the table
    // or we can use foreignKey field to manually tell for which key to look
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
