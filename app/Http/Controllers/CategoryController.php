<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
                'category_id' => $item->category_id,
                'title' => $item->title,
                'parent' => $item->parent ? $item->parent->title : null,
                'parent_id' => $item->parent ? $item->parent->category_id : null,
                'image' => $item->image ? $item->image->path : null,
                'children' => $item->children ? $item->children->transform(function ($child){
                    return [
                        'category_id' => $child->category_id,
                        'title' => $child->title
                    ];
                }) : null,
            ];
        });

        return response()->json($data);
        //return Category::all();
    }

    public function store(Request $request)
    {
        $errors = [];
        $data = [];

        if($request->hasFile('image')) {
            $upload = uploadThis($request->file('image'));
            if($upload['success']) $data = array_merge($data, ['image_id'=> $upload['image_id']]);
            else $errors = array_merge($errors, $upload['error']);
        }

        $errors = array_merge($errors, Validator::make($request->all(), [
            'title' => 'required|string',
        ],[
            'title.required' => 'title is required'
        ])->errors()->jsonSerialize());

        if(!$errors) {
            $data = array_merge($data, [
                'title' => $request->title,
                'parent_id' => $request->parent_id
            ]);

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
        $data = [];

        if($request->hasFile('image')) {
            $upload = uploadThis($request->file('image'));
            if($upload['success']) $data = array_merge($data, ['image_id'=> $upload['image_id']]);
            else $errors = array_merge($errors, $upload['error']);
        }

        $errors = array_merge($errors, Validator::make($request->all(), [
            'title' => 'required|string',
        ],[
            'title.required' => 'title is required',
        ])->errors()->jsonSerialize());

        if(!$errors) {
            $data = array_merge($data, [
                'title' => $request->title,
                'parent_id' => $request->parent_id
            ]);

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
