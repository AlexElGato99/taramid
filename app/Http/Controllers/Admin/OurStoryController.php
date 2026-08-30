<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesSectionSettings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OurStoryController extends Controller
{
    use ManagesSectionSettings;

    public function index()
    {
        $config = [
            'title' => __('Our Story'),
            'nav' => 'our-story',
        ];

        return view('admin.our-story.index', compact('config'));
    }

    public function update(Request $request)
    {
        $locale = $this->saveSectionSettings($request, 'our-story');

        // Images are shared by every language, so they are only writable from
        // the default-language form.
        if ($locale === base_locale()) {
            if ($request->hasFile('story_image')) {
                $file = $request->file('story_image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/uploads/story'), $filename);
                update_settings('story_image', 'uploads/story/' . $filename);
            }

            foreach ([1, 2, 3] as $i) {
                if ($request->hasFile('story_feature' . $i . '_icon')) {
                    $file = $request->file('story_feature' . $i . '_icon');
                    $filename = time() . '_feature' . $i . '_' . $file->getClientOriginalName();
                    $file->move(public_path('storage/uploads/story'), $filename);
                    update_settings('story_feature' . $i . '_icon', 'uploads/story/' . $filename);
                }
            }

            cache()->flush();
        }

        return back()->with('success', __('Our Story section updated successfully.'));
    }
}
