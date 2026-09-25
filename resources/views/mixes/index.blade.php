<x-public-layout title="Sets">

    <h1 class="text-3xl font-semibold text-white mb-6">Sets</h1>

        @auth
        <a href="{{ route('user.mixes.create') }}" class="inline-block mb-6 px-4 py-2 bg-neutral-200 text-neutral-900 rounded text-sm font-medium">
            + New set
        </a>
    @endauth

    <ul class="space-y-3">
        @foreach ($mixes as $mix)
            <li class="border border-neutral-800 rounded p-4">
                <a href="{{ route('mixes.show', $mix) }}" class="text-neutral-100 hover:text-white">{{ $mix->title }}</a>
                <span class="text-neutral-500 text-sm">— {{ $mix->user->name }}</span>
            </li>
        @endforeach
    </ul>

</x-public-layout>