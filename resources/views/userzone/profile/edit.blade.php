<x-public-layout title="Account settings">

    <h1 class="text-3xl font-semibold neon mb-8">Account settings</h1>

    <div class="space-y-8 max-w-xl">
        <div class="border neon-border rounded p-6">
            @include('userzone.profile.partials.update-profile-information-form')
        </div>

        <div class="border neon-border rounded p-6">
            @include('userzone.profile.partials.update-password-form')
        </div>

        <div class="border border-red-900 rounded p-6">
            @include('userzone.profile.partials.delete-user-form')
        </div>
    </div>

</x-public-layout>