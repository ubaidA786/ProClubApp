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
        DB::table('users')->insert([
            'name' => 'Brad Sapp',
            'email' => 'brad@test.com',
            'password' => \Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $faker = \Faker\Factory::create();
        $links = [
            'https://www.youtube.com/embed/1gVvSfBxdEQ',
            'https://www.youtube.com/embed/ScT12CwuPEc',
            'https://www.youtube.com/embed/WOI7eihc5Gg',
            'https://www.youtube.com/embed/b7FNvq11CEw',
            'https://www.youtube.com/embed/o-k5Il-uwvY',
            'https://www.youtube.com/embed/HE9nLWFZ6ac',
            'https://www.youtube.com/embed/KVVOTXg-ROs',
            'https://www.youtube.com/embed/FfX_5NxJdnY',
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
                'passcode' => $i . '-' . $faker->postcode,
                'ip_addresses' => '127.0.0.1',
                'media_id' => $ids[$i],
            ]);
        }
    }
}
