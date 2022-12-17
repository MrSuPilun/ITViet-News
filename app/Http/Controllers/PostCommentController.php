<?php

namespace App\Http\Controllers;

use App\Models\PostComment;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function create(Request $request)
    {
        // dd(auth('user')->user()->id);
        $data = $request->validate([
            'content' => ['required']
        ]);

        $data['parent_id'] = null;
        $data['post_id'] = $request->post_id;
        $data['user_id'] = auth('user')->user()->id;
        if ($request->has('parent_id')) {
            $data['parent_id'] = $request->parent_id;
        }

        $comment = PostComment::create($data);
        $comment->save();

        return redirect()->back();
    }
}
