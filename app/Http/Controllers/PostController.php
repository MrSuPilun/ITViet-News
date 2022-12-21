<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostTag;
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

                if ($request->has('tags')) {
                    $tags = explode(' ', $request->tags);
                    foreach ($tags as $t) {
                        PostTag::create([
                            'post_id' => $post->id,
                            'tag_id' => $t
                        ])->save();
                    }
                }

                return redirect()->route('admin.dashboard');
            }
        }

        return redirect()->route('admin.login');
    }

    public function showPosts()
    {
        $posts = Post::paginate(5);
        return view('admin.admin_show_post', compact('posts'));
    }
}
