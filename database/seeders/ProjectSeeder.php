<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project; // Import Project model
use App\Models\ProjectImage; // Import ProjectImage model
use Illuminate\Support\Facades\Http; // For fetching images
use Illuminate\Support\Facades\Storage; // For saving images
use Illuminate\Support\Str; // For generating slugs or random strings
use Faker\Factory as Faker; // For generating fake data

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Faker::create();
        $numberOfProjects = 10; // How many projects to create
        $imagesPerType = 3; // How many 'before' and 'after' images per project

        // --- Ensure Storage Directories Exist ---
        Storage::disk('public')->makeDirectory('projects/before');
        Storage::disk('public')->makeDirectory('projects/after');
        $this->command->info('Checked/Created storage directories.');
        // ---------------------------------------

        $this->command->info("Seeding {$numberOfProjects} projects with {$imagesPerType} before/after images each...");

        for ($i = 1; $i <= $numberOfProjects; $i++) {
            $this->command->info("Creating Project {$i}...");

            // 1. Create the Project record
            $project = Project::create([
                'headline' => $faker->sentence(6),
                'description' => $faker->paragraphs(3, true), // Generate 3 paragraphs of text
            ]);

            // 2. Add 'Before' Images
            $this->command->info("-- Adding 'before' images for Project {$project->id}...");
            for ($j = 1; $j <= $imagesPerType; $j++) {
                $imagePath = $this->fetchAndStoreImage('before', $faker);
                if ($imagePath) {
                    $project->images()->create([
                        'image_path' => $imagePath,
                        'type' => 'before',
                        'order' => $j,
                    ]);
                     $this->command->comment("--- Added before image: {$imagePath}");
                } else {
                     $this->command->warn("--- Failed to fetch/store before image #{$j}");
                }
            }

            // 3. Add 'After' Images
            $this->command->info("-- Adding 'after' images for Project {$project->id}...");
             for ($j = 1; $j <= $imagesPerType; $j++) {
                $imagePath = $this->fetchAndStoreImage('after', $faker);
                 if ($imagePath) {
                    $project->images()->create([
                        'image_path' => $imagePath,
                        'type' => 'after',
                        'order' => $j,
                    ]);
                     $this->command->comment("--- Added after image: {$imagePath}");
                } else {
                    $this->command->warn("--- Failed to fetch/store after image #{$j}");
                }
            }
             $this->command->info("Project {$i} created.");
        }

         $this->command->info('Project seeding completed!');
    }

    /**
     * Fetches a placeholder image, stores it, and returns the relative path.
     *
     * @param string $type ('before' or 'after')
     * @param \Faker\Generator $faker
     * @return string|null The relative storage path or null on failure.
     */
    private function fetchAndStoreImage(string $type, \Faker\Generator $faker): ?string
    {
        try {
            // Use Picsum Photos for placeholders (adjust size as needed)
            $response = Http::timeout(15)->get('https://picsum.photos/800/600');

            if ($response->successful() && $response->body()) {
                // Generate a unique filename
                $filename = Str::random(20) . '.jpg'; // Assume JPG from Picsum
                $directory = "projects/{$type}"; // e.g., projects/before
                $relativePath = "{$directory}/{$filename}";

                // Store the image content
                $stored = Storage::disk('public')->put($relativePath, $response->body());

                if($stored) {
                    return $relativePath; // Return the path relative to storage/app/public
                } else {
                    $this->command->error("--- Failed to write image to storage: {$relativePath}");
                    return null;
                }
            } else {
                 $this->command->warn("--- Failed to fetch image. Status: " . $response->status());
                 return null; // Indicate failure
            }
        } catch (\Exception $e) {
            $this->command->error("--- Exception fetching/storing image: " . $e->getMessage());
            return null; // Indicate failure
        }
    }
}