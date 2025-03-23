<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class FixSlugMiddleware
{
    private function makePersianSlug(string $string, string $separator = '-'): string
    {
        $string = trim($string);
        $string = mb_strtolower($string, 'UTF-8');
        $string = preg_replace("/[^a-z0-9_\-\sءاآؤئبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوهی]/u", '', $string);
        $string = preg_replace("/[\s\-_]+/", ' ', $string);
        $string = preg_replace("/[\s_]/", $separator, $string);

        return $string;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $modelName = array_key_first($request->route()->originalParameters());
        $currentSlug = $request->route()->originalParameter($modelName);
        $model = $request->route($modelName);
        $slug = $this->makePersianSlug("{$model->title}-{$model->id}");

        if ($currentSlug !== $slug) {
            return redirect()->to(Str::replace($currentSlug, $slug, urldecode($request->url())));
        }

        return $next($request);
    }
}
