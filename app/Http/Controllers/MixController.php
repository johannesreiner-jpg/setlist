<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mix;

class MixController extends Controller
{
    public function index()
    {
        $mixes = Mix::latest()->get();

        return view('mixes.index', compact('mixes'));
    }

    public function userIndex(Request $request)
    {
        $mixes = $request->user()->mixes()->latest()->get();

        return view('user.mixes.index', compact('mixes'));
    }

    public function show(Mix $mix)
    {
        return view('mixes.show', compact('mix'));
    }

    public function create()
    {
        return view('user.mixes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'genre' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:2000'],
            'audio' => ['nullable', 'file', 'mimes:mp3,wav', 'max:204800'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        if ($request->hasFile('audio')) {
            $validated['audio_path'] = $request->file('audio')->store('mixes', 'public');
        }

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('covers', 'public');
        }

        unset($validated['audio'], $validated['image']);

        $mix = $request->user()->mixes()->create($validated);

        return redirect()->route('mixes.show', $mix);
    }

    public function edit(Mix $mix)
    {
        $this->authorize('update', $mix);

        return view('user.mixes.edit', compact('mix'));
    }

    public function update(Request $request, Mix $mix)
    {
        $this->authorize('update', $mix);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'genre' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:2000'],
            'audio' => ['nullable', 'file', 'mimes:mp3,wav', 'max:204800'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        if ($request->hasFile('audio')) {
            $validated['audio_path'] = $request->file('audio')->store('mixes', 'public');
        }

        unset($validated['audio'], $validated['image']);

        $mix->update($validated);

        return redirect()->route('mixes.show', $mix);
    }

    public function destroy(Mix $mix)
    {
        $this->authorize('delete', $mix);

        $mix->delete();

        return redirect()->route('user.mixes.index');
    }
}