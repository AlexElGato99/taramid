<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesTranslatableModels;
use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    use ManagesTranslatableModels;

    public function index()
    {
        $config = [
            'title' => __('Gallery'),
            'nav' => 'gallery',
            'route' => 'admin.gallery',
        ];
        $images = GalleryImage::withTranslations(admin_locale())->ordered()->paginate(30);
        return view('admin.gallery.index', compact('config', 'images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array|min:1',
            'images.*' => 'image|max:5120',
        ]);

        $maxOrder = GalleryImage::max('sort_order') ?? 0;

        foreach ($request->file('images') as $file) {
            $maxOrder++;
            $filename = time() . '_' . $maxOrder . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/uploads/gallery'), $filename);

            GalleryImage::create([
                'image' => 'uploads/gallery/' . $filename,
                'sort_order' => $maxOrder,
                'is_active' => true,
            ]);
        }

        return redirect()->route('admin.gallery.index')->with('success', __('Images uploaded.'));
    }

    public function update(Request $request, GalleryImage $galleryImage)
    {
        // Captions are per-language; the image itself and its ordering are not.
        if ($this->isTranslating($request)) {
            $locale = $this->editingLocale($request);
            $request->validate(['caption' => 'nullable|string|max:255']);
            $galleryImage->saveTranslations($request->only(['caption']), $locale);
            cache()->flush();

            return redirect()
                ->route('admin.gallery.index', ['lang' => $locale])
                ->with('success', __('Translation saved.'));
        }

        $validated = $request->validate([
            'caption' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        $validated['is_active'] = $request->input('is_active') ? 1 : 0;
        $galleryImage->update($validated);

        return redirect()->route('admin.gallery.index')->with('success', __('Image updated.'));
    }

    public function destroy(GalleryImage $galleryImage)
    {
        if ($galleryImage->image && file_exists(public_path('storage/' . $galleryImage->image))) {
            @unlink(public_path('storage/' . $galleryImage->image));
        }
        $galleryImage->delete();
        return redirect()->route('admin.gallery.index')->with('success', __('Image deleted.'));
    }
}
