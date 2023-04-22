<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return view('admin.categories.index', compact('category', 'categories'));
    }

    public function store(Request $request)
    {
        if ($request->parent) return $this->storeParent($request);

        $category = Category::create($this->getValidData($request));
        return redirect()->back()->with('success', $category->title . " successfully created!");
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

        $category->update($this->getValidData($request));
        return redirect()->route('admin.categories.show', $category->parent_id);
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

    private function getValidData(Request $request): array
    {
        $data = $request->validate([
            'title' => 'required|string',
            'order' => 'required|numeric',
            'parent_id' => 'required|numeric',
            'image' => 'nullable|image|max:1024'
        ]);

        if (isset($data['image'])) {
            $dir = '/assets/img/category-' . $request->parent_id;
            $name = Str::random(6) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path($dir), $name)->getPathname();
            $data['image'] = $dir . '/' . $name;
        }

        return $data;
    }

}
