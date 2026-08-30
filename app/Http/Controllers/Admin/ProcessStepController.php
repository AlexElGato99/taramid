<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesTranslatableModels;
use App\Http\Controllers\Controller;
use App\Models\ProcessStep;
use Illuminate\Http\Request;

class ProcessStepController extends Controller
{
    use ManagesTranslatableModels;

    public function index()
    {
        $config = [
            'title' => __('Process Steps'),
            'nav' => 'process-steps',
            'route' => 'admin.process-steps',
        ];

        $listings = ProcessStep::ordered()->paginate(20);

        return view('admin.process-steps.index', compact('config', 'listings'));
    }

    public function create()
    {
        $config = [
            'title' => __('Add Process Step'),
            'nav' => 'process-steps',
        ];

        return view('admin.process-steps.form', compact('config'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|file|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/uploads/process'), $filename);
            $validated['icon'] = 'uploads/process/' . $filename;
        }

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        ProcessStep::create($validated);

        return redirect()->route('admin.process-steps.index')->with('success', __('Process step created.'));
    }

    public function edit(ProcessStep $process_step)
    {
        $config = [
            'title' => __('Edit Process Step'),
            'nav' => 'process-steps',
        ];

        $listing = $process_step;

        return view('admin.process-steps.form', compact('config', 'listing'));
    }

    public function update(Request $request, ProcessStep $process_step)
    {
        // Translating an existing record only writes that language's text;
        // images, links, ordering and status stay owned by the default language.
        if ($this->isTranslating($request)) {
            return $this->storeTranslation($request, $process_step, 'admin.process-steps.edit');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|file|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        if ($request->hasFile('icon')) {
            if ($process_step->icon && file_exists(public_path('storage/' . $process_step->icon))) {
                @unlink(public_path('storage/' . $process_step->icon));
            }
            $file = $request->file('icon');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/uploads/process'), $filename);
            $validated['icon'] = 'uploads/process/' . $filename;
        }

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        $process_step->update($validated);

        return redirect()->route('admin.process-steps.index')->with('success', __('Process step updated.'));
    }

    public function destroy(ProcessStep $process_step)
    {
        if ($process_step->icon && file_exists(public_path('storage/' . $process_step->icon))) {
            @unlink(public_path('storage/' . $process_step->icon));
        }

        $process_step->delete();

        return redirect()->route('admin.process-steps.index')->with('success', __('Process step deleted.'));
    }
}
