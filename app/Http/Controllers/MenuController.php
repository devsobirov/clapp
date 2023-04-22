<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // List of sub-categories
    public function category(Category $category)
    {
        //dd(request()->is('http://clapp.local/menu/1'), request()->url() == 'http://clapp.local/menu/1');
        abort_if($category->parent_id, 404);
        return view('category', ['parent' => $category]);
    }

    // List of food or drinks for (sub) category
    public function menu(Category $category)
    {
        abort_if(!$category->parent_id, 404);
        $menu = Food::select('id', 'category_id', 'name', 'image', 'announcement')
            ->byCategory($category->id)
            ->paginate(15);

        return view('menu', compact('menu', 'category'));
    }

    // Food or drink item page
    public function menuItem(Food $food)
    {
        return view('menu-item', compact('food'));
    }
}
