@props(['disabled' => false, 'size', 'type' => 'text'])

@php
    $size = [
        'xs' => 'px-3 py-2 text-xs',
        'sm' => 'px-4 py-2.5 text-sm leading-4',
        'md' => 'px-5 py-3 text-sm',
        'lg' => 'px-6 py-4 text-base'
    ][$size ?? 'md'];
    
    // For file inputs, use specific styling
    $defaultClasses = $type === 'file' 
        ? 'block w-full text-sm text-gray-900 dark:text-gray-400 border border-gray-300 dark:border-gray-700 rounded-lg cursor-pointer bg-white dark:bg-gray-800 focus:outline-none file:mr-4 file:py-3 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-medium file:bg-primary-500 file:text-white hover:file:bg-primary-600 file:cursor-pointer transition-colors' 
        : 'block w-full border-2 border-gray-300 dark:border-gray-600 rounded-md text-sm '.$size.' focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:text-gray-300 placeholder-gray-400 shadow-sm dark:focus:ring-primary-500 dark:focus:border-primary-500 transition-colors';
@endphp

<input type="{{ $type }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $defaultClasses]) !!}>
