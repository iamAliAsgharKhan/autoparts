<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Make;
use App\Models\CarModel;

class CarModelSeeder extends Seeder
{
    public function run(): void
    {
        $models = [
            ['make_id' => 1, 'name' => 'Corolla'], // Toyota
            ['make_id' => 1, 'name' => 'Camry'],  // Toyota
            ['make_id' => 2, 'name' => 'Civic'],  // Honda
            ['make_id' => 2, 'name' => 'Accord'], // Honda
            ['make_id' => 3, 'name' => 'Mustang'],// Ford
            ['make_id' => 4, 'name' => 'X5'],     // BMW
            ['make_id' => 5, 'name' => 'S-Class'],// Mercedes-Benz
        ];

        foreach ($models as $model) {
            CarModel::create($model);
        }
    }
}