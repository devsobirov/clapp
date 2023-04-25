<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $items  = Food::select('id', 'category_id', 'name', 'image')
            ->byCategory($request->s_category)->search($request->g_search)
            ->with('category:id,title')->get();

        return view('search-results', compact('items'));
    }
}
