<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $page_title = 'Categories';
        $empty_message = 'No Result Found';
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('page_title', 'categories', 'empty_message'));
    }

    public function store()
    {
        \request()->validate([
            'name' => 'required|string|max:70|unique:categories,name'
        ]);

        $category = new Category();
        $category->name = \request()->name;
        $category->save();

        $notify[] = ['success', 'Category added!'];
        return back()->withNotify($notify);
    }

    public function update($id)
    {
        \request()->validate([
            'name' => 'required|string|max:70|unique:categories,name,' . $id
        ]);

        $category = Category::findOrFail($id);
        $category->name = \request()->name;
        $category->save();

        $notify[] = ['success', 'Category updated!'];
        return back()->withNotify($notify);
    }

    public function status($id)
    {
        $cat = Category::findOrFail($id);
        $cat->status = ($cat->status ? 0 : 1);
        $cat->save();

        $notify[] = ['success', 'Status updated!'];
        return back()->withNotify($notify);
    }
}
