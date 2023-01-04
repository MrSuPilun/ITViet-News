<?php

namespace App\Http\Controllers;

use App\Models\FeaturePost;

class PreviewController extends Controller
{
    public function showFeaturePost()
    {
        $posts = FeaturePost::latest('id')
            ->take(6)
            ->get()
            ->map(function ($item) {
                return $item->post()->first();
            });
        return view('preview.feature_post', compact('posts'));
    }
}
