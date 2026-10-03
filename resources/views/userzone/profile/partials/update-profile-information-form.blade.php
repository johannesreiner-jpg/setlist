<section>
    <h2 class="text-lg font-semibold neon mb-1">Profile information</h2>
    <p class="text-sm mb-6" style="color:#4A6B48">Update your name and email address.</p>

    @if (session('status') === 'profile-updated')
        <p class="text-sm neon mb-4">Saved.</p>
    @endif

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm neon mb-2">Name</label>
            <input id="name" name="name" type="text" required autocomplete="name"
                   value="{{ old('name', $user->name) }}"
                   class="w-full border neon-border rounded p-3"
                   style="background:#0F120F; color:#8FBF8A">
            @error('name')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm neon mb-2">Email</label>
            <input id="email" name="email" type="email" required autocomplete="username"
                   value="{{ old('email', $user->email) }}"
                   class="w-full border neon-border rounded p-3"
                   style="background:#0F120F; color:#8FBF8A">
            @error('email')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="neon-btn px-4 py-2 rounded text-sm font-medium">Save</button>
    </form>
</section>