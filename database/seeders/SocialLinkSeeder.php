<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialLink;

class SocialLinkSeeder extends Seeder
{
    public function run(): void
    {
        SocialLink::create([
            'platform_name' => 'Facebook',
            'url' => 'https://facebook.com/autostore',
            'icon' => 'fab fa-facebook',
        ]);

        SocialLink::create([
            'platform_name' => 'Instagram',
            'url' => 'https://instagram.com/autostore',
            'icon' => 'fab fa-instagram',
        ]);

        SocialLink::create([
            'platform_name' => 'YouTube',
            'url' => 'https://youtube.com/autostore',
            'icon' => 'fab fa-youtube',
        ]);
    }
}
