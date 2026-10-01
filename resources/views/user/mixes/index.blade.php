<x-public-layout title="My sets">

    <h1 class="text-3xl font-semibold neon mb-6">My sets</h1>

    <a href="{{ route('user.mixes.create') }}"
       class="neon-btn inline-block mb-8 px-4 py-2 rounded text-sm font-medium">
        + New set
    </a>

    <ul class="space-y-3 max-w-3xl">
        @forelse ($mixes as $mix)
            <li class="border neon-border rounded p-4 flex items-center justify-between">
                <a href="{{ route('mixes.show', $mix) }}">{{ $mix->title }}</a>

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
            <li>You have not uploaded any sets yet.</li>
        @endforelse
    </ul>

</x-public-layout>