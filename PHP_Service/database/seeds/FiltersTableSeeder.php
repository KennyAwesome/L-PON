<?php

use Illuminate\Database\Seeder;

class FiltersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $userIds = \App\User::where('id', '>', 0)->pluck('id')->toArray();
        $limit = count($userIds);

        for ($i = 0; $i < $limit; $i++) {
            $filter = new \App\Filter();
            $filter->fill(
                [
                    'user_id'      => $userIds[$i],
                    'sl_gender'    => $faker->numberBetween(0,3),
                    'sl_min_price' => $faker->numberBetween(0,1000),
                    'sl_max_price' => $faker->numberBetween(1000,100000),
                    'sl_color'     => $faker->numberBetween(0,500),
                    'sl_occasion'  => $faker->numberBetween(0,500),
                    'sl_style'     => $faker->numberBetween(0,500),
                    'wg_age'       => $faker->numberBetween(14,100),
                    'wg_min_price' => $faker->numberBetween(0,1000),
                    'wg_max_price' => $faker->numberBetween(1000,100000),
                    'wg_date_from' => $faker->date(),
                    'wg_date_to'   => $faker->date(),
                    'wg_city_id'   => $faker->numberBetween(0,1000)
                ]
            );
            $filter->save();
        }
    }
}
