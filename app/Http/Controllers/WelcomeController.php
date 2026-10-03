<?php

namespace App\Http\Controllers;

use App\Models\Mix;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return view('welcome', [
            'latestMixes' => Mix::with('user')->latest()->take(3)->get(),

            'genres' => Mix::whereNotNull('genre')
                ->where('genre', '!=', '')
                ->distinct()
                ->orderBy('genre')
                ->pluck('genre'),

            'myMixCount' => $user ? $user->mixes()->count() : 0,
            'myCommentCount' => $user ? $user->receivedComments()->count() : 0,

            'commentsOnMyMixes' => $user
                ? $user->receivedComments()
                    ->with(['user', 'mix'])
                    ->latest('comments.created_at')
                    ->take(3)
                    ->get()
                : collect(),
        ]);
    }
}