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
            return view('items.index', ['items' => Item::with('category')->orderBy('created_at')->get()]); // View all items in all categories

        $items = Item::whereHas('category', function ($query) use ($category) { // Limiting our results based on whether a relationship to the specific category exists or not
            $query->where('slug', $category);
        })->get();


        return view('items.index', ['items' => $items, 'category' => Category::where('slug', $category)->first()->name]);
    }

    public function createItem(Request $request)
    {
//        $request->validate([
//            'category_id' => 'required|integer|exists:category,id',
//            'name' => 'required|string|max:255',
//            'description' => 'required|string|max:255',
//            'type' => 'required',
//            'price' => 'integer',
//            'trade' => 'string'
//        ]);
        $category = $request->input('category');

        $item = new Item();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->type = $request->type;
        $item->price = $request->price;
        $item->trade = $request->trade;
        $item->category_id = Category::where('slug', $category)->first()->id;
        $item->save();

        return view('items.read', ['item' => $item, 'category' => null]);
        dd('hit');
    }

    public function readItem($category = null, $id = null)
    {
        if ($category == "update")
           return $this->editItem($id);
        if ($category == "sold")
            return $this->soldItem($id);

        $item = Item::with('category', 'images', 'user')->find($id);
        $category = $category ?: $item->category->slug; // If the category is not passed through then retrieve it from the item
        $authorised = ($item->user_id == Auth::id()) ? true : false; // Checks to see if the item belongs to the authenticated user

        return view('items.read', ['item' => $item, 'category' => $category, 'authorised' => $authorised]);

    }

    public function editItem($id = null)
    {
        $item = Item::find($id);
        $authorised = ($item->user_id == Auth::id()) ? true : false; // Checks to see if the item belongs to the authenticated user

        return view('items.update', ['item' => $item, 'authorised' => $authorised]);
    }

    public function updateItem(Request $request, $id = null)
    {
        $category = $request->input('category');

        $item = Item::find($id);
        $item->name = $request->input('name');
        $item->description = $request->description;
        // TODO: Implement sellType logic
        $item->type = $request->input('sellType');
        $item->price = $request->input('price');
        $item->trade = $request->input('swap');
        $item->category_id = Category::where('slug', $category)->first()->id;
        if ($request->input('sold')) { // if 'sold' checkbox is checked
            $item->sold = true;
        } else {
            $item->sold = false;
        }

        $item->save();

        $request->session()->flash('success', 'Successfully updated your item.');
        return $this->readItem($category, $id);
    }

    public function removeItem($id)
    {
        $item = Item::find($id);
        $item->delete();
        return redirect('items');
    }
}
