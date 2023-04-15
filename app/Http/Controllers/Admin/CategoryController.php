<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')->orderBy('order')->orderBy('id', 'desc')->get();
        return view('admin.categories.parent-index', compact('categories'));
    }


    public function show(Category $category)
    {
        $categories = Category::where('parent_id', $category->id)
            ->orderBy('order')->orderBy('id', 'desc')->paginate(15);
        return view('admin.categories.index', compact('category'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if ($request->parent) return $this->storeParent($request);
    }

    public function storeParent(Request $request)
    {
        $category = Category::create($request->validate([
            'title' => 'required|string',
            'order' => 'required|numeric'
        ]));

        return redirect()->back()->with('success', "Category {$category->title} successfully created!");
    }

    public function edit(Category $category)
    {
        abort_if($category->isParent(), 404);
        $parents = Category::getParentCategories();
        return view('admin.categories.form', compact('parents', 'category'));
    }

    public function update(Request $request, Category $category)
    {
        if ($request->parent) return $this->updateParent($request, $category);
    }

    public function updateParent(Request $request, Category $category)
    {
        $category->update($request->validate([
            'title' => 'required|string',
            'order' => 'required|numeric'
        ]));
    }

    public function destroy(Category $category)
    {
        //
    }
}
