<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $data = [];
        $categories = Category::all();

        $data = $categories->transform(function ($item) {
            return [
                'title' => $item->title,
//                'child' => $item->children() : $item->children() ? null,//->transform
                //'parent' => $item->parent_id ? $item->parent->title : null,

            ];
        });

        return Category::all();
    }

    public function store(Request $request)
    {
        $errors = [];
        $errors = array_merge($errors, Validator::make($request->all(), [
            'title' => 'required|string',
        ],[
            'title.required' => 'title is required'
        ])->errors()->jsonSerialize());

        if(!$errors) {
            $data = [
                'title' => $request->title,
                'parent_id' => $request->parent_id
            ];
            if($request->hasFile('image')) {
                $path = $request->file('image')->store('images');
                $image = Image::create(['path' => $path]);
                $data = array_merge($data, ['image_id'=> $image->image_id]);
            }
            $category = Category::create($data);

            return response()->json([
                'status' => 'category created',
                'detail' => $category,
            ]);
        } else {
            return response()->json([
                'error' => $errors,
            ]);
        }
    }
    public function update(Request $request, Category $category)
    {
        $errors = [];
        $errors = array_merge($errors, Validator::make($request->all(), [
            'title' => 'required|string',
        ],[
            'title.required' => 'title is required',
        ])->errors()->jsonSerialize());

        if(!$errors) {
            $data = [
                'title' => $request->title,
                'parent_id' => $request->parent_id
            ];
            if($request->hasFile('image')) {
                $path = $request->file('image')->store('images');
                $image = Image::create(['path' => $path]);
                $data = array_merge($data, ['image_id'=> $image->image_id]);
            }
            $category->update($data);

            return response()->json([
            'status' => 'category updated',
            'detail' => $category
            ]);
        } else {
            return response()->json([
                'error' => $errors,
            ]);
        }
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
        'status' => 'category deleted',
        'detail' => $category,
    ]);
    }
}
