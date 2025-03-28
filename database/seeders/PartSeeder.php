<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Make;
use App\Models\CarModel;
use App\Models\Year;
use App\Models\Part;

class PartSeeder extends Seeder
{
    public function run(): void
    {
        // Define a list of meaningful part names and descriptions
        $partData = [
            ['name' => 'Engine Oil Filter', 'description' => 'High-quality oil filter for efficient engine performance.'],
            ['name' => 'Brake Pads', 'description' => 'Durable brake pads for smooth braking.'],
            ['name' => 'Air Filter', 'description' => 'Replacement air filter for improved airflow.'],
            ['name' => 'Spark Plugs', 'description' => 'Set of 4 spark plugs for optimal ignition.'],
            ['name' => 'Radiator Hose', 'description' => 'Flexible radiator hose for coolant circulation.'],
            ['name' => 'Battery', 'description' => 'Long-lasting car battery for reliable starts.'],
            ['name' => 'Alternator', 'description' => 'Replacement alternator to keep your battery charged.'],
            ['name' => 'Shock Absorbers', 'description' => 'Heavy-duty shock absorbers for a smoother ride.'],
            ['name' => 'Headlight Bulb', 'description' => 'Bright LED headlight bulb for better visibility.'],
            ['name' => 'Windshield Wipers', 'description' => 'High-quality wipers for clear vision in rain.'],
            ['name' => 'Fuel Pump', 'description' => 'Efficient fuel pump for consistent fuel delivery.'],
            ['name' => 'Timing Belt', 'description' => 'Durable timing belt for engine synchronization.'],
            ['name' => 'Clutch Kit', 'description' => 'Complete clutch kit for manual transmission vehicles.'],
            ['name' => 'Exhaust Manifold', 'description' => 'Sturdy exhaust manifold for reduced emissions.'],
            ['name' => 'Cabin Air Filter', 'description' => 'Replacement cabin air filter for fresh air inside the car.'],
            ['name' => 'Steering Rack', 'description' => 'Precision steering rack for responsive handling.'],
            ['name' => 'Coolant Reservoir', 'description' => 'Replacement coolant reservoir tank.'],
            ['name' => 'Oxygen Sensor', 'description' => 'Accurate oxygen sensor for optimal fuel efficiency.'],
            ['name' => 'Drive Belt', 'description' => 'Multi-purpose drive belt for various engine components.'],
            ['name' => 'Starter Motor', 'description' => 'Powerful starter motor for quick engine starts.'],
            ['name' => 'Water Pump', 'description' => 'Efficient water pump for coolant circulation.'],
            ['name' => 'Fuel Injector', 'description' => 'Precision fuel injector for better fuel efficiency.'],
            ['name' => 'Power Steering Pump', 'description' => 'Reliable power steering pump for easy handling.'],
            ['name' => 'CV Axle', 'description' => 'Durable CV axle for front-wheel drive vehicles.'],
            ['name' => 'Tie Rod End', 'description' => 'High-quality tie rod end for precise steering.'],
            ['name' => 'Control Arm', 'description' => 'Sturdy control arm for stable suspension.'],
            ['name' => 'Ball Joint', 'description' => 'Durable ball joint for smooth suspension movement.'],
            ['name' => 'Wheel Bearing', 'description' => 'High-quality wheel bearing for smooth wheel rotation.'],
            ['name' => 'Radiator Fan', 'description' => 'Efficient radiator fan for engine cooling.'],
            ['name' => 'Thermostat', 'description' => 'Accurate thermostat for engine temperature regulation.'],
            ['name' => 'Mass Air Flow Sensor', 'description' => 'Precision mass air flow sensor for optimal engine performance.'],
            ['name' => 'Ignition Coil', 'description' => 'Reliable ignition coil for spark plugs.'],
            ['name' => 'Fuel Filter', 'description' => 'Efficient fuel filter for clean fuel delivery.'],
            ['name' => 'Serpentine Belt', 'description' => 'Multi-purpose serpentine belt for engine components.'],
            ['name' => 'Catalytic Converter', 'description' => 'Efficient catalytic converter for reduced emissions.'],
            ['name' => 'Muffler', 'description' => 'High-quality muffler for reduced exhaust noise.'],
            ['name' => 'Exhaust Pipe', 'description' => 'Durable exhaust pipe for exhaust system.'],
            ['name' => 'Strut Assembly', 'description' => 'Complete strut assembly for suspension.'],
            ['name' => 'Sway Bar Link', 'description' => 'Sturdy sway bar link for stable handling.'],
            ['name' => 'Engine Mount', 'description' => 'Durable engine mount for stable engine positioning.'],
            ['name' => 'Transmission Filter', 'description' => 'Efficient transmission filter for smooth shifting.'],
            ['name' => 'Differential Fluid', 'description' => 'High-quality differential fluid for smooth operation.'],
            ['name' => 'Power Window Motor', 'description' => 'Reliable power window motor for smooth window operation.'],
            ['name' => 'Door Handle', 'description' => 'Durable door handle for easy access.'],
            ['name' => 'Headlight Assembly', 'description' => 'Complete headlight assembly for better visibility.'],
            ['name' => 'Tail Light Assembly', 'description' => 'Complete tail light assembly for safety.'],
            ['name' => 'Side Mirror', 'description' => 'High-quality side mirror for better visibility.'],
            ['name' => 'Wiper Motor', 'description' => 'Powerful wiper motor for clear vision in rain.'],
            ['name' => 'Heater Core', 'description' => 'Efficient heater core for cabin heating.'],
            ['name' => 'Blower Motor', 'description' => 'Reliable blower motor for HVAC system.'],
            ['name' => 'AC Compressor', 'description' => 'Efficient AC compressor for air conditioning.'],
            ['name' => 'Radiator Cap', 'description' => 'High-quality radiator cap for coolant system.'],
            ['name' => 'Brake Rotor', 'description' => 'Durable brake rotor for smooth braking.'],
            ['name' => 'Brake Caliper', 'description' => 'Reliable brake caliper for precise braking.'],
            ['name' => 'Brake Master Cylinder', 'description' => 'Efficient brake master cylinder for braking system.'],
            ['name' => 'Clutch Master Cylinder', 'description' => 'Efficient clutch master cylinder for manual transmission.'],
            ['name' => 'Clutch Slave Cylinder', 'description' => 'Reliable clutch slave cylinder for manual transmission.'],
            ['name' => 'Wheel Hub', 'description' => 'Durable wheel hub for smooth wheel rotation.'],
            ['name' => 'Axle Shaft', 'description' => 'Sturdy axle shaft for power transmission.'],
            ['name' => 'Differential Cover', 'description' => 'High-quality differential cover for protection.'],
            ['name' => 'Engine Valve', 'description' => 'Durable engine valve for efficient engine operation.'],
            ['name' => 'Piston Ring', 'description' => 'High-quality piston ring for engine performance.'],
            ['name' => 'Connecting Rod', 'description' => 'Sturdy connecting rod for engine operation.'],
            ['name' => 'Crankshaft', 'description' => 'Durable crankshaft for engine power transmission.'],
            ['name' => 'Camshaft', 'description' => 'Precision camshaft for engine valve operation.'],
            ['name' => 'Rock Arm', 'description' => 'Sturdy rock arm for engine valve operation.'],
            ['name' => 'Valve Spring', 'description' => 'Durable valve spring for engine valve operation.'],
            ['name' => 'Lifter', 'description' => 'Reliable lifter for engine valve operation.'],
            ['name' => 'Pushrod', 'description' => 'Sturdy pushrod for engine valve operation.'],
            ['name' => 'Timing Chain', 'description' => 'Durable timing chain for engine synchronization.'],
            ['name' => 'Flywheel', 'description' => 'High-quality flywheel for engine operation.'],
            ['name' => 'Harmonic Balancer', 'description' => 'Efficient harmonic balancer for engine vibration reduction.'],
            ['name' => 'Engine Gasket', 'description' => 'High-quality engine gasket for sealing.'],
            ['name' => 'Head Gasket', 'description' => 'Durable head gasket for engine sealing.'],
            ['name' => 'Intake Manifold Gasket', 'description' => 'Efficient intake manifold gasket for sealing.'],
            ['name' => 'Exhaust Manifold Gasket', 'description' => 'Reliable exhaust manifold gasket for sealing.'],
            ['name' => 'Valve Cover Gasket', 'description' => 'High-quality valve cover gasket for sealing.'],
            ['name' => 'Oil Pan Gasket', 'description' => 'Durable oil pan gasket for sealing.'],
            ['name' => 'Water Pump Gasket', 'description' => 'Efficient water pump gasket for sealing.'],
            ['name' => 'Thermostat Gasket', 'description' => 'Reliable thermostat gasket for sealing.'],
            ['name' => 'Fuel Pump Gasket', 'description' => 'High-quality fuel pump gasket for sealing.'],
            ['name' => 'Transmission Pan Gasket', 'description' => 'Durable transmission pan gasket for sealing.'],
            ['name' => 'Differential Gasket', 'description' => 'Efficient differential gasket for sealing.'],
            ['name' => 'Power Steering Pump Gasket', 'description' => 'Reliable power steering pump gasket for sealing.'],
            ['name' => 'AC Compressor Gasket', 'description' => 'High-quality AC compressor gasket for sealing.'],
        ];
  
        $categories = Category::all();
        $makes = Make::all();
        $carModels = CarModel::all();
        $years = Year::all();

        foreach ($partData as $index => $data) {
            $category = $categories->random();
            $make = $makes->random();
            $carModel = $carModels->where('make_id', $make->id)->random();
            $year = $years->random();

            // Generate placeholder image URLs
            $mainImageUrl = "https://picsum.photos/seed/part{$index}/640/480";
            $image1Url = "https://picsum.photos/seed/image1{$index}/640/480";
            $image2Url = "https://picsum.photos/seed/image2{$index}/640/480";
            $image3Url = "https://picsum.photos/seed/image3{$index}/640/480";

            // Fetch the image contents
            $mainImageContents = file_get_contents($mainImageUrl);
            $image1Contents = file_get_contents($image1Url);
            $image2Contents = file_get_contents($image2Url);
            $image3Contents = file_get_contents($image3Url);

            // Define storage paths (you can customize the folder structure if needed)
            $mainImagePath = "parts/part{$index}.jpg";
            $image1Path = "parts/part{$index}_image1.jpg";
            $image2Path = "parts/part{$index}_image2.jpg";
            $image3Path = "parts/part{$index}_image3.jpg";

            // Save images to the 'public' disk
            Storage::disk('public')->put($mainImagePath, $mainImageContents);
            Storage::disk('public')->put($image1Path, $image1Contents);
            Storage::disk('public')->put($image2Path, $image2Contents);
            Storage::disk('public')->put($image3Path, $image3Contents);

            Part::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => rand(50, 5000) + (rand(0, 99) / 100), // Random price between 50 and 5000
                'note' => "Note for {$data['name']}.",
                'quality' => rand(0, 1) ? 'new' : 'used',
                'stock_level' => rand(0, 100),
                // Save the file paths (later you can use Storage::url($path) to display them)
                'main_image' => $mainImagePath,
                'image_1' => $image1Path,
                'image_2' => $image2Path,
                'image_3' => $image3Path,
                'make_id' => $make->id,
                'car_model_id' => $carModel->id,
                'year_id' => $year->id,
                'category_id' => $category->id,
            ]);
        }
    }
}
