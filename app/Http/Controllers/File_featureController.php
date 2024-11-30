<?php

namespace App\Http\Controllers;

use App\Models\File_feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class File_featureController extends Controller
{
    public function index()
    {
        return File_feature::all();
    }

    public function store(Request $request)
    {
        $errors = [];
        $errors = array_merge($errors, Validator::make($request->all(), [
            'value' => 'required',
            'feature_id' => 'required|exists:features',
            'file_id' => 'required|exists:files'
        ],[
            'feature_id.required' => 'please choose a feature',
            'feature_id.exists' => 'this feature does not exist',
            'value.required' => 'value is required',
            'file_id.required' => 'please choose a file',
            'file_id.exists' => 'this file does not exist',
        ])->errors()->jsonSerialize());

        if(!$errors) {
        $file_feature = File_feature::updateOrCreate([
            'feature_id' => $request->feature_id,
            'file_id' => $request->file_id,
            'value' => $request->value
        ]);
        return response()->json([
            'status' => 'File Feature Created',
            'detail' => $file_feature,
        ]);
        } else {
            return response()->json([
                'error' => $errors,
            ]);
        }
    }
    public function update(Request $request, File_feature $file_feature)
    {
        $errors = [];
        $errors = array_merge($errors, Validator::make($request->all(), [
            'value' => 'required',
            'feature_id' => 'required|exists:features',
            'file_id' => 'required|exists:files'
        ],[
            'feature_id.required' => 'please choose a feature',
            'feature_id.exists' => 'this feature does not exist',
            'value.required' => 'value is required',
            'file_id.required' => 'please choose a file',
            'file_id.exists' => 'this file does not exist',
        ])->errors()->jsonSerialize());

        if(!$errors) {
        $file_feature->update([
            'feature_id' => $request->feature_id,
            'file_id' => $request->file_id,
            'value' => $request->value
        ]);
        return response()->json([
            'status' => 'File Feature updated',
            'detail' => $file_feature,
        ]);
        } else {
            return response()->json([
                'error' => $errors,
            ]);
        }
    }
    public function destroy(File_feature $file_feature)
    {
        $file_feature->delete();
        return response()->json([
            'status' => 'File Feature deleted',
            'detail' => $file_feature,
        ]);
    }
}
