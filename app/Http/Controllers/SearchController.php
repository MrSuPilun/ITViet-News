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

    public function searchPostsAndTags(Request $request)
    {
        $featureTags = ['Sản phẩm', 'Trò chơi', 'Cuộc thi', 'Blockchain', 'AI', 'Chia sẻ'];
        $posts = Post::where('title', 'like', '%' . $request->search . '%')->take(20)->get();
        $tags = Tag::where('title', 'like', '%' . $request->search . '%')->take(10)->get();
        return view('pages.search', compact('posts', 'tags', 'featureTags'));
    }

    public function searchPostsByTag(Request $request)
    {
        $featureTags = ['Sản phẩm', 'Trò chơi', 'Cuộc thi', 'Blockchain', 'AI', 'Chia sẻ'];
        $tag = Tag::where('title', 'like', $request->t . '%')->first();
        if ($tag) {
            $title = $tag->title;
            $posts = $tag->posts()->get() ?? [];
            return view('pages.search_posts_by_tag', compact('title', 'posts', 'featureTags'));
        }

        $title = $request->t;
        $posts = [];
        return view('pages.search_posts_by_tag', compact('title', 'posts', 'featureTags'));
    }
}
