<?php

namespace App\Http\Controllers;

use App\Models\Mix;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Mix $mix)
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        $mix->comments()->create([
            'user_id' => $request->user()->id,
            'body'    => $validated['body'],
        ]);

        return back();
    }
}