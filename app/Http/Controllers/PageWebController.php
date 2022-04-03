<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageWebController extends Controller
{
    public function index(Request $request) {
        $page_list = Page::query()->paginate(5);
        return view('page_list', ['page_list' => $page_list]);
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
