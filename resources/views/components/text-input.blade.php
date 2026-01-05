@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge([
    'class' => 'mt-1 block w-full rounded-md border-gray-300
                focus:border-brand-primary focus:ring-brand-primary
                shadow-sm'
]) }}>