<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use Illuminate\Http\Request;

class UiController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $files = File::all();

        $category = $categories->transform(function ($cat){
            return [
                'category_id'=>$cat->category_id,
                'title'=>$cat->title,
                'path'=>$cat->image->path
            ];
        });

        $file = $files->transform(function ($f){
           return [
               'file_id'=>$f->file_id,
               'user_id'=>$f->user_id,
               'titleCategory'=>$f->category->title,
               'city'=>$f->city->name,
               'title'=>$f->title,
               'address'=>$f->address,
               'location'=>$f->location,
               'description'=>$f->description,
               'path'=>$f->image->path
           ] ;
        });

        return [$category, $file];
    }
}
