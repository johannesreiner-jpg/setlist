<x-public-layout title="My sets">

    <h1 class="text-3xl font-semibold neon mb-6">My sets</h1>

    <a href="{{ route('user.mixes.create') }}"
       class="neon-btn inline-block mb-8 px-4 py-2 rounded text-sm font-medium">
        + New set
    </a>

    <form method="GET" action="{{ route('user.mixes.index') }}" class="flex gap-2 mb-8 max-w-md">
        <input type="search" name="q" value="{{ $search }}"
               placeholder="Search title or genre…"
               class="flex-1 border neon-border rounded p-2 text-sm"
               style="background:#0F120F; color:#8FBF8A">
        <button type="submit" class="neon-btn px-4 py-2 rounded text-sm font-medium">Search</button>
    </form>

    @if ($search)
        <p class="text-sm mb-4" style="color:#4A6B48">
            {{ $mixes->count() }} result(s) for "{{ $search }}" —
            <a href="{{ route('user.mixes.index') }}" class="link underline">clear</a>
        </p>
    @endif

    <ul class="space-y-3 max-w-3xl">
        @forelse ($mixes as $mix)
            <li class="border neon-border rounded p-4 flex items-center justify-between">
                <a href="{{ route('mixes.show', $mix) }}" class="link">{{ $mix->title }}</a>

                <span class="flex items-center gap-4 text-sm">
                    <a href="{{ route('user.mixes.edit', $mix) }}" class="neon">Edit</a>

                    <form method="POST" action="{{ route('user.mixes.destroy', $mix) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="neon">Delete</button>
                    </form>
                </span>
            </li>
        @empty
            <li style="color:#4A6B48">You have not uploaded any sets yet.</li>
        @endforelse
    </ul>

</x-public-layout>