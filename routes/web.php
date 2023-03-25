<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Models\Post;


Route::get('/', fn() => view('posts', [
    'posts' => Post::all()
]));

Route::get('posts/{post:slug}', fn(Post $post) => view('post', [
    'post' => $post
]));

Route::get('categories/{category:slug}', fn(Category $category) => view('category',));
