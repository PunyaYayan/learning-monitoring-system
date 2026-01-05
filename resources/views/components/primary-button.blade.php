<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center px-5 py-2.5 rounded-md
                font-semibold text-sm
                bg-brand-primary text-brand-text
                hover:opacity-90
                focus:outline-none focus:ring-2 focus:ring-brand-primary focus:ring-offset-2
                transition'
]) }}>
    {{ $slot }}
</button>