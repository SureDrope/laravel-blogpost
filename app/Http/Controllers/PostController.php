<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    private $filters = ['search', 'category', 'author'];
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->filter(request($this->filters))->paginate(6)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
