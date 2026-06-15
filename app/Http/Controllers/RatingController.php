<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Game $game)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $user = auth()->user();

        Rating::updateOrCreate(
            [
                'game_id' => $game->id,
                'user_id' => $user->id,
            ],
            [
                'rating' => $request->rating,
            ]
        );

        return redirect()
            ->route('games.show', $game)
            ->with('success', 'Vērtējums pievienots!');
    }
}