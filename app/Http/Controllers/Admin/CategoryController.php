<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesTranslatableModels;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ManagesTranslatableModels;

    public function index()
    {
        $config = [
            'title' => __('Categories'),
            'nav' => 'categories',
            'route' => 'admin.categories',
        ];

        $listings = Category::withCount('products')->ordered()->paginate(20);

        return view('admin.categories.index', compact('config', 'listings'));
    }

    public function create()
    {
        $config = [
            'title' => __('Add Category'),
            'nav' => 'categories',
        ];

        return view('admin.categories.form', compact('config'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        $validated['is_active'] = $request->input('is_active') ? 1 : 0;

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', __('Category created.'));
    }

    public function edit(Category $category)
    {
        $config = [
            'title' => __('Edit Category'),
            'nav' => 'categories',
        ];

        $listing = $category;

        return view('admin.categories.form', compact('config', 'listing'));
    }

    public function update(Request $request, Category $category)
    {
        // Translating an existing record only writes that language's text;
        // images, links, ordering and status stay owned by the default language.
        if ($this->isTranslating($request)) {
            return $this->storeTranslation($request, $category, 'admin.categories.edit');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        $validated['is_active'] = $request->input('is_active') ? 1 : 0;

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', __('Category updated.'));
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', __('Category deleted.'));
    }
}
