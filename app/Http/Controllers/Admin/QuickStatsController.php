<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesSectionSettings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuickStatsController extends Controller
{
    use ManagesSectionSettings;

    public function index()
    {
        $config = [
            'title' => __('Quick Statistics'),
            'nav' => 'quick-stats',
        ];

        return view('admin.quick-stats.index', compact('config'));
    }

    public function update(Request $request)
    {
        $this->saveSectionSettings($request, 'quick-stats');

        return back()->with('success', __('Statistics updated successfully.'));
    }
}
