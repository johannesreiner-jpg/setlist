@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="dark">

    <title>{{ $title ? $title . ' — ' . config('app.name') : config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="font-sans antialiased bg-neutral-950 text-neutral-200 min-h-screen flex flex-col">

    <header class="bg-neutral-900 border-b border-neutral-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

            <a href="{{ url('/') }}" class="text-xl font-semibold tracking-tight text-white">
                {{ config('app.name') }}
            </a>

            <nav class="flex items-center gap-6 text-sm">
                @auth
                    <a href="{{ route('dashboard') }}" class="font-medium text-white">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-neutral-400 hover:text-white">Log in</a>
                    <a href="{{ route('register') }}" class="font-medium text-white">Register</a>
                @endauth
            </nav>

        </div>
    </header>

    <main class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        {{ $slot }}
    </main>

    <footer class="bg-neutral-900 border-t border-neutral-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-sm text-neutral-500">
            &copy; {{ date('Y') }} {{ config('app.name') }} — a DJ set archive by Johnny Jonathan
        </div>
    </footer>

</body>
</html>