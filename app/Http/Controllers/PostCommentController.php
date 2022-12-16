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

        $comment = PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => auth('user')->user()->id,
            'content' => $data['content'],
        ]);

        $comment->save();

        return redirect()->back();
    }
}
