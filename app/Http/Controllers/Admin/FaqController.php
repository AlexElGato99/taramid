<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesTranslatableModels;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    use ManagesTranslatableModels;

    public function index()
    {
        $config = [
            'title' => __('FAQs'),
            'nav' => 'faqs',
            'route' => 'admin.faqs',
        ];
        $listings = Faq::ordered()->paginate(20);
        return view('admin.faqs.index', compact('config', 'listings'));
    }

    public function create()
    {
        $config = [
            'title' => __('Add FAQ'),
            'nav' => 'faqs',
        ];
        return view('admin.faqs.form', compact('config'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        $validated['is_active'] = $request->input('is_active') ? 1 : 0;
        Faq::create($validated);

        return redirect()->route('admin.faqs.index')->with('success', __('FAQ created.'));
    }

    public function edit(Faq $faq)
    {
        $config = [
            'title' => __('Edit FAQ'),
            'nav' => 'faqs',
        ];
        $listing = $faq;
        return view('admin.faqs.form', compact('config', 'listing'));
    }

    public function update(Request $request, Faq $faq)
    {
        // Translating an existing record only writes that language's text;
        // images, links, ordering and status stay owned by the default language.
        if ($this->isTranslating($request)) {
            return $this->storeTranslation($request, $faq, 'admin.faqs.edit');
        }

        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        $validated['is_active'] = $request->input('is_active') ? 1 : 0;
        $faq->update($validated);

        return redirect()->route('admin.faqs.index')->with('success', __('FAQ updated.'));
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', __('FAQ deleted.'));
    }
}
