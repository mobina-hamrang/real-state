<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index()
    {
        $data = [];
        $comments = Comment::all();

        $data = $comments->transform(function ($item) {
            return [
                'parent_id' => $item->parent ? $item->parent->comment_id : null,
                'parent' => $item->parent ? $item->parent->text : null,
                'file' => $item->file->title ?? null,
                'text' => $item->text,
                'replies' => $item->replies ? $item->replies->transform(function ($rep){
                    return [
                        'user_id' => $rep->user_id,
                        'text' => $rep->text
                    ];
                }) : null,
            ];
        });

        return response()->json($data);
        //return Comment::all();
    }

    public function store(Request $request)
    {
        $errors = [];
        $errors = array_merge($errors, Validator::make($request->all(), [
            'text' => 'required',
        ],[
            'text.required' => 'text is required'
        ])->errors()->jsonSerialize());

        if(!$errors) {
            $comment = Comment::create([
                'file_id' => $request->file_id,
                'user_id' => $request->user_id,
                'text' => $request->text,
                'reply_id' => $request->reply_id
            ]);

            return response()->json([
                'status' => 'comment created',
                'detail' => $comment,
            ]);
        } else {
            return response()->json([
                'error' => $errors,
            ]);
        }
    }
    public function update(Request $request, Comment $comment)
    {
        $errors = [];
        $errors = array_merge($errors, Validator::make($request->all(), [
            'text' => 'required',
        ],[
            'text.required' => 'text is required'
        ])->errors()->jsonSerialize());

        if(!$errors) {
            $comment->update(['text' => $request->text]);

            return response()->json([
                'status' => 'comment updated',
                'detail' => $comment
            ]);
        } else {
            return response()->json([
                'error' => $errors,
            ]);
        }
    }
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json([
            'status' => 'comment deleted',
            'detail' => $comment,
        ]);
    }
}
