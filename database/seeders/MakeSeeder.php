<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Make;

class MakeSeeder extends Seeder
{
    public function run(): void
    {
        $makes = [
            ['name' => 'Toyota'],
            ['name' => 'Honda'],
            ['name' => 'Ford'],
            ['name' => 'BMW'],
            ['name' => 'Mercedes-Benz'],
        ];

        foreach ($makes as $make) {
            Make::create($make);
        }
    }
}