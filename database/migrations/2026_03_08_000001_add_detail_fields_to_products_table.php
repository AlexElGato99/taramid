<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->default('')->after('title');
            $table->string('image')->nullable()->after('icon');
            $table->json('gallery')->nullable()->after('image');
            $table->text('how_to_use')->nullable()->after('description');
            $table->text('ingredients')->nullable()->after('how_to_use');
            $table->text('general_instructions')->nullable()->after('ingredients');
            $table->string('size')->nullable()->after('general_instructions');
            $table->decimal('price', 10, 2)->nullable()->after('size');
            $table->string('currency', 10)->default('MAD')->after('price');
            $table->string('badge')->nullable()->after('currency');
        });

        // Generate slugs for existing products
        foreach (\App\Models\Product::all() as $product) {
            $product->slug = \Illuminate\Support\Str::slug($product->title) ?: 'product-' . $product->id;
            // Ensure uniqueness
            $original = $product->slug;
            $counter = 1;
            while (\App\Models\Product::where('slug', $product->slug)->where('id', '!=', $product->id)->exists()) {
                $product->slug = $original . '-' . $counter++;
            }
            $product->saveQuietly();
        }

        Schema::table('products', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'slug', 'image', 'gallery', 'how_to_use', 'ingredients',
                'general_instructions', 'size', 'price', 'currency', 'badge',
            ]);
        });
    }
};
