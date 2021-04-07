<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();

        return response()->json([
            'success' => true,
            'data' => $games
        ]);
    }

    public function show($id)
    {
        $game = Game::all()->find($id);

        if (!$game) {
            return response()->json([
                'success' => false,
                'message' => 'Game not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $game->toArray()
        ]);
    }
}
