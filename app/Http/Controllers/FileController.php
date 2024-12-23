<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    public function index()
    {
        return File::all();
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
            'category_id' => 'required|string|exists:categories',
            'city_id' => 'required|string|exists:cities,id',
            'title' => 'required|string',
            'address' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'image' => 'required'
        ],[
            'category_id.required' => 'please choose a category',
            'category_id.exists' => 'this category does not exist',
            'city_id.required' => 'please choose a city',
            'city_id.exists' => 'this city does not exist',
            'title.required' => 'title is required',
            'address.required' => 'address is required',
            'location.required' => 'location is required',
            'description.required' => 'description is required',
            'image.required' => 'image is required'
        ])->errors()->jsonSerialize());

        if(!$errors) {
            $data = array_merge($data, [
                'user_id' => $request->user_id,
                'category_id' => $request->category_id,
                'city_id' => $request->city_id,
                'title' => $request->title,
                'address' => $request->address,
                'location' => $request->location,
                'description' => $request->description
            ]);
            $file = File::create($data);

            return response()->json([
            'status' => 'file created',
            'detail' => $file
        ]);
        } else {
            return response()->json([
                'error' => $errors,
            ]);
        }
    }
    public function update(Request $request, File $file)
    {
        $errors = [];
        $data = [];

        if($request->hasFile('image')) {
            $upload = uploadThis($request->file('image'));
            if($upload['success']) $data = array_merge($data, ['image_id'=> $upload['image_id']]);
            else $errors = array_merge($errors, $upload['error']);
        }

        $errors = array_merge($errors, Validator::make($request->all(), [
            'city_id' => 'required|string|exists:cities,id',
            'title' => 'required|string',
            'address' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'image' => 'required'
        ],[
            'city_id.required' => 'please choose a city',
            'city_id.exists' => 'this city does not exist',
            'title.required' => 'title is required',
            'address.required' => 'address is required',
            'location.required' => 'location is required',
            'description.required' => 'description is required',
            'image.required' => 'image is required'
        ])->errors()->jsonSerialize());

        if(!$errors) {
            $data = array_merge($data, [
            'city_id' => $request->city_id,
            'title' => $request->title,
            'address' => $request->address,
            'location' => $request->location,
            'description' => $request->description
        ]);

        $file->update($data);

        return response()->json([
            'status' => 'file updated',
            'detail' => $file
        ]);
        } else {
            return response()->json([
                'error' => $errors,
            ]);
        }
    }

    public function destroy(File $file)
    {
        if($file->delete())
        return response()->json([
            'status' => 'file deleted',
            'detail' => $file
        ]);
        else return 'delete error';
    }
}
