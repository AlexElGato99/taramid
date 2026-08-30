<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesSectionSettings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProcessSectionController extends Controller
{
    use ManagesSectionSettings;

    public function index()
    {
        $config = [
            'title' => __('Process Section'),
            'nav' => 'process-section',
        ];

        return view('admin.process-section.index', compact('config'));
    }

    public function update(Request $request)
    {
        $this->saveSectionSettings($request, 'process-section');

        return back()->with('success', __('Process section updated successfully.'));
    }
}
