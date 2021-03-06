<?php

namespace App\Http\Controllers\Web;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 

class PageWebController extends Controller
{
    public function index(Request $request) {
        $pageList = Page::query()->paginate(5);
        return view('pageList', ['pageList' => $pageList]);
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, string $slug)
    {
        $page = Page::query()
            ->where('slug', '=', $slug)
            ->first();
        if ($page === null)
            abort(404);
        return view('page', ['page' => $page]);
    }
}
