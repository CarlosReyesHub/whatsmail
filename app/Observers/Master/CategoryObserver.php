<?php

namespace App\Observers\Master;

use App\Models\Master\Category;
use Illuminate\Http\Request;

class CategoryObserver
{
    public function getData(Request $request)
    {
        return Category::where(function ($q) use ($request) {
            return $request->name ? $q->where('name', 'like', '%' . $request->name . '%') : '';
        });
    }

    public function createData(Request $request)
    {
        return Category::create([
            'name'      => $request->name
        ]);
    }

    public function updateData(Request $request, Category $category)
    {
        $category->update([
            'name'      => $request->name
        ]);
    }

    public function deleteData(Category $category)
    {
        $category->delete();
    }
}
