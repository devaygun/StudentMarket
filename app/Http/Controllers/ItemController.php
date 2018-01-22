<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($category = null)
    {
        if ($category == null)
            return view('items.index', ['items' => Item::with('category')->orderBy('created_at')->paginate(15)]); // View all items in all categories

        $items = Item::whereHas('category', function ($query) use ($category) { // Limiting our results based on whether a relationship to the specific category exists or not
            $query->where('slug', $category);
        })->get();


        return view('items.index', ['items' => $items, 'category' => Category::where('slug', $category)->first()->name]);
    }

    public function createItem(Request $request)
    {
        if ($request->type == "sell") {
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'type' => 'required|string',
                'price' => 'required|integer',
                'trade' => 'nullable|string'
            ]);
        } else if ($request->type == "swap") {
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'type' => 'required|string',
                'price' => 'nullable|integer',
                'trade' => 'required|string'
            ]);
        } else {
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'type' => 'required|string',
                'price' => 'required|integer',
                'trade' => 'required|string'
            ]);
        }

        $item = new Item();
        $item->category_id = $request->category_id;
        $item->user_id = Auth::id();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->type = $request->type;
        $item->price = $request->price;
        $item->trade = $request->trade;
        $item->save();

        if ($request->images)
            $this->storeImages($item, $request->file('images'));


        $authorised = ($item->user_id == Auth::id()) ? true : false; // Checks to see if the item belongs to the authenticated user
        return view('items.read', ['item' => $item, 'category' => null, 'authorised' => $authorised]);
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
        if ($request->type == "sell") {
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'type' => 'required|string',
                'price' => 'required|integer',
                'trade' => 'nullable|string'
            ]);
        } else if ($request->type == "swap") {
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'type' => 'required|string',
                'price' => 'nullable|integer',
                'trade' => 'required|string'
            ]);
        } else {
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'type' => 'required|string',
                'price' => 'required|integer',
                'trade' => 'required|string'
            ]);
        }

        // TODO: Implement sellType logic
        $item = Item::find($id);
        $item->name = $request->input('name');
        $item->description = $request->description;
        $item->category_id = $request->category_id;

        $item->type = $request->type;
        $item->price = $request->price;
        $item->trade = $request->trade;
        if ($request->sold) { // if 'sold' checkbox is checked
            $item->sold = true;
        } else {
            $item->sold = false;
        }
        $item->save();

        if ($request->images)
            $this->storeImages($item, $request->file('images'));

        $category = Category::find($item->category_id)->slug;

        $request->session()->flash('success', 'Successfully updated your item.');
        return $this->readItem($category, $id);
    }

    public function removeItem($id)
    {
        $item = Item::find($id);

        $authorised = ($item->user_id == Auth::id()) ? true : false; // Checks to see if the item belongs to the authenticated user

        // only delete if user is authorised
        if ($authorised) {
            $item->delete();
        }

        return redirect('items');
    }

    public function storeImages($item, $images)
    {
        foreach ($images as $image) {
            $img = new Image();
            $img->item_id = $item->id;
            $img->path = Storage::putFile("/item/{$item->id}", $image);
            $img->save();
        }
    }
}
