<x-public-layout title="Home">

    @auth
        <h1 class="text-4xl font-semibold tracking-tight neon mb-2">
            Welcome back, {{ auth()->user()->name }}
        </h1>
    @else
        <h1 class="text-4xl font-semibold tracking-tight neon mb-2">Setlist</h1>
    @endauth

    <p class="text-lg mb-10">
        DJ sets, the tracks inside them, and where to find every single one.
    </p>

    <div class="grid grid-cols-3 gap-4 max-w-2xl mb-12">
        <div class="border neon-border rounded p-5">
            <div class="text-3xl font-semibold neon">{{ $mixCount }}</div>
            <div class="text-sm">Sets</div>
        </div>
        <div class="border neon-border rounded p-5">
            <div class="text-3xl font-semibold neon">{{ $djCount }}</div>
            <div class="text-sm">DJs</div>
        </div>
        <div class="border neon-border rounded p-5">
            <div class="text-3xl font-semibold neon">{{ $commentCount }}</div>
            <div class="text-sm">Comments</div>
        </div>
    </div>

    <h2 class="neon font-semibold mb-4">Latest comments</h2>

    <div class="space-y-3 max-w-2xl">
        @forelse ($latestComments as $comment)
            <a href="{{ route('mixes.show', $comment->mix) }}"
               class="block border neon-border rounded p-4">
                <p class="mb-2">{{ $comment->body }}</p>
                <p class="text-sm" style="color:#4A6B48">
                    {{ $comment->user->name }} — on {{ $comment->mix->title }}
                </p>
            </a>
        @empty
            <p>No comments yet.</p>
        @endforelse
    </div>

</x-public-layout>