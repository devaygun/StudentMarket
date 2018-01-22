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
        $results = Item::search($request->value)->paginate(1);

        return view('search_results', ['query' => $request->value, 'results' => $results]);
    }
}
