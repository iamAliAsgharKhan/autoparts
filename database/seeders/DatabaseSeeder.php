<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            MakeSeeder::class,
            CarModelSeeder::class,
            YearSeeder::class,
            PartSeeder::class,
            SocialLinkSeeder::class,
            ProjectSeeder::class
        ]);
    }
}