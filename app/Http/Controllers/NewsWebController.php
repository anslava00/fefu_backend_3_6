<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsWebController extends Controller
{
    public function index(Request $request) {
        $NewsList = News::query()->published()->paginate(5);
        return view('NewsList', ['NewsList' => $NewsList]);
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, string $slug)
    {
        $news = News::query()
        ->published()->where('slug', '=', $slug)->first();
        if ($news === null)
            abort(404);
        return view('news', ['news' => $news]);
    }
}
