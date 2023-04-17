<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function index()
    {
        $fields = Field::select(['id', 'name', 'type', 'description'])
            ->withCount('food')
            ->paginate(20);

        return view('admin.fields.index', compact('fields'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|numeric',
            'description' => 'nullable|max:255'
        ]);

        $field = Field::getOrNew($request->id);
        $field->name = $request->name;
        $field->type = $request->type;
        $field->description = $request->description;
        $field->save();

        return redirect()->back()->with('success', 'Successfully saved!');
    }
}
