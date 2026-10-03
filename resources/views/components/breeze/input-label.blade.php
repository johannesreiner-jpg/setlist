@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm neon mb-1']) }}>
    {{ $value ?? $slot }}
</label>