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

    public function index($string)
    {
        $search = Item::search($string)->get();
        dump($string);
        dd($search);
    }
}
