@props(['disabled' => false])

<x-form.button :disabled="$disabled" {{ $attributes->merge(['type' => 'submit', 'class' => '!rounded-lg border border-transparent text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:hover:bg-blue-700 dark:focus:ring-offset-gray-800']) }}>
    {{ $slot }}
</x-form.button>
