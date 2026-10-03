<x-public-layout title="Edit set">

    <a href="{{ route('mixes.show', $mix) }}" class="link text-sm">
        &larr; Back to set
    </a>

    <h1 class="text-3xl font-semibold neon mt-4 mb-8">Edit set</h1>

    <form method="POST" action="{{ route('user.mixes.update', $mix) }}" enctype="multipart/form-data" class="max-w-xl">
        @csrf
        @method('PATCH')

        <label for="title" class="block text-sm neon mb-2">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title', $mix->title) }}"
               class="w-full border neon-border rounded p-3"
               style="background:#0F120F; color:#8FBF8A">
        @error('title')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror

        <label for="genre" class="block text-sm neon mt-6 mb-2">Genre</label>
        <input type="text" name="genre" id="genre" value="{{ old('genre', $mix->genre) }}"
               class="w-full border neon-border rounded p-3"
               style="background:#0F120F; color:#8FBF8A">
        @error('genre')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror

        <label for="bpm" class="block text-sm neon mt-6 mb-2">BPM</label>
        <input type="number" name="bpm" id="bpm" value="{{ old('bpm', $mix->bpm) }}" min="40" max="300"
               class="w-full border neon-border rounded p-3"
               style="background:#0F120F; color:#8FBF8A">
        @error('bpm')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror

        <label for="description" class="block text-sm neon mt-6 mb-2">Description</label>
        <textarea name="description" id="description" rows="4"
                  class="w-full border neon-border rounded p-3"
                  style="background:#0F120F; color:#8FBF8A">{{ old('description', $mix->description) }}</textarea>
        @error('description')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror

                <label for="audio" class="block text-sm neon mt-6 mb-2">Audio file</label>
        @if ($mix->audio_path)
            <p class="text-xs mb-2" style="color:#4A6B48">A file is already attached.</p>
        @endif
        <input type="file" name="audio" id="audio" accept=".mp3,.wav"
               class="w-full text-sm file:mr-3 file:py-2 file:px-3 file:rounded file:border-0 file:bg-neutral-800 file:text-neutral-200">
        <p class="text-xs mt-1" style="color:#4A6B48">Leave empty to keep the current file.</p>
        @error('audio')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror

        <label for="image" class="block text-sm neon mt-6 mb-2">Cover image</label>
        @if ($mix->image_path)
            <img src="{{ asset('storage/' . $mix->image_path) }}" alt=""
                 class="w-32 h-32 object-cover rounded mb-3 border neon-border">
        @endif
        <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.webp"
               class="w-full text-sm file:mr-3 file:py-2 file:px-3 file:rounded file:border-0 file:bg-neutral-800 file:text-neutral-200">
        <p class="text-xs mt-1" style="color:#4A6B48">Leave empty to keep the current image.</p>
        @error('image')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror

        <button type="submit" class="neon-btn mt-8 px-4 py-2 rounded text-sm font-medium">
            Save changes
        </button>
    </form>

</x-public-layout>