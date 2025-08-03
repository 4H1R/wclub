<?php

namespace App\Http\Controllers;

use App\Data\Category\CategoryData;
use App\Data\EventProgram\EventProgramData;
use App\Data\EventProgram\EventProgramFullData;
use App\Data\Faq\FaqData;
use App\Data\TargetGroup\TargetGroupData;
use App\Enums\Faq\FaqStatusEnum;
use App\Http\Middleware\FixSlugMiddleware;
use App\Models\Category;
use App\Models\EventProgram;
use App\Models\Scopes\PublishedScope;
use App\Models\TargetGroup;
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
                AllowedFilter::exact('status'),
                AllowedFilter::callback('categories_id', function (Builder $query, array $ids) {
                    $query->whereHas('categories', fn (Builder $builder) => $builder->whereIn('category_id', $ids));
                }),
                AllowedFilter::callback('target_groups_id', function (Builder $query, array $ids) {
                    $query->whereHas('targetGroups', fn (Builder $builder) => $builder->whereIn('target_group_id', $ids));
                }),
            ], )
            ->defaultSort('-created_at')
            ->allowedSorts(['created_at', 'min_participants', 'max_participants'])
            ->withGlobalScope('published', new PublishedScope)
            ->with(EventProgram::getCardRelations())
            ->paginate(12);

        $categories = Category::query()
            ->where('model', EventProgram::class)
            ->get();

        $targetGroups = TargetGroup::query()
            ->with('image')
            ->get();

        return Inertia::render('eventPrograms/Index', [
            'event_programs' => EventProgramData::collect($eventPrograms, PaginatedDataCollection::class),
            'categories' => CategoryData::collect($categories),
            'target_groups' => TargetGroupData::collect($targetGroups),
        ]);
    }

    public function show(EventProgram $eventProgram): \Inertia\Response
    {
        abort_unless($eventProgram->published_at, 404);

        $eventProgram->load(EventProgram::getCardRelations());

        $recommendedEventPrograms = EventProgram::query()
            ->with(EventProgram::getCardRelations())
            ->withGlobalScope('published', new PublishedScope)
            ->where('id', '!=', $eventProgram->id)
            ->take(6)
            ->get();

        $faqs = $eventProgram->faqs()
            ->where('status', FaqStatusEnum::Approved)
            ->latest('id')
            ->limit(20)
            ->get();

        return Inertia::render('eventPrograms/Show', [
            'event_program' => EventProgramFullData::from($eventProgram),
            'faqs' => FaqData::collect($faqs),
            'recommended_event_programs' => EventProgramData::collect($recommendedEventPrograms),
        ]);
    }
}
