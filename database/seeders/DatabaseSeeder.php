<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::truncate();
        Category::truncate();
        Post::truncate();

        $user  = User::factory()->create();

        $personal = Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
         ]);
        $family = Category::create([
            'name' => 'Family',
            'slug' => 'family'
        ]);
        $work = Category::create([
            'name' => 'Work',
            'slug' => 'work'
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $family->id,
            'title' => '1',
            'slug' => '1',
            'excerpt' => 'etetetet',
            'body' => 'lorem ipsum hui sosisum'
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $personal->id,
            'title' => '2',
            'slug' => '2',
            'excerpt' => 'etetetet',
            'body' => 'lorem ipsum hui sosisum'
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' => $work->id,
            'title' => '3',
            'slug' => '3',
            'excerpt' => 'etetetet',
            'body' => 'lorem ipsum hui sosisum'
        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
