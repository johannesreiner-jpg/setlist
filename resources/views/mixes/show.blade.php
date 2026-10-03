<x-public-layout :title="$mix->title">

    <a href="{{ route('mixes.index') }}" class="link text-sm">
        &larr; All sets
    </a>

    <div class="flex gap-6 mt-4 mb-8">
        @if ($mix->image_path)
            <img src="{{ asset('storage/' . $mix->image_path) }}" alt=""
                 class="w-40 h-40 object-cover rounded border neon-border shrink-0">
        @endif

        <div>
            <h1 class="text-3xl font-semibold neon mb-1">{{ $mix->title }}</h1>
            <p style="color:#4A6B48">by {{ $mix->user->name }}</p>

            @if ($mix->genre)
                <span class="inline-block mt-3 px-2 py-1 border neon-border rounded text-xs neon">
                    {{ $mix->genre }}
                </span>
            @endif
        </div>
    </div>

    @if ($mix->description)
        <p class="max-w-2xl mb-10 whitespace-pre-line">{{ $mix->description }}</p>
    @endif

    @can('update', $mix)
        <div class="flex gap-3 mb-10">
            <a href="{{ route('user.mixes.edit', $mix) }}"
               class="link px-3 py-1.5 border neon-border rounded text-sm">
                Edit
            </a>

            <form method="POST" action="{{ route('user.mixes.destroy', $mix) }}"
                  onsubmit="return confirm('Delete this set?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-3 py-1.5 border border-red-900 rounded text-sm text-red-400">
                    Delete
                </button>
            </form>
        </div>
    @endcan

    @if ($mix->audio_path)
        <audio controls class="w-full mb-10">
            <source src="{{ asset('storage/' . $mix->audio_path) }}">
        </audio>
    @else
        <p class="text-sm mb-10" style="color:#4A6B48">No audio file for this set.</p>
    @endif

    @auth
        <form method="POST" action="{{ route('mixes.comments.store', $mix) }}" class="mb-10 max-w-2xl">
            @csrf

            <textarea name="body" rows="3" placeholder="Write a comment…"
                      class="w-full border neon-border rounded p-3"
                      style="background:#0F120F; color:#8FBF8A"></textarea>

            @error('body')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror

            <button type="submit" class="neon-btn mt-2 px-4 py-2 rounded text-sm font-medium">
                Post comment
            </button>
        </form>
    @else
        <p class="mb-10">
            <a href="{{ route('login') }}" class="link underline">Log in</a> to comment.
        </p>
    @endauth

    <h2 class="text-lg font-semibold neon mb-4">
        Comments ({{ $mix->comments->count() }})
    </h2>

    <ul class="space-y-4 max-w-2xl">
        @forelse ($mix->comments as $comment)
            <li class="border-l-2 neon-border pl-4">
                <p>{{ $comment->body }}</p>
                <p class="text-sm mt-1" style="color:#4A6B48">
                    {{ $comment->user->name }} · {{ $comment->created_at->diffForHumans() }}
                </p>
            </li>
        @empty
            <li style="color:#4A6B48">No comments yet.</li>
        @endforelse
    </ul>

</x-public-layout>