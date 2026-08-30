@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{__('Gallery')}}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{__('Manage images for the gallery slider on the homepage')}}</p>
            </div>
        </div>

        <x-admin.lang-select :fields="['caption']"/>

        @php $translatingGallery = admin_locale() !== base_locale(); @endphp

        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-6 lg:p-8 mb-8 {{ $translatingGallery ? 'hidden' : '' }}">
            <h2 class="text-base font-medium text-gray-900 dark:text-white mb-4">{{__('Upload Images')}}</h2>
            <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col sm:flex-row items-start gap-4">
                    <div class="flex-1 w-full">
                        <input type="file" name="images[]" multiple accept="image/*"
                               class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 py-2 px-3">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5">{{__('Select multiple images at once. Max 5MB each.')}}</p>
                    </div>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/></svg>
                        {{__('Upload')}}
                    </button>
                </div>
            </form>
        </div>

        @if($images->count())
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @foreach($images as $image)
                <div class="group relative bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl overflow-hidden shadow-sm">
                    <div class="aspect-square">
                        <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->t('caption') }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-3">
                        <form method="POST" action="{{ route('admin.gallery.update', $image->id) }}" class="space-y-2">
                            @csrf @method('PUT')
                            <input type="hidden" name="lang" value="{{ admin_locale() }}">
                            <input type="text" name="caption" value="{{ model_value($image, 'caption', '') }}"
                                   placeholder="{{ model_placeholder($image, 'caption', __('Caption (optional)')) }}"
                                   class="block w-full text-xs border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 rounded-md py-1.5 px-2">
                            <div class="flex items-center justify-between gap-2">
                                <div class="flex items-center gap-2">
                                    <input type="number" name="sort_order" value="{{ $image->sort_order }}" {{ $translatingGallery ? 'disabled' : '' }} class="w-14 text-xs border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 rounded-md py-1 px-2" title="{{__('Sort Order')}}">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" class="sr-only peer" value="1" {{ $translatingGallery ? 'disabled' : '' }} {{ $image->is_active ? 'checked' : '' }}>
                                        <div class="w-8 h-4.5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3.5 after:w-3.5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                    </label>
                                </div>
                                <button type="submit" class="text-xs text-blue-600 hover:text-blue-700 font-medium">{{__('Save')}}</button>
                            </div>
                        </form>
                        <form method="POST" action="{{ route('admin.gallery.destroy', $image->id) }}" onsubmit="return confirm('{{__('Are you sure?')}}')">
                            @csrf @method('DELETE')
                            <button type="submit" class="absolute top-2 right-2 w-7 h-7 bg-black/50 hover:bg-red-600 rounded-full flex items-center justify-center text-white transition-colors opacity-0 group-hover:opacity-100">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        @if($images->hasPages())
            <div class="mt-6">
                {{ $images->links() }}
            </div>
        @endif
        @else
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-12 text-center">
                <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3 3h18M3 3v18m0-18h.008v.008H3V3Z"/></svg>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{__('No gallery images yet. Upload some to get started.')}}</p>
            </div>
        @endif
    </div>
@endsection
