@props(['disabled' => false, 'size'])

@php
    $size = [
        'xs' => 'px-2.5 py-2 text-xs',
        'sm' => 'px-3 py-2.5 text-sm leading-4',
        'md' => 'px-4 py-3.5 text-sm',
        'lg' => 'px-4 py-4 text-base'
    ][$size ?? 'md']
@endphp

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full border-2 border-gray-300 dark:border-gray-600 rounded-md text-sm '.$size.' focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-800 dark:text-gray-300 placeholder-gray-400 shadow-sm dark:focus:ring-primary-500 dark:focus:border-primary-500 transition-colors']) !!}>
    {{ $slot }}
    {{ $append ?? '' }}
</select>
