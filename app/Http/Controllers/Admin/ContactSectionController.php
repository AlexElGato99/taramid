<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesSectionSettings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactSectionController extends Controller
{
    use ManagesSectionSettings;

    public function index()
    {
        $config = [
            'title' => __('Contact Section'),
            'nav' => 'contact-section',
        ];

        return view('admin.contact-section.index', compact('config'));
    }

    public function update(Request $request)
    {
        $this->saveSectionSettings($request, 'contact-section');

        return back()->with('success', __('Contact section updated successfully.'));
    }
}
