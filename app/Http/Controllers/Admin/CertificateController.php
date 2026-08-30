<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesTranslatableModels;
use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    use ManagesTranslatableModels;

    public function index()
    {
        $config = [
            'title' => __('Certificates'),
            'nav' => 'certificates',
            'route' => 'admin.certificates',
        ];

        $listings = Certificate::ordered()->paginate(20);

        return view('admin.certificates.index', compact('config', 'listings'));
    }

    public function create()
    {
        $config = [
            'title' => __('Add Certificate'),
            'nav' => 'certificates',
        ];

        return view('admin.certificates.form', compact('config'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|file|max:2048',
            'status_label' => 'nullable|string|max:100',
            'detail_line' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/uploads/certificates'), $filename);
            $validated['icon'] = 'uploads/certificates/' . $filename;
        }

        $validated['is_active'] = $request->input('is_active') ? 1 : 0;

        Certificate::create($validated);

        return redirect()->route('admin.certificates.index')->with('success', __('Certificate created.'));
    }

    public function edit(Certificate $certificate)
    {
        $config = [
            'title' => __('Edit Certificate'),
            'nav' => 'certificates',
        ];

        $listing = $certificate;

        return view('admin.certificates.form', compact('config', 'listing'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        // Translating an existing record only writes that language's text;
        // images, links, ordering and status stay owned by the default language.
        if ($this->isTranslating($request)) {
            return $this->storeTranslation($request, $certificate, 'admin.certificates.edit');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|file|max:2048',
            'status_label' => 'nullable|string|max:100',
            'detail_line' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        if ($request->hasFile('icon')) {
            if ($certificate->icon && file_exists(public_path('storage/' . $certificate->icon))) {
                @unlink(public_path('storage/' . $certificate->icon));
            }
            $file = $request->file('icon');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/uploads/certificates'), $filename);
            $validated['icon'] = 'uploads/certificates/' . $filename;
        }

        $validated['is_active'] = $request->input('is_active') ? 1 : 0;

        $certificate->update($validated);

        return redirect()->route('admin.certificates.index')->with('success', __('Certificate updated.'));
    }

    public function destroy(Certificate $certificate)
    {
        if ($certificate->icon && file_exists(public_path('storage/' . $certificate->icon))) {
            @unlink(public_path('storage/' . $certificate->icon));
        }

        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('success', __('Certificate deleted.'));
    }
}
