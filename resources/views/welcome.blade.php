<x-public-layout title="Home">

    @auth
        <h1 class="text-4xl font-semibold tracking-tight neon mb-2">
            Welcome back, {{ auth()->user()->name }}
        </h1>

        <p class="mb-12" style="color:#4A6B48">
            {{ $myMixCount }} sets uploaded · {{ $myCommentCount }} comments received
        </p>
    @else
        <h1 class="text-4xl font-semibold tracking-tight neon mb-3">Setlist</h1>

        <p class="text-lg mb-6 max-w-2xl">
            An archive for recorded DJ sets. Listen to a full set, see who played it,
            and leave a comment.
        </p>

        <div class="flex flex-wrap gap-3 mb-12">
            <a href="{{ route('mixes.index') }}"
               class="neon-btn px-5 py-2.5 rounded font-medium">Browse sets</a>
            <a href="{{ route('register') }}"
               class="link px-5 py-2.5 border neon-border rounded">Create an account</a>
        </div>
    @endauth

    @if ($latestMixes->isNotEmpty())
        <div class="flex items-baseline justify-between mb-4 max-w-5xl">
            <h2 class="text-lg font-semibold neon">Latest sets</h2>
            <a href="{{ route('mixes.index') }}" class="link text-sm">All sets &rarr;</a>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 max-w-5xl mb-14">
            @foreach ($latestMixes as $mix)
                <a href="{{ route('mixes.show', $mix) }}"
                   class="block border neon-border rounded overflow-hidden">
                    @if ($mix->image_path)
                        <img src="{{ asset('storage/' . $mix->image_path) }}" alt=""
                             class="w-full h-40 object-cover">
                    @else
                        <div class="w-full h-40" style="background:#0F120F"></div>
                    @endif

                    <div class="p-4">
                        <p class="neon font-medium mb-1">{{ $mix->title }}</p>
                        <p class="text-sm" style="color:#4A6B48">by {{ $mix->user->name }}</p>

                        @if ($mix->genre)
                            <span class="inline-block mt-3 px-2 py-1 border neon-border rounded text-xs neon">
                                {{ $mix->genre }}
                            </span>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    @endif

    @if ($genres->isNotEmpty())
        <h2 class="text-lg font-semibold neon mb-4">Browse by genre</h2>

        <div class="flex flex-wrap gap-2 mb-14">
            @foreach ($genres as $genre)
                <a href="{{ route('mixes.index', ['q' => $genre]) }}"
                   class="link px-3 py-1.5 border neon-border rounded text-sm">{{ $genre }}</a>
            @endforeach
        </div>
    @endif

    @auth
        <h2 class="text-lg font-semibold neon mb-4">Comments on your sets</h2>

        <div class="space-y-3 max-w-3xl">
            @forelse ($commentsOnMyMixes as $comment)
                <a href="{{ route('mixes.show', $comment->mix) }}"
                   class="block border neon-border rounded p-4">
                    <p class="mb-2">{{ $comment->body }}</p>
                    <p class="text-sm" style="color:#4A6B48">
                        {{ $comment->user->name }} on {{ $comment->mix->title }}
                        · {{ $comment->created_at->diffForHumans() }}
                    </p>
                </a>
            @empty
                <p style="color:#4A6B48">Nobody has commented on your sets yet.</p>
            @endforelse
        </div>
    @endauth

</x-public-layout>