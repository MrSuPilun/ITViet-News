<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function home()
    {
        $trends = Post::latest('id')->take(6)->get();
        return view('pages.home', compact('trends'));
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
