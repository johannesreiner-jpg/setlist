<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="dark">

    <title>{{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.1/dist/cdn.min.js"></script>

    @include('partials.theme')
</head>
<body class="font-sans antialiased">

    <div class="min-h-screen flex flex-col justify-center items-center px-4">
        <a href="{{ route('welcome') }}" class="text-3xl font-semibold tracking-tight neon mb-8">
            {{ config('app.name') }}
        </a>

        <div class="w-full sm:max-w-md border neon-border rounded p-6" style="background:#0F120F">
            {{ $slot }}
        </div>

        <a href="{{ route('mixes.index') }}" class="link text-sm mt-6">&larr; Back to all sets</a>
    </div>

</body>
</html>