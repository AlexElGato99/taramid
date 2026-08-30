<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ManagesSectionSettings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FooterSectionController extends Controller
{
    use ManagesSectionSettings;

    public function index()
    {
        $config = [
            'title' => __('Footer Section'),
            'nav' => 'footer-section',
        ];

        return view('admin.footer-section.index', compact('config'));
    }

    public function update(Request $request)
    {
        $locale = $this->saveSectionSettings($request, 'footer-section');

        // The footer columns are stored as one JSON blob. Link targets stay
        // shared; only the visible labels are translated, so a translated
        // footer can never break the navigation.
        if ($request->input('footer_columns')) {
            $columns = json_decode($request->input('footer_columns'), true);

            if (is_array($columns)) {
                foreach ($columns as &$col) {
                    $col['title'] = $col['title'] ?? '';
                    $col['lines'] = array_values(array_filter($col['lines'] ?? [], fn ($l) => !empty($l['text'])));
                }
                unset($col);

                if ($locale !== base_locale()) {
                    $columns = $this->mergeSharedColumnLinks($columns);
                }

                update_settings_for('footer_columns', json_encode($columns), $locale);
            }
        }

        if ($locale === base_locale() && $request->hasFile('footer_logo')) {
            $file = $request->file('footer_logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/uploads/footer'), $filename);
            update_settings('footer_logo', 'uploads/footer/' . $filename);
        }

        cache()->flush();

        return back()->with('success', __('Footer section updated successfully.'));
    }

    /**
     * Keep the URLs from the default-language footer so translating a column
     * label never rewrites where the link points.
     */
    protected function mergeSharedColumnLinks(array $columns): array
    {
        $baseColumns = json_decode((string) setting_raw('footer_columns', base_locale(), '[]'), true) ?: [];

        foreach ($columns as $ci => $col) {
            foreach ($col['lines'] ?? [] as $li => $line) {
                $columns[$ci]['lines'][$li]['url'] = $baseColumns[$ci]['lines'][$li]['url'] ?? ($line['url'] ?? '');
            }
        }

        return $columns;
    }
}
