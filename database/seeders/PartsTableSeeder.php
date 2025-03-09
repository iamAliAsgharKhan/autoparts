<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PartsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Define an array of makes, models, years, and categories
        $makes = ['Toyota', 'Honda', 'Ford', 'Chevrolet', 'BMW'];
        $models = ['Corolla', 'Civic', 'Mustang', 'Camaro', 'X5'];
        $years = [2020, 2021, 2022, 2023];
        $categories = ['Tyres', 'Accessories', 'Oils and Lubs', 'Infotainment Systems'];

        // Fetch random image URLs from Lorem Picsum API
        $imageUrls = [];
        for ($i = 0; $i < 10; $i++) {
            $response = Http::get('https://picsum.photos/200/300');
            if ($response->successful()) {
                $imageUrls[] = $response->effectiveUri();
            }
        }

        // Generate random parts data
        for ($i = 0; $i < 50; $i++) {
            $description = $this->generateDescription($i + 1);

            DB::table('parts')->insert([
                'name' => 'Part ' . ($i + 1),
                'description' => $description,
                'price' => rand(10, 1000),
                'note' => 'Note for part ' . ($i + 1),
                'quality' => rand(0, 1) ? 'new' : 'used',
                'stock_level' => rand(0, 100),
                'main_image' => $imageUrls[array_rand($imageUrls)],
                'image_1' => $imageUrls[array_rand($imageUrls)],
                'image_2' => $imageUrls[array_rand($imageUrls)],
                'image_3' => $imageUrls[array_rand($imageUrls)],
                'make' => $makes[array_rand($makes)],
                'model' => $models[array_rand($models)],
                'year' => $years[array_rand($years)],
                'category' => $categories[array_rand($categories)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function generateDescription(int $partNumber): string
    {
        $adjectives = ['high-quality', 'durable', 'reliable', 'affordable', 'premium', 'top-rated', 'efficient', 'versatile', 'innovative', 'robust'];
        $features = ['performance', 'design', 'material', 'compatibility', 'functionality', 'aesthetics', 'longevity', 'precision', 'craftsmanship', 'technology'];
        $benefits = ['enhances', 'improves', 'ensures', 'provides', 'delivers', 'offers', 'guarantees', 'supports', 'maximizes', 'optimizes'];

        $adjective = $adjectives[array_rand($adjectives)];
        $feature = $features[array_rand($features)];
        $benefit = $benefits[array_rand($benefits)];

        return "This $adjective part is designed to $benefit the $feature of your vehicle. Part $partNumber is meticulously crafted to meet the highest industry standards, ensuring long-lasting performance and reliability. Whether you're looking to upgrade or replace, this part offers exceptional value and quality.";
    }
}
