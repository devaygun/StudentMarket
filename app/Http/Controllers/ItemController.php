<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index($category = null)
    {
        if ($category == null)
            return view('categories.index', ['categories' => Category::all()]);

        $items = Item::with('category')->get();


        return view('items.index', ['items' => $items, 'category' => $category]);
    }
}
