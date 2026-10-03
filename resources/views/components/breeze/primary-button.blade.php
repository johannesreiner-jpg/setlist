<button {{ $attributes->merge(['type' => 'submit', 'class' => 'neon-btn px-4 py-2 rounded text-sm font-medium']) }}>
    {{ $slot }}
</button>