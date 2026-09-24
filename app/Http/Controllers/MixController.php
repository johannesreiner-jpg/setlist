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
}