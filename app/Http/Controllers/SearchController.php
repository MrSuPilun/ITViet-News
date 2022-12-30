<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchTagByTitle(Request $request)
    {
        $keyword = $request->input('keyword');
        $tags = Tag::select('id', 'title')->where('title', 'LIKE', "%$keyword%")->orderBy('title')->take(5)->get();
        return response()->json($tags);
    }

    public function searchPosts(Request $request)
    {
        $posts = Post::where('title', 'like', '%' . $request->search . '%')->take(20)->get();
        $tags = Tag::where('title', 'like', '%' . $request->search . '%')->take(10)->get();
        return view('pages.search', compact('posts', 'tags'));
    }
}
