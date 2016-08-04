<?php

use CodeDelivery\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'User ',
            'email' => 'user@user.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10)
        ]);

        factory(User::class)->create([
            'name' => 'Admin ',
            'email' => 'admin@user.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
            'role' => 'admin'
        ]);

        factory(User::class, 10)->create()->each(function ($u){
            $u->client()->save(factory(\CodeDelivery\Models\Client::class)->make());
        });
    }
}
