@props(['title', 'desc', 'href', 'bg' => 'bg-brand-primary/20'])

<a href="{{ $href }}" class="block rounded-2xl p-6 transition hover:scale-[1.01] {{ $bg }}">
    <h4 class="font-semibold text-lg mb-1">{{ $title }}</h4>
    <p class="text-sm text-gray-700">{{ $desc }}</p>
</a>