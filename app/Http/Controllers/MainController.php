<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Cache;

class MainController extends Controller
{
    public function __invoke()
    {
        $articles = Cache::remember('articles', 60*60*24, function () {
            return Article::query()
                ->with('category')
                ->latest('created_at')
                ->limit(6)
                ->get();
        });

        return view('welcome', compact('articles'));
    }
}
