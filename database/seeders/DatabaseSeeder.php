<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Course;
use App\Models\Level;
use App\Models\Platform;
use App\Models\Review;
use App\Models\Series;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        User::create([
            'name' => 'Admin',
            'email' => 'hi@rauf.me',
            'password' => bcrypt('password'),
            'type' => 1,
        ]);

        $series = [
            [
                'name' => 'PHP',
                'slug' => 'php',
                'image' => 'https://cdn.pixabay.com/photo/2017/08/05/11/16/logo-2582748_640.png'
            ],
            [
                'name' => 'JavaScript',
                'slug' => 'javascript',
                'image' => 'https://cdn.pixabay.com/photo/2017/08/05/11/16/logo-2582748_640.png'
            ],
            [
                'name' => 'Wordpress',
                'slug' => 'wordpress',
                'image' => 'https://cdn.pixabay.com/photo/2017/08/05/11/16/logo-2582748_640.png'
            ],
            [
                'name' => 'Vue.js',
                'slug' => 'vue.js',
                'image' => 'https://cdn.pixabay.com/photo/2017/08/05/11/16/logo-2582748_640.png'
            ],
        ];


        foreach ($series as $item) {
            Series::create([
                'name' => $item['name'],
                'image' => $item['image'],
                'slug' => $item['slug'],



            ]);
        }

        $topic = ['Eloquent', 'Validation', 'Authenticaton', 'Testing'];
        foreach ($topic as $item) {
            $slug = strtolower(str_replace(' ', '-', $item));

            Topic::create([
                'name' => $item,
                'slug' => $slug

            ]);
        }

        $platforms = ['Laracasts', 'Laravel Daily', 'Codecourse'];
        foreach ($platforms as $item) {
            $slug = strtolower(str_replace(' ', '-', $item));
            Platform::create([
                'name' => $item,
                'slug' => $slug,
            ]);
        }

        $levels = ['Beginner', 'Intermediate', 'Advanced'];
        foreach ($levels as $item) {
            $slug = strtolower(str_replace(' ', '-', $item));
            Level::create([
                'name' => $item,
                'slug' => $slug,
            ]);
        }

        Author::factory(10)->create();

        // create 50 users
        User::factory(50)->create();
        //create 100 courses
        Course::factory(100)->create();

        $courses = Course::all();
        foreach ($courses as $course) {
            $topics = Topic::all()->random(rand(1, 4))->pluck('id')->toArray();
            $course->topics()->attach($topics);

            $authors = Author::all()->random(rand(1, 3))->pluck('id')->toArray();
            $course->authors()->attach($authors);

            $series = Series::all()->random(rand(1, 4))->pluck('id')->toArray();
            $course->series()->attach($series);
        }
        Review::factory(100)->create();
    }
}
