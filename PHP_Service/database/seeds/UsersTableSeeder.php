<?php

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
        $faker = Faker\Factory::create();

        $limit = 5;

        for ($i = 0; $i < $limit; $i++) {
            $user = new \App\User();
            $user->fill(
                [
                    'uuid'     => $faker->uuid,
                    'name'     => $faker->name,
                    'email'    => $faker->unique()->email,
                    'password' => 'Test123$'
                ]
            );
            $user->save();
        }
    }
}
