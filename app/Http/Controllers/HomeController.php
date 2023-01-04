<?php

namespace App\Http\Controllers;

use App\Console\Commands\GetHotTags;
use App\Models\FeaturePost;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    public function home()
    {
        $feature = FeaturePost::latest('id')->take(6)->get();
        $posts = [];
        foreach ($feature as $item) {
            $posts[] = $item->post()->first();
        }
        return view('pages.home', compact('posts'));
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
