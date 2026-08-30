<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesTranslatableModels;
use App\Http\Controllers\Controller;
use App\Models\SliderItem;
use Illuminate\Http\Request;

class SliderItemController extends Controller
{
    use ManagesTranslatableModels;

    public function index()
    {
        $config = [
            'title' => __('Slider'),
            'nav' => 'slider-items',
            'route' => 'admin.slider-items',
        ];

        $listings = SliderItem::ordered()->paginate(20);

        return view('admin.slider-items.index', compact('config', 'listings'));
    }

    public function create()
    {
        $config = [
            'title' => __('Add Slider Item'),
            'nav' => 'slider-items',
        ];

        return view('admin.slider-items.form', compact('config'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/uploads/slider'), $filename);
            $validated['logo'] = 'uploads/slider/' . $filename;
        }

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        SliderItem::create($validated);

        return redirect()->route('admin.slider-items.index')->with('success', __('Slider item created.'));
    }

    public function edit(SliderItem $slider_item)
    {
        $config = [
            'title' => __('Edit Slider Item'),
            'nav' => 'slider-items',
        ];

        $listing = $slider_item;

        return view('admin.slider-items.form', compact('config', 'listing'));
    }

    public function update(Request $request, SliderItem $slider_item)
    {
        // Translating an existing record only writes that language's text;
        // images, links, ordering and status stay owned by the default language.
        if ($this->isTranslating($request)) {
            return $this->storeTranslation($request, $slider_item, 'admin.slider-items.edit');
        }

        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        if ($request->hasFile('logo')) {
            if ($slider_item->logo && file_exists(public_path('storage/' . $slider_item->logo))) {
                @unlink(public_path('storage/' . $slider_item->logo));
            }
            $file = $request->file('logo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/uploads/slider'), $filename);
            $validated['logo'] = 'uploads/slider/' . $filename;
        }

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $slider_item->update($validated);

        return redirect()->route('admin.slider-items.index')->with('success', __('Slider item updated.'));
    }

    public function destroy(SliderItem $slider_item)
    {
        if ($slider_item->logo && file_exists(public_path('storage/' . $slider_item->logo))) {
            @unlink(public_path('storage/' . $slider_item->logo));
        }

        $slider_item->delete();

        return redirect()->route('admin.slider-items.index')->with('success', __('Slider item deleted.'));
    }
}
