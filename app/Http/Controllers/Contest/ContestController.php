<?php

namespace App\Http\Controllers\Contest;

use App\Data\Category\CategoryData;
use App\Data\Contest\ContestData;
use App\Data\Contest\ContestFullData;
use App\Http\Controllers\Controller;
use App\Http\Middleware\FixSlugMiddleware;
use App\Models\Category;
use App\Models\Contest;
use App\Models\ContestUserRegistration;
use App\Models\QuestionFormAnswer;
use App\Models\Scopes\PublishedScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ContestController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(FixSlugMiddleware::class, only: ['show']),
        ];
    }

    public function index(): \Inertia\Response
    {
        $news = QueryBuilder::for(Contest::class)
            ->allowedFilters([
                AllowedFilter::scope('query'),
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
            ->with(Contest::getCardRelations())
            ->paginate(12);

        $categories = Category::query()
            ->where('model', Contest::class)
            ->get();

        return Inertia::render('contests/Index', [
            'contests' => ContestData::collect($news, PaginatedDataCollection::class),
            'categories' => CategoryData::collect($categories),
        ]);
    }

    public function show(Contest $contest): \Inertia\Response
    {
        abort_unless($contest->published_at, 404);

        $contest->load(Contest::getCardRelations());
        $registration = null;

        if (Auth::check()) {
            $registration = ContestUserRegistration::where('contest_id', $contest->id)->where('user_id', Auth::id())->first();
        }

        $contest->has_registered = (bool) $registration;
        $contest->question_form_id = $contest->has_registered ? $contest->questionForm?->id : null;
        $contest->has_uploaded_image = false;

        if (Auth::check() && $contest->question_form_id) {
            $contest->question_form_answered = (bool) QuestionFormAnswer::where('question_form_id', $contest->question_form_id)->where('user_id', Auth::id())->exists();
        }

        if (Auth::check()) {
            $contest->has_uploaded_image = (bool) $registration?->image?->exists();
        }

        $recommendedContests = Contest::query()
            ->with(Contest::getCardRelations())
            ->withGlobalScope('published', new PublishedScope)
            ->where('id', '!=', $contest->id)
            ->take(6)
            ->get();

        return Inertia::render('contests/Show', [
            'contest' => ContestFullData::from($contest),
            'recommended_contests' => ContestData::collect($recommendedContests),
        ]);
    }

    public function uploadImage(Request $request, Contest $contest): RedirectResponse
    {
        $request->validate([
            'image' => ['required',  Rule::file()->image()->max(1024)],
        ]);

        $registration = ContestUserRegistration::where('contest_id', $contest->id)->where('user_id', Auth::id())->firstOrFail();

        $registration->addMediaFromRequest('image')->toMediaCollection('image');

        return back();
    }
}
