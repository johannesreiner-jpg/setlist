<x-public-layout title="New set">

    <a href="{{ route('mixes.index') }}" class="text-sm text-neutral-500 hover:text-neutral-300">
        &larr; All sets
    </a>

    <h1 class="text-3xl font-semibold text-white mt-4 mb-8">New set</h1>

    <form method="POST" action="{{ route('user.mixes.store') }}" enctype="multipart/form-data" class="max-w-xl">
        @csrf

        <label for="title" class="block text-sm text-neutral-400 mb-2">Title</label>

        <input type="text" name="title" id="title" value="{{ old('title') }}"
               class="w-full bg-neutral-900 border border-neutral-700 rounded p-3 text-neutral-200">

        @error('title')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror

        <label for="audio" class="block text-sm text-neutral-400 mt-6 mb-2">Audio file</label>

        <input type="file" name="audio" id="audio" accept=".mp3,.wav"
               class="w-full text-sm text-neutral-400 file:mr-3 file:py-2 file:px-3 file:rounded file:border-0 file:bg-neutral-800 file:text-neutral-200">

        @error('audio')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror

        <button type="submit" class="mt-4 px-4 py-2 bg-neutral-200 text-neutral-900 rounded text-sm font-medium">
            Create set
        </button>
    </form>

</x-public-layout>