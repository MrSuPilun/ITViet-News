<?php

namespace App\Http\Controllers;

use App\Models\FeaturePost;
use App\Models\HotTag;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function home()
    {

        $hotTags = HotTag::latest('id')->select('tag_id')->distinct('tag_id')->take(10)->get();
        $posts = FeaturePost::latest('id')
            ->take(6)
            ->get()
            ->map(function ($item) {
                return $item->post()->first();
            });
        return view('pages.home', compact('posts', 'hotTags'));
    }

    public function viewPost(Request $request)
    {
        if ($request->has('id')) {
            $post = Post::find($request->id);
            $post->view += 1;
            $post->save();

            if ($post) {
                return view('pages.post', ['post' => $post]);
            }
        }
        return redirect('/');
    }

    public function news()
    {
        $posts = Post::latest('created_at')->take(20)->get();
        return view('pages.news', compact('posts'));
    }
}
