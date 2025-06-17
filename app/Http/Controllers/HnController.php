<?php

namespace App\Http\Controllers;

use App\Data\Hn\HnImageData;
use App\Models\HnImage;
use App\Models\Scopes\PublishedScope;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;

class HnController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('hn/Index');
    }

    public function start(): \Inertia\Response|RedirectResponse
    {
        $data = HnImage::query()
            ->with('image')
            ->whereHas('image')
            ->withGlobalScope('published', new PublishedScope)
            ->simplePaginate(20);

        if ($data->isEmpty() && $data->currentPage() !== 1) {
            return redirect('/hn/start');
        }

        return Inertia::render('hn/Start', [
            'data' => Inertia::deepMerge(HnImageData::collect($data, PaginatedDataCollection::class)),
        ]);
    }
}
