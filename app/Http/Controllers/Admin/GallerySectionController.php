<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesSectionSettings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GallerySectionController extends Controller
{
    use ManagesSectionSettings;

    public function index()
    {
        $config = [
            'title' => __('Gallery Section'),
            'nav' => 'gallery-section',
        ];

        return view('admin.gallery-section.index', compact('config'));
    }

    public function update(Request $request)
    {
        $this->saveSectionSettings($request, 'gallery-section');

        return back()->with('success', __('Gallery section updated successfully.'));
    }
}
