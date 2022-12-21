<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=> 'Medjadji',
            'email'=> 'medjadji@gmail.com',
            'password' => bcrypt('12345')
        ]);

        User::create([
            'name'=> 'Meziane',
            'email'=> 'meziane@gmail.com',
            'password' => bcrypt('12345')
        ]);
    }
}
