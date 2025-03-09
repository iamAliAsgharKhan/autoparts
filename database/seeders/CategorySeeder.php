<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Tyres & Rims', 'description' => 'High-quality tyres and rims for all vehicles.', 'image' => 'images/categories/tyres-rims.png'],
            ['name' => 'Accessories', 'description' => 'Stylish and functional car accessories.', 'image' => 'images/categories/accessories.png'],
            ['name' => 'Oil & Lubricants', 'description' => 'Premium oils and lubricants for engine care.', 'image' => 'images/categories/oil-lubricants.png'],
            ['name' => 'Infotainment Systems', 'description' => 'Advanced infotainment systems for modern cars.', 'image' => 'images/categories/infotainment-systems.png'],
            ['name' => 'Brakes', 'description' => 'Reliable braking system components.', 'image' => 'images/categories/brakes.png'],
            ['name' => 'Electrical Parts', 'description' => 'Essential electrical components for vehicles.', 'image' => 'images/categories/electrical-parts.png'],
            ['name' => 'Engine & Parts', 'description' => 'Components related to the engine system.', 'image' => 'images/categories/engine-parts.png'],
            ['name' => 'Exterior', 'description' => 'External body parts and enhancements.', 'image' => 'images/categories/exterior.png'],
            ['name' => 'Interior', 'description' => 'Comfortable and stylish interior upgrades.', 'image' => 'images/categories/interior.png'],
            ['name' => 'Lights', 'description' => 'Bright and energy-efficient lighting solutions.', 'image' => 'images/categories/lights.png'],
            ['name' => 'Suspension', 'description' => 'Durable suspension system components.', 'image' => 'images/categories/suspension.png'],
            ['name' => 'Transmission & Drivetrain', 'description' => 'Smooth transmission and drivetrain components.', 'image' => 'images/categories/transmission-drivetrain.png'],
        ];

        foreach ($categories as $categoryData) {
            Category::create([
                'name' => $categoryData['name'],
                'slug' => \Illuminate\Support\Str::slug($categoryData['name']),
                'description' => $categoryData['description'],
                'image' => $categoryData['image'],
            ]);
        }
    }
}