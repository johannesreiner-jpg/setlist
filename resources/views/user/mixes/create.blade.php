<x-public-layout title="New set">

    <a href="{{ route('user.mixes.index') }}" class="link text-sm">
        &larr; My sets
    </a>

    <h1 class="text-3xl font-semibold neon mt-4 mb-8">New set</h1>

    <form method="POST" action="{{ route('user.mixes.store') }}" enctype="multipart/form-data" class="max-w-xl">
        @csrf

        <label for="title" class="block text-sm neon mb-2">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}"
               class="w-full border neon-border rounded p-3"
               style="background:#0F120F; color:#8FBF8A">
        @error('title')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror

        <label for="genre" class="block text-sm neon mt-6 mb-2">Genre</label>
        <select name="genre" id="genre"
                class="w-full border neon-border rounded p-3"
                style="background:#0F120F; color:#8FBF8A">
            <option value="">Choose a genre …</option>
            @foreach ($genres as $genre)
                <option value="{{ $genre }}" @selected(old('genre') === $genre)>{{ $genre }}</option>
            @endforeach
        </select>
        @error('genre')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror

        <label for="bpm" class="block text-sm neon mt-6 mb-2">BPM</label>
        <input type="number" name="bpm" id="bpm" value="{{ old('bpm') }}" min="40" max="300"
               placeholder="128"
               class="w-full border neon-border rounded p-3"
               style="background:#0F120F; color:#8FBF8A">
        @error('bpm')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror

        <label for="description" class="block text-sm neon mt-6 mb-2">Description <span style="color:#4A6B48">(optional)</span></label>
        <textarea name="description" id="description" rows="4"
                  placeholder="Where was it recorded, what is the mood …"
                  class="w-full border neon-border rounded p-3"
                  style="background:#0F120F; color:#8FBF8A">{{ old('description') }}</textarea>
        @error('description')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror

        <label for="audio" class="block text-sm neon mt-6 mb-2">Audio file</label>
        <input type="file" name="audio" id="audio" accept=".mp3,.wav"
               class="w-full text-sm file:mr-3 file:py-2 file:px-3 file:rounded file:border-0 file:bg-neutral-800 file:text-neutral-200">
        @error('audio')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror

        <label for="image" class="block text-sm neon mt-6 mb-2">Cover image</label>
        <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.webp"
               class="w-full text-sm file:mr-3 file:py-2 file:px-3 file:rounded file:border-0 file:bg-neutral-800 file:text-neutral-200">
        @error('image')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror

        <button type="submit" class="neon-btn mt-8 px-4 py-2 rounded text-sm font-medium">
            Create set
        </button>
    </form>

</x-public-layout>