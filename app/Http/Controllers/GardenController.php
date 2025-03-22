<?php

namespace App\Http\Controllers;

use App\Data\Garden\GardenData;
use App\Data\Garden\GardenFullData;
use App\Models\Garden;
use App\Models\Scopes\PublishedScope;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GardenController extends Controller
{
    public function index(): \Inertia\Response
    {
        $gardens = QueryBuilder::for(Garden::class)
            ->allowedFilters([AllowedFilter::scope('query')])
            ->allowedSorts(['created_at', 'max_participants'])
            ->withGlobalScope('published', new PublishedScope)
            ->with('image')
            ->paginate(12);

        return Inertia::render('gardens/Index', [
            'gardens' => GardenData::collect($gardens, PaginatedDataCollection::class),
        ]);
    }

    public function show(Garden $garden): \Inertia\Response
    {
        abort_unless($garden->published_at, 404);

        $garden->load('images');

        $recommendedGardens = Garden::query()
            ->with('image')
            ->withGlobalScope('published', new PublishedScope)
            ->where('id', '!=', $garden->id)
            ->take(6)
            ->get();

        return Inertia::render('gardens/Show', [
            'garden' => GardenFullData::from($garden),
            'recommended_gardens' => GardenData::collect($recommendedGardens),
        ]);
    }
}
