@extends('layouts.admin')
@section('content')
    <div class="max-w-7xl mx-auto w-full px-4">
        @if($activeTab === 'seo')
            <x-admin.lang-select section="seo"
                                 :note="__('Search engines index each language separately. Pick a language to give it its own title, description and social preview.')"/>
        @endif

        <form method="post" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_tab" value="{{ $activeTab }}">
            <input type="hidden" name="lang" value="{{ $activeTab === 'seo' ? admin_locale() : base_locale() }}">
            <div
                class="border-b pb-3 border-gray-100 dark:border-gray-800">
                <ul class="flex gap-x-4 whitespace-nowrap overflow-x-auto sm:overflow-x-visible sm:p-2 lg:p-0">
                    @if(count($tab) > 0 )
                        @foreach($tab as $key)
                            <li>
                                <a href="{{ $key['nav'] === 'general' ? route('admin.settings.index') : route('admin.settings.index', $key['nav']) }}"
                                   class="w-full py-3 px-6 inline-flex justify-center items-center gap-4 text-sm font-medium text-center text-gray-500 rounded-lg hover:bg-gray-50 relative after:absolute after:-bottom-3 after:rounded-full after:left-0 after:right-0 after:h-1 dark:text-gray-400 dark:hover:text-gray-300 dark:hover:bg-gray-800 {{ $activeTab === $key['nav'] ? 'after:bg-primary-500 !text-primary-500 dark:!text-white' : '' }}">
                                    {{ __($key['title']) }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="py-6">
                @include('admin.settings.'.$activeTab)
                <x-form.primary class="max-w-xs w-full mt-6">{{__('Save change')}}</x-form.primary>
            </div>
        </form>
    </div>
    <x-form.tinymce/>
@endsection
