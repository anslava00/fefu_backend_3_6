<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsWebController extends Controller
{
    public function index(Request $request) {
        $news_list = News::query()->published()->paginate(5);
        return view('news_list', ['news_list' => $news_list]);
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
        ->where('slug', '=', $slug)
        ->first();
        if ($news === null)
            abort(404);
        return view('news', ['news' => $news]);
    }
}
