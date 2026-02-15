@props([
    'label' => null,
    'type' => 'text',
    'name',
])

<div>
    @if ($label)
        <label class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
        </label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name) }}"
        {{ $attributes->merge([
            'class' => 'w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-green-500'
        ]) }}
    >
</div>
