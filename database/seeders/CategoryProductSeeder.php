<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    public function run(): void
    {
        $essentialOils = Category::firstOrCreate(
            ['slug' => 'essential-oils'],
            ['name' => 'Essential Oils', 'sort_order' => 1, 'is_active' => true]
        );

        $driedHerbs = Category::firstOrCreate(
            ['slug' => 'dried-herbs'],
            ['name' => 'Dried Herbs', 'sort_order' => 2, 'is_active' => true]
        );

        $naturalExtracts = Category::firstOrCreate(
            ['slug' => 'natural-extracts'],
            ['name' => 'Natural Extracts', 'sort_order' => 3, 'is_active' => true]
        );

        Product::firstOrCreate(
            ['slug' => 'lavender-essential-oil'],
            [
                'title' => 'Lavender Essential Oil',
                'category_id' => $essentialOils->id,
                'description' => 'Pure lavender essential oil distilled from organic lavender flowers grown in the Atlas Mountains. Known for its calming and soothing properties, this oil is perfect for aromatherapy and skincare.',
                'how_to_use' => 'Add 3-5 drops to a diffuser for aromatherapy, or mix with a carrier oil and apply to skin. Can also be added to bath water for a relaxing experience.',
                'ingredients' => '100% Pure Lavandula Angustifolia (Lavender) Essential Oil',
                'general_instructions' => 'Store in a cool, dark place away from direct sunlight. Keep out of reach of children. For external use only. Do a patch test before first use.',
                'size' => '30ml',
                'price' => 120.00,
                'currency' => 'MAD',
                'badge' => 'Best Seller',
                'tag1' => 'Aromatherapy',
                'tag2' => 'Organic',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        Product::firstOrCreate(
            ['slug' => 'dried-peppermint-leaves'],
            [
                'title' => 'Dried Peppermint Leaves',
                'category_id' => $driedHerbs->id,
                'description' => 'Hand-picked and naturally dried peppermint leaves from the Midelt region. Perfect for herbal teas, culinary use, and natural remedies.',
                'how_to_use' => 'Steep 1-2 teaspoons in boiling water for 5-7 minutes for a refreshing tea. Can also be crushed and added to salads, desserts, or used as a garnish.',
                'ingredients' => '100% Dried Mentha Piperita (Peppermint) Leaves',
                'general_instructions' => 'Store in an airtight container in a cool, dry place. Best consumed within 12 months of purchase for optimal flavor.',
                'size' => '100g',
                'price' => 45.00,
                'currency' => 'MAD',
                'badge' => 'New',
                'tag1' => 'Herbal Tea',
                'tag2' => 'Natural',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 2,
            ]
        );

        Product::firstOrCreate(
            ['slug' => 'argan-oil-cold-pressed'],
            [
                'title' => 'Argan Oil - Cold Pressed',
                'category_id' => $naturalExtracts->id,
                'description' => 'Premium cold-pressed argan oil sourced from Moroccan argan trees. Rich in vitamin E and fatty acids, this versatile oil is ideal for hair care, skincare, and cooking.',
                'how_to_use' => 'For skin: apply a few drops directly to face and neck. For hair: massage into scalp and ends, leave for 30 minutes, then wash. For cooking: use as finishing oil on salads and dishes.',
                'ingredients' => '100% Pure Argania Spinosa (Argan) Kernel Oil, Cold Pressed',
                'general_instructions' => 'Store in a cool, dark place. Shake well before use. For cosmetic and culinary use. Avoid contact with eyes.',
                'size' => '50ml',
                'price' => 180.00,
                'currency' => 'MAD',
                'tag1' => 'Skincare',
                'tag2' => 'Premium',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
            ]
        );

        // Assign existing products to categories if they don't have one
        Product::where('slug', 'like', '%essential-oil%')
            ->whereNull('category_id')
            ->update(['category_id' => $essentialOils->id]);

        Product::where('slug', 'like', '%dry-leaves%')
            ->whereNull('category_id')
            ->update(['category_id' => $driedHerbs->id]);
    }
}
