<?php

use Illuminate\Database\Seeder;

class WischlistItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $usersCount = \App\User::all()->count();
        $limit = 10 * $usersCount;

        for ($i = 0; $i < $limit; $i++) {
            $wishlistItem = new \App\WishlistItem();
            $wishlistItem->fill(
                [
                    'user_id'     => $faker->numberBetween(1, $usersCount),
                    'title'       => $faker->title,
                    'price'       => $faker->numberBetween(0, 100000),
                    'product_url' => $faker->url,
                    'image_url'   => $faker->imageUrl()
                ]
            );
            $wishlistItem->save();
        }
    }
}
