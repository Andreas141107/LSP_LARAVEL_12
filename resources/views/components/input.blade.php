@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:ring-blue-200 duration-300 rounded-md shadow-sm mt-2 ml-2']) !!}>
