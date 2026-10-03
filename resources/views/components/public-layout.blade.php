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

    <style>
        :root {
            --neon: #39FF14;
            --ink:  #8FBF8A;
        }
        body        { background: #0A0B0A; color: var(--ink); }
        .neon       { color: var(--neon); }
        .neon-border{ border-color: #16401A; }
        .neon-btn   { background: var(--neon); color: #0A0B0A; }
        .neon-btn:hover { background: #5BFF40; }
        a.nav-link       { color: var(--ink); }
        a.nav-link:hover { color: var(--neon); }
        a.nav-link.active{ color: var(--neon); }
        a.link       { color: var(--ink); }
        a.link:hover { color: var(--neon); }
    </style>
</head>
<body class="font-sans antialiased min-h-screen flex flex-col">

    <header class="border-b neon-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

            <a href="{{ route('welcome') }}" class="text-xl font-semibold tracking-tight neon">
                {{ config('app.name') }}
            </a>

            <nav class="flex items-center gap-6 text-sm">
                <a href="{{ route('welcome') }}"
                   class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}">Home</a>

                <a href="{{ route('about') }}"
                   class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>    

                <a href="{{ route('mixes.index') }}"
                   class="nav-link {{ request()->routeIs('mixes.*') ? 'active' : '' }}">Sets</a>

                @auth
                    <a href="{{ route('user.mixes.index') }}"
                        class="nav-link {{ request()->routeIs('user.mixes.*') ? 'active' : '' }}">My sets</a>
                    
                    <span class="neon font-medium">{{ auth()->user()->name }}</span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link">Log out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Log in</a>
                    <a href="{{ route('register') }}"
                       class="neon-btn px-3 py-1.5 rounded text-sm font-medium">Register</a>
                @endauth
            </nav>

        </div>
    </header>

    <main class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        {{ $slot }}
    </main>

    <footer class="border-t neon-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-sm" style="color:#4A6B48">
            &copy; {{ date('Y') }} {{ config('app.name') }} — a DJ set archive by Johnny Jonathan
        </div>
    </footer>

</body>
</html>