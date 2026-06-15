<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Game $game)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'game_id' => $game->id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return redirect()->route('games.show', $game)->with('success', 'Komentārs pievienots!');
    }

    public function destroy(Comment $comment)
    {
        $game = $comment->game;

        if (auth()->user()->role !== 'admin' && $comment->user_id !== auth()->id()) {
            return redirect()
                ->route('games.show', $game)
                ->with('error', 'Tev nav atļauts dzēst šo komentāru.');
        }

        $comment->delete();

        return redirect()->route('games.show', $game)->with('success', 'Komentārs dzēsts!');
    }
}