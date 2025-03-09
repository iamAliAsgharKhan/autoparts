<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Year;

class YearSeeder extends Seeder
{
    public function run(): void
    {
        $years = range(2000, 2025); // Generate years from 2000 to 2025

        foreach ($years as $year) {
            Year::create(['year' => $year]);
        }
    }
}