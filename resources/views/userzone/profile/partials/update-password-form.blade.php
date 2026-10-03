<section>
    <h2 class="text-lg font-semibold neon mb-1">Update password</h2>
    <p class="text-sm mb-6" style="color:#4A6B48">Use a long, random password to stay secure.</p>

    @if (session('status') === 'password-updated')
        <p class="text-sm neon mb-4">Saved.</p>
    @endif

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="current_password" class="block text-sm neon mb-2">Current password</label>
            <input id="current_password" name="current_password" type="password" autocomplete="current-password"
                   class="w-full border neon-border rounded p-3"
                   style="background:#0F120F; color:#8FBF8A">
            @error('current_password', 'updatePassword')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm neon mb-2">New password</label>
            <input id="password" name="password" type="password" autocomplete="new-password"
                   class="w-full border neon-border rounded p-3"
                   style="background:#0F120F; color:#8FBF8A">
            @error('password', 'updatePassword')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm neon mb-2">Confirm password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                   class="w-full border neon-border rounded p-3"
                   style="background:#0F120F; color:#8FBF8A">
        </div>

        <button type="submit" class="neon-btn px-4 py-2 rounded text-sm font-medium">Save</button>
    </form>
</section>