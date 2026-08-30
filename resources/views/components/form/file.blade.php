@props(['disabled' => false, 'size'])

@php
    $size = [
        'xs' => 'px-3 py-2 text-xs',
        'sm' => 'px-4 py-2.5 text-sm leading-4',
        'md' => 'px-1 py-0.5 text-sm',
        'lg' => 'px-6 py-4 text-base'
    ][$size ?? 'md']
@endphp

<input type="file" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full text-sm text-gray-900 dark:text-gray-400 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:placeholder-gray-400 file:mr-4 file:py-3 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-medium file:bg-blue-600 file:text-white hover:file:bg-blue-700 file:cursor-pointer transition-colors '.$size]) !!}>
