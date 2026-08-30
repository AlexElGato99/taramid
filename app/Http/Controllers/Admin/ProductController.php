<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesTranslatableModels;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ManagesTranslatableModels;

    public function index()
    {
        $config = [
            'title' => __('Our Products'),
            'nav' => 'products',
            'route' => 'admin.products',
        ];

        $listings = Product::with('category')->ordered()->paginate(20);

        return view('admin.products.index', compact('config', 'listings'));
    }

    public function create()
    {
        $config = [
            'title' => __('Add Product'),
            'nav' => 'products',
        ];

        return view('admin.products.form', compact('config'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'how_to_use' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'general_instructions' => 'nullable|string',
            'badge' => 'nullable|string|max:100',
            'images.*' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'tag1' => 'nullable|string|max:100',
            'tag2' => 'nullable|string|max:100',
            'is_featured' => 'nullable',
            'action_buttons' => 'nullable|array',
            'action_buttons.*.icon' => 'nullable|string|max:50',
            'action_buttons.*.text' => 'nullable|string|max:255',
            'action_buttons.*.value' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        $gallery = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/uploads/products'), $filename);
                $gallery[] = 'uploads/products/' . $filename;
            }
        }
        $validated['gallery'] = $gallery;
        $validated['image'] = $gallery[0] ?? null;

        $validated['action_buttons'] = array_values(array_filter($request->input('action_buttons', []), fn($b) => !empty($b['text'])));

        $validated['is_featured'] = $request->input('is_featured') ? 1 : 0;
        $validated['is_active'] = $request->input('is_active') ? 1 : 0;

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', __('Product created.'));
    }

    public function edit(Product $product)
    {
        $config = [
            'title' => __('Edit Product'),
            'nav' => 'products',
        ];

        $listing = $product;

        return view('admin.products.form', compact('config', 'listing'));
    }

    public function update(Request $request, Product $product)
    {
        // Translating an existing record only writes that language's text;
        // images, links, ordering and status stay owned by the default language.
        if ($this->isTranslating($request)) {
            return $this->storeTranslation($request, $product, 'admin.products.edit');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'how_to_use' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'general_instructions' => 'nullable|string',
            'badge' => 'nullable|string|max:100',
            'images.*' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'primary_image' => 'nullable|string',
            'tag1' => 'nullable|string|max:100',
            'tag2' => 'nullable|string|max:100',
            'is_featured' => 'nullable',
            'action_buttons' => 'nullable|array',
            'action_buttons.*.icon' => 'nullable|string|max:50',
            'action_buttons.*.text' => 'nullable|string|max:255',
            'action_buttons.*.value' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        $validated['action_buttons'] = array_values(array_filter($request->input('action_buttons', []), fn($b) => !empty($b['text'])));

        $currentImages = [];
        if ($product->image && !in_array($product->image, $product->gallery ?? [])) {
            $currentImages[] = $product->image;
        }
        $currentImages = array_merge($currentImages, $product->gallery ?? []);

        $removeList = $request->input('remove_gallery', []);
        foreach ($removeList as $path) {
            if (in_array($path, $currentImages) && file_exists(public_path('storage/' . $path))) {
                @unlink(public_path('storage/' . $path));
            }
        }
        $currentImages = array_values(array_diff($currentImages, $removeList));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/uploads/products'), $filename);
                $currentImages[] = 'uploads/products/' . $filename;
            }
        }

        $primaryImage = $request->input('primary_image');
        if ($primaryImage && in_array($primaryImage, $currentImages)) {
            $validated['image'] = $primaryImage;
        } elseif (!empty($currentImages)) {
            $validated['image'] = $currentImages[0];
        } else {
            $validated['image'] = null;
        }
        $validated['gallery'] = $currentImages;

        $validated['is_featured'] = $request->input('is_featured') ? 1 : 0;
        $validated['is_active'] = $request->input('is_active') ? 1 : 0;

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', __('Product updated.'));
    }

    public function destroy(Product $product)
    {
        if ($product->gallery) {
            foreach ($product->gallery as $path) {
                if (file_exists(public_path('storage/' . $path))) {
                    @unlink(public_path('storage/' . $path));
                }
            }
        }
        if ($product->image && !in_array($product->image, $product->gallery ?? []) && file_exists(public_path('storage/' . $product->image))) {
            @unlink(public_path('storage/' . $product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', __('Product deleted.'));
    }
}
