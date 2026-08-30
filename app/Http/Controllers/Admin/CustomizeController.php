<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Settings;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class CustomizeController extends Controller
{
    public function index(Request $request)
    {
        $config = [
            'title' => __('Settings'),
            'nav' => 'settings',
        ];
        $tab = [
            'general' => [
                'title' => 'General',
                'nav' => 'general',
                'icon' => 'setting-2',
            ],
            'customize' => [
                'title' => 'Customize',
                'nav' => 'customize',
                'icon' => 'brush-2',
            ],
            'seo' => [
                'title' => 'Seo',
                'nav' => 'seo',
                'icon' => 'link-1',
            ],
            'email' => [
                'title' => 'Email',
                'nav' => 'email',
                'icon' => 'sms-tracking',
            ],
            'api' => [
                'title' => 'Api',
                'nav' => 'api',
                'icon' => 'key',
            ]
        ];
        $modules = collect([]);
        return view('admin.customize.index', compact('config', 'tab', 'modules'));
    }

    public function update(Request $request)
    {
        $save_data = [
            'button_color',
            'palette'
        ];
        foreach ($save_data as $item) {
            update_settings($item, $request->$item);
        }

        $heroIcons = json_decode(config('settings.hero_floating_icons', '[]'), true) ?: [];

        if ($request->has('remove_icons')) {
            $removeIndexes = $request->input('remove_icons', []);
            foreach ($removeIndexes as $index) {
                if (isset($heroIcons[$index])) {
                    $path = public_path('storage/' . $heroIcons[$index]);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                    unset($heroIcons[$index]);
                }
            }
            $heroIcons = array_values($heroIcons);
        }

        if ($request->hasFile('hero_icons')) {
            foreach ($request->file('hero_icons') as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/uploads/hero-icons'), $filename);
                $heroIcons[] = 'uploads/hero-icons/' . $filename;
            }
        }

        update_settings('hero_floating_icons', json_encode(array_values($heroIcons)));

        if ($request->hasFile('favicon')) {
            $faviconPath = public_path(config('attr.favicon.path'));
            if (!file_exists($faviconPath)) {
                mkdir($faviconPath, 0777, true);
            }
            $faviconFile = $request->file('favicon');
            $mime = $faviconFile->getMimeType();

            if ($mime === 'image/svg+xml') {
                $faviconFile->move($faviconPath, 'favicon.svg');
                update_settings('favicon_type', 'svg');
            } else {
                @unlink($faviconPath . 'favicon.svg');
                foreach (config('attr.favicon.sizes') as $size => $favicon) {
                    foreach (['png', 'jpg', 'gif', 'webp'] as $ext) {
                        @unlink($faviconPath . $favicon . '.' . $ext);
                    }
                    $img = Image::make($faviconFile)->orientate();
                    $img->fit($size, $size, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->encode('png', 100);
                    $img->save($faviconPath . $favicon . '.png');
                }
                update_settings('favicon_type', 'png');
            }
            update_settings('favicon_version', time());
        }

        Cache::forget('settings');
        Cache::flush();
        return redirect()->route('admin.customize.index')->with('success', __(':title updated', ['title' => __('Customize')]));
    }
}
