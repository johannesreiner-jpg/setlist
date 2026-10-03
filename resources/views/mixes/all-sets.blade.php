<x-public-layout title="Sets">

    <h1 class="text-3xl font-semibold neon mb-6">Sets</h1>

    <form method="GET" action="{{ route('mixes.index') }}" class="flex gap-2 mb-8 max-w-md">
        <input type="search" name="q" value="{{ $search }}"
               placeholder="Search title, genre or DJ…"
               class="flex-1 border neon-border rounded p-2 text-sm"
               style="background:#0F120F; color:#8FBF8A">
        <button type="submit" class="neon-btn px-4 py-2 rounded text-sm font-medium">Search</button>
    </form>

    @if ($search)
        <p class="text-sm mb-4" style="color:#4A6B48">
            {{ $mixes->count() }} result(s) for "{{ $search }}" —
            <a href="{{ route('mixes.index') }}" class="link underline">clear</a>
        </p>
    @endif

    <ul class="space-y-3 max-w-3xl">
        @forelse ($mixes as $mix)
            <li class="border neon-border rounded p-4 flex items-center gap-4">
                @if ($mix->image_path)
                    <img src="{{ asset('storage/' . $mix->image_path) }}" alt=""
                         class="w-12 h-12 object-cover rounded shrink-0">
                @endif

                <div>
                    <a href="{{ route('mixes.show', $mix) }}" class="link">{{ $mix->title }}</a>
                    <span class="text-sm" style="color:#4A6B48">— {{ $mix->user->name }}</span>

                    @if ($mix->genre)
                        <span class="block text-xs neon mt-1">{{ $mix->genre }}</span>
                    @endif
                </div>
            </li>
        @empty
            <li style="color:#4A6B48">No sets found.</li>
        @endforelse
    </ul>

</x-public-layout>