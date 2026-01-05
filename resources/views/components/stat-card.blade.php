@props(['label', 'value' => '0'])

<div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-100 p-5">
    <p class="text-sm text-gray-500">{{ $label }}</p>
    <p class="text-3xl font-semibold mt-1">{{ $value }}</p>
</div>