<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for($i = 1 ; $i<=15 ; $i++){

            Post::create([
                'user_id' => User::inRandomOrder()->first()->id,
                'title'   => $faker->sentence(5),
                'body'    => $faker->paragraph(),
            ]);
        }
    }
}
