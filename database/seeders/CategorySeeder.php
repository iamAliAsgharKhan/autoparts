<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\Storage; // Import Storage facade
use Illuminate\Support\Str; // Import Str facade

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // --- Important Step: Ensure the target directory exists ---
        // This creates storage/app/public/categories if it doesn't exist
        Storage::disk('public')->makeDirectory('categories');
        // ---------------------------------------------------------

        $categories = [
            // Note: These paths are now relative to storage/app/public/
            ['name' => 'Tyres & Rims', 'description' => 'High-quality tyres and rims for all vehicles.', 'source_image' => 'images/categories/tyres-rims.png', 'target_image' => 'categories/tyres-rims.png'],
            ['name' => 'Accessories', 'description' => 'Stylish and functional car accessories.', 'source_image' => 'images/categories/accessories.png', 'target_image' => 'categories/accessories.png'],
            ['name' => 'Oil & Lubricants', 'description' => 'Premium oils and lubricants for engine care.', 'source_image' => 'images/categories/oil-lubricants.png', 'target_image' => 'categories/oil-lubricants.png'],
            ['name' => 'Infotainment Systems', 'description' => 'Advanced infotainment systems for modern cars.', 'source_image' => 'images/categories/infotainment-systems.png', 'target_image' => 'categories/infotainment-systems.png'],
            ['name' => 'Brakes', 'description' => 'Reliable braking system components.', 'source_image' => 'images/categories/brakes.png', 'target_image' => 'categories/brakes.png'],
            ['name' => 'Electrical Parts', 'description' => 'Essential electrical components for vehicles.', 'source_image' => 'images/categories/electrical-parts.png', 'target_image' => 'categories/electrical-parts.png'],
            ['name' => 'Engine & Parts', 'description' => 'Components related to the engine system.', 'source_image' => 'images/categories/engine-parts.png', 'target_image' => 'categories/engine-parts.png'],
            ['name' => 'Exterior', 'description' => 'External body parts and enhancements.', 'source_image' => 'images/categories/exterior.png', 'target_image' => 'categories/exterior.png'],
            ['name' => 'Interior', 'description' => 'Comfortable and stylish interior upgrades.', 'source_image' => 'images/categories/interior.png', 'target_image' => 'categories/interior.png'],
            ['name' => 'Lights', 'description' => 'Bright and energy-efficient lighting solutions.', 'source_image' => 'images/categories/lights.png', 'target_image' => 'categories/lights.png'],
            ['name' => 'Suspension', 'description' => 'Durable suspension system components.', 'source_image' => 'images/categories/suspension.png', 'target_image' => 'categories/suspension.png'],
            ['name' => 'Transmission & Drivetrain', 'description' => 'Smooth transmission and drivetrain components.', 'source_image' => 'images/categories/transmission-drivetrain.png', 'target_image' => 'categories/transmission-drivetrain.png'],
        ];

        foreach ($categories as $categoryData) {
            // --- Step 2: Copy the image file (Optional but Recommended) ---
            $sourcePath = public_path($categoryData['source_image']); // Path in public folder
            $targetPath = $categoryData['target_image']; // Relative path for storage

            // Check if the source file exists before attempting to copy
            if (file_exists($sourcePath)) {
                // Check if the file doesn't already exist in storage to avoid overwriting
                 if (!Storage::disk('public')->exists($targetPath)) {
                    // Read the file content from the public path
                    $contents = file_get_contents($sourcePath);
                    // Store the file content in the public disk under the target path
                    Storage::disk('public')->put($targetPath, $contents);
                    $this->command->info("Copied image: {$categoryData['source_image']} to storage/app/public/{$targetPath}");
                 } else {
                     $this->command->info("Image already exists, skipping copy: storage/app/public/{$targetPath}");
                 }
            } else {
                $this->command->warn("Source image not found, skipping copy: {$sourcePath}");
                // Decide if you want to proceed without an image or skip the category
                 $targetPath = null; // Set target path to null if source doesn't exist
            }
            // -------------------------------------------------------------

            // --- Step 3: Create the Category record ---
            // Use the target_image path (relative to storage/app/public)
            Category::create([
                'name' => $categoryData['name'],
                'slug' => Str::slug($categoryData['name']), // Use Illuminate\Support\Str
                'description' => $categoryData['description'],
                'image' => $targetPath, // Store the correct relative path or null
            ]);
            // ------------------------------------------
        }

         $this->command->info('Category seeder finished.');
    }
}