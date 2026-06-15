<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Game;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        $users = User::withCount('games')
            ->has('games')
            ->orderBy('name')
            ->get();

        return view('collections.index', compact('users'));
    }

    public function show(User $user)
    {
        $query = Game::with('genre')
            ->where('user_id', $user->id);

        if (request('search')) {
            $query->where('title', 'like', '%' . request('search') . '%');
        }

        $games = $query->latest()->get();

        return view('collections.show', compact('user', 'games'));
    }
}