<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $results = Item::search($request->value)->paginate(15);

        return view('search_results', ['query' => $request->value, 'results' => $results]);
    }

    public function filter(Request $request, $sellTypeFilter = null)
    {
        $sellTypeFilter = $request->sellTypeFilter;
        dd($sellTypeFilter);

//        if ($sellTypeFilter != 'all') {
//            $results = Item::search($request->value)->paginate(15);
//            return view('search_results', ['query' => $request->value, 'results' => $results]);
//        }
//
//        $results = Item::search($request->value)->where('type', $sellTypeFilter)->paginate(15);
//
//        return view('search_results', ['query' => $request->value, 'results' => $results]);
    }
}
