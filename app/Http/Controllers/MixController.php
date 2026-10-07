<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Mix;

class MixController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');

        $mixes = Mix::with('user')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('genre', 'like', "%{$search}%")
                      ->orWhereHas('user', function ($u) use ($search) {
                          $u->where('name', 'like', "%{$search}%");
                      });
                });
            })
            ->latest()
            ->get();

        return view('mixes.all-sets', compact('mixes', 'search'));
    }

    public function userIndex(Request $request)
    {
        $search = $request->query('q');

        $mixes = $request->user()->mixes()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('genre', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        return view('user.mixes.my-sets', compact('mixes', 'search'));
    }

    public function show(Mix $mix)
    {
        return view('mixes.show', compact('mix'));
    }

    public function create()
    {
        return view('user.mixes.create', ['genres' => Mix::GENRES]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'genre' => ['required', Rule::in(Mix::GENRES)],
            'bpm' => ['required', 'integer', 'min:40', 'max:300'],
            'description' => ['nullable', 'string', 'max:2000'],
            'audio' => ['required', 'file', 'mimes:mp3,wav', 'max:204800'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
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

        return view('user.mixes.edit', [
            'mix' => $mix,
            'genres' => Mix::GENRES,
        ]);
    }

    public function update(Request $request, Mix $mix)
    {
        $this->authorize('update', $mix);

            $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'genre' => ['required', Rule::in(Mix::GENRES)],
            'bpm' => ['required', 'integer', 'min:40', 'max:300'],
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