<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public function __construct(public $title, public $excerpt, public $date, public $body, public $slug)
    {
    }

    public static function all()
    {
//        return cache()->rememberForever('posts.all', function(){
            $files = File::files(resource_path("posts"));
            $posts = collect($files)
                ->map(function ($file) {
                    $document = YamlFrontMatter::parseFile($file);

                    return new Post(
                        title: $document->title,
                        excerpt: $document->excerpt,
                        date: $document->date,
                        body: $document->body(),
                        slug: $document->slug
                    );
                })->sortByDesc('date');

            return $posts;
//        });
//       $files = File::files(resource_path("posts/"));
//
//       return array_map(fn($file) => $file->getContents(), $files);
    }
    public static function find($slug) {
//        $path = __DIR__ . "/../resources/posts/{$slug}.html";

//        $path = resource_path("/posts/{$slug}.html");
//        if (!file_exists($path)) {
//           throw new ModelNotFoundException();
//        }
//        return cache()->remember("posts.{$slug}", now()->addMinutes(1), fn() => file_get_contents($path));

        $post = static::all()->firstWhere('slug', $slug);

        if (!$post) {
            throw new ModelNotFoundException();
        }
        return $post;
    }
}
