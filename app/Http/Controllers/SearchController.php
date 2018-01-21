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
        dump(Item::search('Kitten')->get());

        // Display search logo/icon
        Item::find(5)->save();

        $search = Item::search($string)->get();
        dump($string);
        dd($search);
    }
}
