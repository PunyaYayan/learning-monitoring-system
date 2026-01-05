<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'inline-flex items-center px-4 py-2 rounded-md font-semibold text-sm
              bg-brand-secondary text-brand-text hover:opacity-90
              focus:outline-none focus:ring-2 focus:ring-brand-primary focus:ring-offset-2
              transition'
]) }}>
    {{ $slot }}
</button>