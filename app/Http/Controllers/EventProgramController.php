<?php

namespace App\Http\Controllers;

use App\Data\Category\CategoryData;
use App\Data\EventProgram\EventProgramData;
use App\Data\EventProgram\EventProgramFullData;
use App\Http\Middleware\FixSlugMiddleware;
use App\Models\Category;
use App\Models\EventProgram;
use App\Models\Scopes\PublishedScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EventProgramController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(FixSlugMiddleware::class, only: ['show']),
        ];
    }

    public function index(): \Inertia\Response
    {
        $eventPrograms = QueryBuilder::for(EventProgram::class)
            ->allowedFilters([
                AllowedFilter::scope('query'),
                AllowedFilter::callback('categories_id', function (Builder $query, array $ids) {
                    $query->whereHas('categories', fn (Builder $builder) => $builder->whereIn('category_id', $ids));
                }),
            ], )
            ->defaultSort('-created_at')
            ->allowedSorts(['created_at', 'min_participants', 'max_participants'])
            ->withGlobalScope('published', new PublishedScope)
            ->with(['image', 'categories'])
            ->paginate(12);

        $categories = Category::query()
            ->where('model', EventProgram::class)
            ->get();

        return Inertia::render('eventPrograms/Index', [
            'event_programs' => EventProgramData::collect($eventPrograms, PaginatedDataCollection::class),
            'categories' => CategoryData::collect($categories),
        ]);
    }

    public function show(EventProgram $eventProgram): \Inertia\Response
    {
        abort_unless($eventProgram->published_at, 404);

        $eventProgram->load(['categories', 'image']);

        $recommendedEventPrograms = EventProgram::query()
            ->with(['categories', 'image'])
            ->withGlobalScope('published', new PublishedScope)
            ->where('id', '!=', $eventProgram->id)
            ->take(6)
            ->get();

        return Inertia::render('eventPrograms/Show', [
            'event_program' => EventProgramFullData::from($eventProgram),
            'recommended_event_programs' => EventProgramData::collect($recommendedEventPrograms),
        ]);
    }
}
