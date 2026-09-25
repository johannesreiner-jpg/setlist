<x-public-layout title="Edit set">

    <a href="{{ route('mixes.show', $mix) }}" class="text-sm text-neutral-500 hover:text-neutral-300">
        &larr; Back to set
    </a>

    <h1 class="text-3xl font-semibold text-white mt-4 mb-8">Edit set</h1>

    <form method="POST" action="{{ route('user.mixes.update', $mix) }}" class="max-w-xl">
        @csrf
        @method('PATCH')

        <label for="title" class="block text-sm text-neutral-400 mb-2">Title</label>

        <input type="text" name="title" id="title" value="{{ old('title', $mix->title) }}"
               class="w-full bg-neutral-900 border border-neutral-700 rounded p-3 text-neutral-200">

        @error('title')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror

        <button type="submit" class="mt-4 px-4 py-2 bg-neutral-200 text-neutral-900 rounded text-sm font-medium">
            Save changes
        </button>
    </form>

</x-public-layout>