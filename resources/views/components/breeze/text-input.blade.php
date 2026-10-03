@props(['disabled' => false])

<input @disabled($disabled)
       {{ $attributes->merge(['class' => 'w-full border neon-border rounded p-3']) }}
       style="background:#0A0B0A; color:#8FBF8A">