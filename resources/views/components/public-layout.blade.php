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

    @include('partials.theme')
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

                <details class="menu relative">
                    <summary class="nav-link {{ request()->routeIs('mixes.*') || request()->routeIs('user.mixes.*') ? 'active' : '' }}">Sets</summary>

                    <div class="menu-panel">
                        <a href="{{ route('mixes.index') }}" class="menu-item">All sets</a>

                        @auth
                            <a href="{{ route('user.mixes.index') }}" class="menu-item">My sets</a>
                            <a href="{{ route('user.mixes.create') }}" class="menu-item">Create set</a>
                        @endauth
                    </div>
                </details>

                @auth
                    <details class="menu relative">
                        <summary class="nav-link">{{ auth()->user()->name }}</summary>

                        <div class="menu-panel">
                            <a href="{{ route('profile.edit') }}" class="menu-item">Account settings</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="menu-item">Log out</button>
                            </form>
                        </div>
                    </details>
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
    <script>
        document.addEventListener('click', (e) => {
            document.querySelectorAll('details.menu[open]').forEach((menu) => {
                if (!menu.contains(e.target)) menu.open = false;
            });
        });
    </script>
    
</body>
</html>