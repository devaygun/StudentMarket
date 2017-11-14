<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($category = null)
    {
        if ($category == null)
            return view('categories.index', ['categories' => Category::all()]);

        $items = Item::whereHas('category', function ($query) use ($category) { // Limiting our results based on whether a relationship to the specific category exists or not
            $query->where('slug', $category);
        })->get();


        return view('items.index', ['items' => $items, 'category' => Category::where('slug', $category)->first()->name]);
    }

    public function createItem()
    {

    }

    public function readItem($category = null, $id = null)
    {
        $item = Item::with('category')->find($id);
        $authorised = ($item->user_id == Auth::id()) ? true : false; // Checks to see if the item belongs to the authenticated user

        return view('items.read', ['item' => $item, 'authorised' => $authorised]);
    }

    public function updateItem($id = null)
    {

    }

    public function deleteItem($id)
    {

    }
}
