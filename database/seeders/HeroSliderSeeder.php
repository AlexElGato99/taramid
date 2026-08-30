<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSlider;

class HeroSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HeroSlider::create([
            'heading' => "Fast & Reliable IPTV Service at an\nAffordable Price",
            'description' => 'Experience unlimited entertainment with premium quality streaming. Access thousands of channels, movies, and live events from anywhere in the world. Build Channels, VOD and more with our platform.',
            'button_1_text' => 'BUY SUBSCRIPTION',
            'button_1_link' => '#pricing',
            'button_2_text' => 'Learn More',
            'button_2_link' => '#features',
            'icons' => [
                ['icon' => '📺', 'text' => 'TV'],
                ['icon' => '💻', 'text' => 'PC'],
                ['icon' => '📱', 'text' => 'Mobile'],
                ['icon' => '🎮', 'text' => 'Console'],
            ],
            'order' => 1,
            'status' => true,
        ]);

        HeroSlider::create([
            'heading' => "Stream Your Favorite Content\nAnywhere, Anytime",
            'description' => 'Watch thousands of live channels, movies, and series on any device. Crystal clear HD quality with anti-freeze technology for buffer-free streaming.',
            'button_1_text' => 'Get Started Now',
            'button_1_link' => '#pricing',
            'icons' => [
                ['icon' => '📡', 'text' => 'Live TV'],
                ['icon' => '🎬', 'text' => 'Movies'],
                ['icon' => '⚽', 'text' => 'Sports'],
                ['icon' => '🎭', 'text' => 'Series'],
            ],
            'order' => 2,
            'status' => true,
        ]);

        HeroSlider::create([
            'heading' => "Premium Features\nAffordable Pricing",
            'description' => '28K+ Live Channels • 140K+ Movies & Series • 2.1K Live Events • FHD & 4K Quality • 24/7 Premium Support',
            'button_1_text' => 'View Plans',
            'button_1_link' => '#pricing',
            'button_2_text' => 'Contact Support',
            'button_2_link' => 'https://wa.me/',
            'icons' => [
                ['icon' => '✅', 'text' => 'HD Quality'],
                ['icon' => '🌍', 'text' => 'Global'],
                ['icon' => '💬', 'text' => '24/7 Support'],
                ['icon' => '🔒', 'text' => 'Secure'],
            ],
            'order' => 3,
            'status' => true,
        ]);
    }
}
