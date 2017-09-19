<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
      $bookmarks = $category->bookmarks()->latest()->Paginate(5);

      return view('category.index', compact('bookmarks'));
    }

    public function store(Request $request)
    {
      $data = request()->validate([
        'name' => 'required|string|unique:categories'
      ]);

      Category::create($data);

      return back();
    }
}
