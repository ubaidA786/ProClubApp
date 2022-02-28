<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
//use App\Models\Organization;
use App\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\Organization::factory(10)->create();
        //\App\Models\Media::factory(10)->create();
        //https://github.com/aalaap/faker-youtube
        // $faker = \Faker\Factory::create();
        // $faker->addProvider(new \Faker\Provider\Youtube($faker));
        $faker = \Faker\Factory::create();
        $links = [
            'https://www.youtube.com/watch?v=1gVvSfBxdEQ',
            'https://www.youtube.com/watch?v=ScT12CwuPEc',
            'https://www.youtube.com/watch?v=WOI7eihc5Gg',
            'https://www.youtube.com/watch?v=b7FNvq11CEw',
            'https://www.youtube.com/watch?v=o-k5Il-uwvY',
            'https://www.youtube.com/watch?v=HE9nLWFZ6ac',
            'https://www.youtube.com/watch?v=KVVOTXg-ROs',
            'https://www.youtube.com/watch?v=FfX_5NxJdnY',
        ];

        for ($i = 0; $i < 20; $i++) {
            DB::table('media')->insert([
                'title' => $faker->name,
                'url' => $links[$i % 8],
                'description' => $faker->text,
                'created_at' => now(),
                'updated_at' => now(),
                'status' => 1,
            ]);
        }

        $ids = Media::where('id', '>', 0)
            ->pluck('id')
            ->toArray();
        for ($i = 0; $i < 20; $i++) {
            DB::table('organizations')->insert([
                'name' => $faker->name,
                'address_1' => $faker->address,
                'address_2' => $faker->address,
                'city' => $faker->city,
                'state' => $faker->state,
                'zip' => $faker->postcode,
                'description' => $faker->text,
                'passcode' => $faker->postcode,
                'media_id' => $ids[$i],
            ]);
        }
    }
}
