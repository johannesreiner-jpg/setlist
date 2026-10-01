<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Mix;
use App\Models\User;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'mixCount' => Mix::count(),
            'djCount' => User::count(),
            'commentCount' => Comment::count(),
            'latestComments' => Comment::with(['user', 'mix'])->latest()->take(3)->get(),
        ]);
    }
}