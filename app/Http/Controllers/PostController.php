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
                    'title' => $data['title'],
                    'summary' => $data['summary'],
                    'content' => $data['content'],
                ]);

                if ($request->file('image')) {
                    $file = $request->file('image');
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('public/Image'), $filename);
                    $post['image'] = $filename;
                }
                $post->save();

                $adminPost = AdminPost::create([
                    'admin_id' => auth('admin')->user()->id,
                    'post_id' => $post->id
                ]);

                $adminPost->save();

                dd($request);
            }
        }

        return redirect()->route('admin.login');
    }
}
