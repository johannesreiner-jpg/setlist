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
            'audio' => ['nullable', 'file', 'mimes:mp3,wav', 'max:51200'],
        ]);

        if ($request->hasFile('audio')) {
            $validated['audio_path'] = $request->file('audio')->store('mixes', 'public');
        }

        unset($validated['audio']);

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
        ]);

        $mix->update($validated);

        return redirect()->route('mixes.show', $mix);
    }

    public function destroy(Mix $mix)
    {
        $this->authorize('delete', $mix);

        $mix->delete();

        return redirect()->route('mixes.index');
    }
}