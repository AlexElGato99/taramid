<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::active()->withTranslations()->ordered()->withCount(['products' => function ($q) {
            $q->where('is_active', true);
        }])->get();

        $query = Product::active()->withTranslations()->ordered();

        if ($request->filled('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        $products = $query->paginate(12)->withQueryString();
        $activeCategory = $request->category;
        $totalProducts = Product::active()->count();

        return view('products.index', compact('products', 'categories', 'activeCategory', 'totalProducts'));
    }

    public function show(Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }

        $relatedProducts = Product::active()
            ->withTranslations()
            ->where('id', '!=', $product->id)
            ->when($product->category_id, function ($q) use ($product) {
                $q->where('category_id', $product->category_id);
            })
            ->ordered()
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
