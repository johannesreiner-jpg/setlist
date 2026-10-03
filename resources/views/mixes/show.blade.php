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

    <div class="flex gap-2 mt-3">
        @if ($mix->genre)
            <span class="px-2 py-1 border neon-border rounded text-xs neon">{{ $mix->genre }}</span>
        @endif

        @if ($mix->bpm)
            <span class="px-2 py-1 border neon-border rounded text-xs neon">{{ $mix->bpm }} BPM</span>
        @endif
            </div>
        </div>
    </div>

    @if ($mix->description)
        <p class="max-w-3xl mb-10 whitespace-pre-line">{{ $mix->description }}</p>
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
        <div class="border neon-border rounded p-4 mb-10 max-w-3xl">
            <p id="waveformLoading" class="text-sm" style="color:#4A6B48">Loading waveform…</p>

            <div id="waveform"></div>

            <div class="flex items-center gap-4 mt-3">
                <button type="button" id="playPause"
                        class="neon-btn px-4 py-1.5 rounded text-sm font-medium">Play</button>

                <span class="text-sm" style="color:#4A6B48">
                    <span id="currentTime">0:00</span> / <span id="totalTime">0:00</span>
                </span>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/wavesurfer.js@7/dist/wavesurfer.min.js"></script>
        <script>
            const wavesurfer = WaveSurfer.create({
                container: '#waveform',
                url: '{{ asset('storage/' . $mix->audio_path) }}',
                height: 80,
                waveColor: '#1F5C22',
                progressColor: '#39FF14',
                cursorColor: '#39FF14',
                barWidth: 2,
                barGap: 1,
                barRadius: 2,
            });

            const button = document.getElementById('playPause');
            const current = document.getElementById('currentTime');
            const total = document.getElementById('totalTime');
            const loading = document.getElementById('waveformLoading');

            const format = (seconds) => {
                const minutes = Math.floor(seconds / 60);
                const rest = Math.floor(seconds % 60).toString().padStart(2, '0');
                return minutes + ':' + rest;
            };

            button.addEventListener('click', () => wavesurfer.playPause());

            wavesurfer.on('ready', () => {
                loading.style.display = 'none';
                total.textContent = format(wavesurfer.getDuration());
            });

            wavesurfer.on('timeupdate', (time) => current.textContent = format(time));
            wavesurfer.on('play', () => button.textContent = 'Pause');
            wavesurfer.on('pause', () => button.textContent = 'Play');
        </script>
    @else
        <p class="text-sm mb-10" style="color:#4A6B48">No audio file for this set.</p>
    @endif

    @auth
        <form method="POST" action="{{ route('mixes.comments.store', $mix) }}" class="mb-10 max-w-3xl">
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

    <ul class="space-y-4 max-w-3xl">
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