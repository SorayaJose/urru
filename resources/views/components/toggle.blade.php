@props(['model', 'label' => ''])

@php
    $id = 'toggle-' . str_replace(['.', '_'], '-', $model);
@endphp

<div class="mb-4" x-data="{ value: @entangle($model).defer }">
    <label for="{{ $id }}" class="flex items-center cursor-pointer">
        @if($label)
            <span class="mr-3 text-gray-700">{{ $label }}</span>
        @endif
        
        <div class="relative inline-block w-12 h-6">
            <input 
                type="checkbox" 
                x-model="value"
                id="{{ $id }}"
                class="sr-only peer"
            >
            <div class="w-12 h-6 bg-gray-300 peer-checked:bg-gray-800 rounded-full shadow-inner transition-colors duration-300 ease-in-out"></div>
            <div class="w-5 h-4 bg-white rounded-full shadow-md absolute top-1 left-1 transition-transform duration-300 ease-in-out peer-checked:translate-x-5 pointer-events-none"></div>
        </div>
        
        <span class="ml-3 text-sm" x-text="value ? 'Sí' : 'No'">No</span>
    </label>
</div>