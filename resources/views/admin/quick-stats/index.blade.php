@extends('layouts.admin')
@section('content')
    <div class="max-w-5xl mx-auto w-full">

        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{__('Quick Statistics')}}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{__('Manage the statistics counters displayed on the homepage hero section')}}</p>
        </div>

        <x-admin.lang-select section="quick-stats"/>


        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-6 lg:p-8">
            <form method="POST" action="{{ route('admin.quick-stats.update') }}">
                @csrf
                <input type="hidden" name="lang" value="{{ admin_locale() }}">

                <div class="space-y-6">

                    @foreach([1,2,3,4] as $i)
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-6 gap-y-4">
                        <div class="lg:col-span-3">
                            <x-form.label for="stat{{ $i }}_number" :value="__('Stat :n Number', ['n' => $i])"/>
                            <x-form.input id="stat{{ $i }}_number" name="stat{{ $i }}_number" type="number" class="mt-1 block w-full"
                                          :value="old('stat'.$i.'_number', config('settings.stat'.$i.'_number', '0'))" placeholder="{{__('e.g. 100')}}"/>
                        </div>
                        <div class="lg:col-span-2">
                            <x-form.label for="stat{{ $i }}_suffix" :value="__('Suffix')"/>
                            <x-form.input id="stat{{ $i }}_suffix" name="stat{{ $i }}_suffix" type="text" class="mt-1 block w-full"
                                          :value="old('stat'.$i.'_suffix', admin_value('stat'.$i.'_suffix', ''))" placeholder="{{ admin_placeholder('stat'.$i.'_suffix', __('e.g. % or +')) }}"/>
                        </div>
                        <div class="lg:col-span-3">
                            <x-form.label for="stat{{ $i }}_suffix_pos" :value="__('Suffix Position')"/>
                            <select id="stat{{ $i }}_suffix_pos" name="stat{{ $i }}_suffix_pos"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm text-sm">
                                <option value="right" {{ old('stat'.$i.'_suffix_pos', config('settings.stat'.$i.'_suffix_pos', 'right')) === 'right' ? 'selected' : '' }}>{{__('Right of number')}}</option>
                                <option value="left" {{ old('stat'.$i.'_suffix_pos', config('settings.stat'.$i.'_suffix_pos', 'right')) === 'left' ? 'selected' : '' }}>{{__('Left of number')}}</option>
                            </select>
                        </div>
                        <div class="lg:col-span-4">
                            <x-form.label for="stat{{ $i }}_label" :value="__('Label')"/>
                            <x-form.input id="stat{{ $i }}_label" name="stat{{ $i }}_label" type="text" class="mt-1 block w-full"
                                          :value="old('stat'.$i.'_label', admin_value('stat'.$i.'_label', ''))" placeholder="{{ admin_placeholder('stat'.$i.'_label', __('e.g. Organic')) }}"/>
                        </div>
                    </div>
                    @if($i < 4)
                    <hr class="border-gray-100 dark:border-gray-800">
                    @endif
                    @endforeach

                    <hr class="border-gray-100 dark:border-gray-800">

                    <x-form.primary class="max-w-xs w-full">
                        {{__('Save changes')}}
                    </x-form.primary>
                </div>
            </form>
        </div>
    </div>
@endsection
