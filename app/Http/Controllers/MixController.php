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
        ]);

        $mix = $request->user()->mixes()->create($validated);

        return redirect()->route('mixes.show', $mix);
    }
}