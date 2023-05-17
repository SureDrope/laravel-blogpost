<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Validation\Rule;


class PostController extends Controller
{
	private $filters = ['search', 'category', 'author'];

	public function index()
	{
		return view('posts.index', [
			'posts' => Post::latest()->filter(request($this->filters))->paginate(6)->withQueryString(),
		]);
	}

	public function show(Post $post)
	{
		return view('posts.show', [
			'post' => $post,
		]);
	}

	public function create()
	{
		return view('posts.create');
	}

	public function store()
	{
		$attributes = request()->validate([
			'title' => 'required',
			'slug' => ['required', Rule::unique('posts', 'slug')],
			'excerpt' => 'required',
			'body' => 'required',
			'category_id' => ['required', Rule::exists('categories', 'id')],
			'thumbnail' => 'image'
		]);

		ddd($attributes);

		// $attributes['user_id'] = auth()->id();
		// Post::create($attributes);
		auth()->user()->posts()->create($attributes);

		return redirect('/');
	}
}
