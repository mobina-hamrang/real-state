<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeatureController extends Controller
{
    public function index()
    {
        return Feature::all();
    }

    public function store(Request $request)
    {
        $errors = [];
        $errors = array_merge($errors, Validator::make($request->all(), [
            'title' => 'required|string',
            'type' => 'required|in:static,dynamic',
        ],[
            'title.required' => 'title is required',
            'type.required' => 'value is required',
            'type.in' => 'type must be static or dynamic'
        ])->after(function ($validator) use ($request){
            if ($request->type === 'static' && empty($request->value)) {
                $validator->errors()->add('value', 'value is required when type is static');
            }
        })->errors()->jsonSerialize());

        if(!$errors) {
        $feature = Feature::updateOrCreate([
            'title' => $request->title,
            'type' => $request->type,
            'value' => $request->value
        ]);

        return response()->json([
            'status' => 'feature created',
            'detail' => $feature,
        ]);
    } else {
            return response()->json([
                'error' => $errors,
                ]);
        }
    }
    public function update(Request $request, Feature $feature)
    {
        $errors = [];
        $errors = array_merge($errors, Validator::make($request->all(), [
            'title' => 'required|string',
            'type' => 'required',
        ],[
            'title.required' => 'title is required',
            'type.required' => 'type is required',
        ])->errors()->jsonSerialize());

        if(!$errors) {
        $feature->update([
           'title' => $request->title,
            'type' => $request->type,
            'value' => $request->value
        ]);
        return response()->json([
            'status' => 'feature updated',
            'detail' => $feature,
        ]);
        } else {
            return response()->json([
                'error' => $errors,
            ]);
        }
    }
    public function destroy(Feature $feature)
    {
        $feature->delete();
        return response()->json([
            'status' => 'feature deleted',
            'detail' => $feature,
        ]);
    }
}
