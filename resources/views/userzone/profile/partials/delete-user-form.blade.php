<section>
    <h2 class="text-lg font-semibold text-red-400 mb-1">Delete account</h2>
    <p class="text-sm mb-6" style="color:#4A6B48">
        Once your account is deleted, all of its sets and comments are removed
        permanently. This cannot be undone.
    </p>

    <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4"
          onsubmit="return confirm('Delete your account permanently?')">
        @csrf
        @method('delete')

        <div>
            <label for="delete_password" class="block text-sm mb-2" style="color:#4A6B48">
                Confirm with your password
            </label>
            <input id="delete_password" name="password" type="password"
                   class="w-full border border-red-900 rounded p-3"
                   style="background:#0F120F; color:#8FBF8A">
            @error('password', 'userDeletion')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 border border-red-900 rounded text-sm text-red-400">
            Delete account
        </button>
    </form>
</section>