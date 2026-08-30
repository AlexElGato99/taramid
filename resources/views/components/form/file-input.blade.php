@props(['disabled' => false, 'multiple' => false, 'accept' => 'image/*', 'id' => null, 'name' => null])

<input {{ $disabled ? 'disabled' : '' }} 
       {{ $multiple ? 'multiple' : '' }}
       type="file"
       accept="{{ $accept }}"
       @if($id) id="{{ $id }}" @endif
       @if($name) name="{{ $name }}" @endif
       {!! $attributes->merge(['class' => 'block w-full text-sm text-gray-900 dark:text-gray-400 border border-gray-300 dark:border-gray-700 rounded-lg cursor-pointer bg-white dark:bg-gray-800 focus:outline-none file:mr-4 file:py-3 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-medium file:bg-primary-500 file:text-white hover:file:bg-primary-600 file:cursor-pointer transition-colors']) !!}>
