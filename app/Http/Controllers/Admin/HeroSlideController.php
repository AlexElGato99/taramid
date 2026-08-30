<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesTranslatableModels;
use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;

class HeroSlideController extends Controller
{
    use ManagesTranslatableModels;

    public function index()
    {
        $config = [
            'title' => __('Hero Slides'),
            'nav' => 'hero-slides',
        ];

        $listings = HeroSlide::ordered()->paginate(config('attr.page_limit'));

        return view('admin.hero-slides.index', compact('config', 'listings'));
    }

    public function create()
    {
        $config = [
            'title' => __('Add Slide'),
            'nav' => 'hero-slides',
        ];

        return view('admin.hero-slides.form', compact('config'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading_line1' => 'required|string|max:255',
            'heading_line2' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only([
            'badge_text', 'heading_line1', 'heading_line2', 'description',
            'button1_text', 'button1_link', 'button2_text', 'button2_link',
            'stat1_value', 'stat1_label', 'stat2_value', 'stat2_label',
            'stat3_value', 'stat3_label', 'stat4_value', 'stat4_label',
            'sort_order',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/uploads/hero'), $filename);
            $data['image'] = 'uploads/hero/' . $filename;
        }

        HeroSlide::create($data);

        return redirect()->route('admin.hero-slides.index')->with('success', __(':title created', ['title' => __('Slide')]));
    }

    public function edit(HeroSlide $hero_slide)
    {
        $config = [
            'title' => __('Edit Slide'),
            'nav' => 'hero-slides',
        ];

        $listing = $hero_slide;

        return view('admin.hero-slides.form', compact('config', 'listing'));
    }

    public function update(Request $request, HeroSlide $hero_slide)
    {
        // Translating an existing record only writes that language's text;
        // images, links, ordering and status stay owned by the default language.
        if ($this->isTranslating($request)) {
            return $this->storeTranslation($request, $hero_slide, 'admin.hero-slides.edit');
        }

        $request->validate([
            'heading_line1' => 'required|string|max:255',
            'heading_line2' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only([
            'badge_text', 'heading_line1', 'heading_line2', 'description',
            'button1_text', 'button1_link', 'button2_text', 'button2_link',
            'stat1_value', 'stat1_label', 'stat2_value', 'stat2_label',
            'stat3_value', 'stat3_label', 'stat4_value', 'stat4_label',
            'sort_order',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if ($hero_slide->image && file_exists(public_path('storage/' . $hero_slide->image))) {
                @unlink(public_path('storage/' . $hero_slide->image));
            }
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/uploads/hero'), $filename);
            $data['image'] = 'uploads/hero/' . $filename;
        }

        $hero_slide->update($data);

        return redirect()->route('admin.hero-slides.edit', $hero_slide->id)->with('success', __(':title updated', ['title' => __('Slide')]));
    }

    public function destroy(HeroSlide $hero_slide)
    {
        if ($hero_slide->image && file_exists(public_path('storage/' . $hero_slide->image))) {
            @unlink(public_path('storage/' . $hero_slide->image));
        }

        $hero_slide->delete();

        return redirect()->back()->with('success', __('Deleted'));
    }
}
