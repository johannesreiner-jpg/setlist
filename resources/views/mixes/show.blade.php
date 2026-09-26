<x-public-layout :title="$mix->title">

    <a href="{{ route('mixes.index') }}" class="text-sm text-neutral-500 hover:text-neutral-300">
        &larr; All sets
    </a>

    <h1 class="text-3xl font-semibold text-white mt-4 mb-1">{{ $mix->title }}</h1>
    <p class="text-neutral-500 mb-10">by {{ $mix->user->name }}</p>

    @can('update', $mix)
        <div class="flex gap-3 mb-10">
            <a href="{{ route('user.mixes.edit', $mix) }}"
               class="px-3 py-1.5 border border-neutral-700 rounded text-sm text-neutral-300 hover:text-white">
                Edit
            </a>

            <form method="POST" action="{{ route('user.mixes.destroy', $mix) }}"
                  onsubmit="return confirm('Delete this set?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-3 py-1.5 border border-neutral-700 rounded text-sm text-red-400 hover:text-red-300">
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
        <p class="text-neutral-600 text-sm mb-10">No audio file for this set.</p>
    @endif

    @auth
        <form method="POST" action="{{ route('mixes.comments.store', $mix) }}" class="mb-10">
            @csrf

            <textarea name="body" rows="3" placeholder="Write a comment…"
                      class="w-full bg-neutral-900 border border-neutral-700 rounded p-3 text-neutral-200"></textarea>

            @error('body')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror

            <button type="submit" class="mt-2 px-4 py-2 bg-neutral-200 text-neutral-900 rounded text-sm font-medium">
                Post comment
            </button>
        </form>
    @else
        <p class="text-neutral-500 mb-10">
            <a href="{{ route('login') }}" class="underline">Log in</a> to comment.
        </p>
    @endauth

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