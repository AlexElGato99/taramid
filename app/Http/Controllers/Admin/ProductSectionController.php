<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesSectionSettings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductSectionController extends Controller
{
    use ManagesSectionSettings;

    public function index()
    {
        $config = [
            'title' => __('Products Section'),
            'nav' => 'products-section',
        ];

        return view('admin.products-section.index', compact('config'));
    }

    public function update(Request $request)
    {
        $this->saveSectionSettings($request, 'products-section');

        return back()->with('success', __('Products section updated successfully.'));
    }
}
