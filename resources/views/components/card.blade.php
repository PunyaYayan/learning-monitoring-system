<div {{ $attributes->merge([
    'class' => 'bg-white rounded-2xl shadow-sm ring-1 ring-gray-100 p-6'
]) }}>
    {{ $slot }}
</div>