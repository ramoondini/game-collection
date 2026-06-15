<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function index()
    {
        $query = Game::with(['genre', 'user']);

        if (request('search')) {
            $query->where('title', 'like', '%' . request('search') . '%');
        }

        $games = $query->latest()->get();

        return view('games.index', compact('games'));
    }

    public function create()
    {
        $genres = Genre::all();

        return view('games.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'genre_id' => 'required|exists:genres,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'nullable|integer|min:1950|max:2100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status' => 'required|in:velos_spelet,iesakta,pabeigta,atcelta',
        ]);

        $data = $request->only([
            'genre_id',
            'title',
            'description',
            'year',
            'status',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('games', 'public');
        }

        $data['user_id'] = auth()->id();

        Game::create($data);

        return redirect()
            ->route('games.index')
            ->with('success', 'Spēle pievienota!');
    }

    public function show(Game $game)
    {
        $game->load(['genre', 'comments.user', 'ratings']);

        return view('games.show', compact('game'));
    }

    public function edit(Game $game)
    {
        if (auth()->user()->role !== 'admin' && $game->user_id !== auth()->id()) {
            return redirect()
                ->route('games.index')
                ->with('error', 'Tev nav atļauts rediģēt šo spēli.');
        }

        $genres = Genre::all();

        return view('games.edit', compact('game', 'genres'));
    }

    public function update(Request $request, Game $game)
    {
        if (auth()->user()->role !== 'admin' && $game->user_id !== auth()->id()) {
            return redirect()
                ->route('games.index')
                ->with('error', 'Tev nav atļauts atjaunot šo spēli.');
        }

        $request->validate([
            'genre_id' => 'required|exists:genres,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'nullable|integer|min:1950|max:2100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'status' => 'required|in:velos_spelet,iesakta,pabeigta,atcelta',
        ]);

        $data = $request->only([
            'genre_id',
            'title',
            'description',
            'year',
            'status',
        ]);

        if ($request->hasFile('image')) {
            if ($game->image) {
                Storage::disk('public')->delete($game->image);
            }

            $data['image'] = $request->file('image')->store('games', 'public');
        }

        $game->update($data);

        return redirect()
            ->route('games.index')
            ->with('success', 'Spēle atjaunota!');
    }

    public function destroy(Game $game)
    {
        if (auth()->user()->role !== 'admin' && $game->user_id !== auth()->id()) {
            return redirect()
                ->route('games.index')
                ->with('error', 'Tev nav atļauts dzēst šo spēli.');
        }

        if ($game->image) {
            Storage::disk('public')->delete($game->image);
        }

        $game->delete();

        return redirect()
            ->route('games.index')
            ->with('success', 'Spēle dzēsta!');
    }
}