<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'trends' => DB::table('posts')->latest('id')->take(6)->get()
        ]);
    }

    public function news(Request $request)
    {
        if ($request->has('id')) {
            $post = Post::find($request->id);
            $post->view += 1;
            $post->save();

            if ($post) {
                return view('pages.news', ['post' => $post]);
            }
        }
        return redirect('/');
    }
}
