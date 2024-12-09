<?php

// this is my custom function for uploading image and its validations

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

if(!function_exists('uploadThis')){
    function uploadThis($image)
    {
        $errors = [];
        $errors = array_merge($errors, Validator::make(['image' => $image], [
            'image' => 'required|mimes:jpeg,png,jpg|max:2048',
        ],[
            'image.required' => 'image is required',
            'image.mimes' => 'image format must be jpeg or png or jpg',
            'image.max' => 'too big, maximum acceptable size is 2048'
        ])->errors()->jsonSerialize());

        if(!$errors) {
        $originalName = $image->getClientOriginalName();
        $path = $image->storeAs('images', $originalName);
        if( $x = Image::updateOrCreate(['path' => $path]) )
            return [
                'success' => True,
                'image_id' => $x->image_id
                ];
        else return [
            'success' => False,
            'error' => 'insert in images table incomplete'
            ];
        } else {
            return [
                'success' => False,
                'error' => $errors,
            ];
        }
    }
}
