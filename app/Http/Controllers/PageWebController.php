<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageWebController extends Controller
{
    public function index(Request $request) {
        $PageList = Page::query()->paginate(5);
        return view('PageList', ['PageList' => $PageList]);
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
