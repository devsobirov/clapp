<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Field;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index(Request $request)
    {
        $food = Food::select(['id', 'category_id', 'name', 'image', 'announcement', 'created_at'])
            ->byCategory($request->category_id)->search($request->search)
            ->with('category:id,title')->orderBy('id', 'desc')
            ->paginate(15)->withQueryString();

        return view('admin.food.index', compact('food'));
    }

    public function category(Request $request, Category $category)
    {
        $food = Food::select(['id', 'category_id', 'name', 'image', 'announcement', 'created_at'])
            ->byCategory($category->id)->search($request->search)
            ->with('category:id,title')->orderBy('id', 'desc')
            ->paginate(15)->withQueryString();

        return view('admin.food.category', compact('food', 'category'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'announcement' => 'required|string|max:255',
            'category_id' => 'required|numeric',
            'image' => 'required|image|max:1024',
        ]);

        if (!empty($data['image'])) {
            $data['image'] = ImageHelper::save(
                $request->file('image'),
                '/assets/img/food-' . $request->category_id
            );
        }

        $food = Food::create($data);
        return redirect()->back()->with('success', $food->name . ' successfully created!');
    }

    public function update(Request $request, Food $food)
    {
        if ($request->general == 'general') {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'announcement' => 'required|string|max:255',
                'category_id' => 'required|numeric',
                'image' => 'nullable|image|max:1024',
                'instruction' => 'nullable|string',
                'addinitional' => 'nullable|string'
            ]);

            if (!empty($data['image'])) {
                $data['image'] = ImageHelper::save(
                    $request->file('image'),
                    '/assets/img/food-' . $request->category_id
                );
            }

            $food->update($data);
            return redirect()->back()->with('success', 'Genereal data successfully updated');
        }

        if ($request->fields === 'fields') {
            $fields = [];
            foreach ($request->input() as $id => $value) {
                if (is_numeric($id)) {
                    $fields[$id] = ['value' => $value];
                }
            }
            $food->fields()->sync($fields);
            return redirect(route('admin.food.edit', ['food' => $food->id, 'extra' => 1]))
                ->with('success', 'Extra fields successfully updated');
        }

        abort(404);
    }

    public function edit(Food $food)
    {
        $fields = Field::whereNotIn('id', $food->fields->pluck('id'))->orderBy('name')->get();
        return view('admin.food.edit', compact('food', 'fields'));
    }
}
