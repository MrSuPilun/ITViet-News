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
        // 'Sản phẩm', 'Trò chơi', 'Cuộc thi', 'Blockchain', 'AI', 'Chia sẻ'
        $featureTags = ['Sản phẩm', 'Trò chơi', 'Cuộc thi', 'Blockchain', 'AI', 'Chia sẻ'];
        $posts = FeaturePost::latest('id')
            ->take(6)
            ->get()
            ->map(function ($item) {
                return $item->post()->first();
            });
        return view('pages.home', compact('posts', 'hotTags', 'featureTags'));
    }

    public function viewPost(Request $request)
    {
        if ($request->has('id')) {
            $post = Post::find($request->id);
            $post->view += 1;
            $post->save();

            $featureTags = ['Sản phẩm', 'Trò chơi', 'Cuộc thi', 'Blockchain', 'AI', 'Chia sẻ'];
            if ($post) {
                return view('pages.post', compact('post', 'featureTags'));
            }
        }
        return redirect('/');
    }

    public function news()
    {
        $featureTags = ['Sản phẩm', 'Trò chơi', 'Cuộc thi', 'Blockchain', 'AI', 'Chia sẻ'];
        $posts = Post::latest('created_at')->take(20)->get();
        return view('pages.news', compact('posts', 'featureTags'));
    }
}
