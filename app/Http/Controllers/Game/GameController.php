<?php

namespace App\Http\Controllers\Game;

use App\Data\Game\GameData;
use App\Data\Media\ImageData;
use App\Http\Controllers\Controller;
use App\Models\Game;
use Inertia\Inertia;

class GameController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('games/Index', [
            'games' => GameData::collect(Game::all()->map(fn ($game) => [
                ...$game->toArray(),
                'image' => (new ImageData(1, $game->image))->toArray(),
            ])),
        ]);
    }
}
