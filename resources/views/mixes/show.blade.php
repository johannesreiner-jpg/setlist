<x-public-layout :title="$mix->title">

    <a href="{{ route('mixes.index') }}" class="text-sm text-neutral-500 hover:text-neutral-300">
        &larr; All sets
    </a>

    <h1 class="text-3xl font-semibold text-white mt-4 mb-1">{{ $mix->title }}</h1>
    <p class="text-neutral-500 mb-10">by {{ $mix->user->name }}</p>

    <h2 class="text-lg font-semibold text-neutral-200 mb-4">
        Comments ({{ $mix->comments->count() }})
    </h2>

    <ul class="space-y-4">
        @forelse ($mix->comments as $comment)
            <li class="border-l-2 border-neutral-700 pl-4">
                <p class="text-neutral-300">{{ $comment->body }}</p>
                <p class="text-neutral-600 text-sm mt-1">
                    {{ $comment->user->name }} · {{ $comment->created_at->diffForHumans() }}
                </p>
            </li>
        @empty
            <li class="text-neutral-600">No comments yet.</li>
        @endforelse
    </ul>

</x-public-layout>