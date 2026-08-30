<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesSectionSettings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CertSectionController extends Controller
{
    use ManagesSectionSettings;

    public function index()
    {
        $config = [
            'title' => __('Certificates Section'),
            'nav' => 'cert-section',
        ];

        return view('admin.cert-section.index', compact('config'));
    }

    public function update(Request $request)
    {
        $this->saveSectionSettings($request, 'cert-section');

        return back()->with('success', __('Certificates section updated successfully.'));
    }
}
