<x-public-layout title="Sets">

    <h1 class="text-3xl font-semibold text-white mb-6">Sets</h1>

    <ul class="space-y-3">
        @foreach ($mixes as $mix)
            <li class="border border-neutral-800 rounded p-4">
                <span class="text-neutral-100">{{ $mix->title }}</span>
                <span class="text-neutral-500 text-sm">— {{ $mix->user->name }}</span>
            </li>
        @endforeach
    </ul>

</x-public-layout>