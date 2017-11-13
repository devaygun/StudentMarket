<?php

namespace App\Http\Controllers;

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
            return view('categories.index');

        return view('items.index', []);
    }
}
