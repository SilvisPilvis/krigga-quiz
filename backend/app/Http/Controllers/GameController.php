<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    function create(Request $request)
    {
        $game = new Game();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        // $game->fill($request->all());
        $game->name = $validated['name'];
        if ($game->save()) {
            return response()->json(['message' => 'Game created successfully'], 201);
        } else {
            return response()->json(['message' => 'Error creating game'], 500);
        }
    }

    function index(Request $request)
    {
        $games = Game::all();
        return response()->json($games);
    }

    function show(Request $request)
    {
        $game = Game::find($request->id);
        if ($game) {
            return response()->json($game);
        } else {
            return response()->json(['message' => 'Game not found'], 404);
        }
    }
}
