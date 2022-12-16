<?php

namespace App\Http\Controllers;

use App\Models\AdminPost;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function newPost(Request $request)
    {
        if ($request->isMethod('GET')) {
            if (auth('admin')->check()) {
                return view('admin.admin_new_post', ['profile' => auth('admin')->user()]);
            }
        }

        if ($request->isMethod('POST')) {
            if (auth('admin')->check()) {
                $data = $request->validate([
                    'title' => ['required', 'max:75'],
                    'summary' => ['max:255'],
                    'content' => ['required']
                ]);


                $post = Post::create([
                    'author_id' => auth('admin')->user()->id,
                    'title' => $data['title'],
                    'summary' => $data['summary'],
                    'content' => $data['content'],
                ]);

                $post->thumbnail = $request->thumbnail;

                $post->save();

                dd($post);
            }
        }

        return redirect()->route('admin.login');
    }
}
