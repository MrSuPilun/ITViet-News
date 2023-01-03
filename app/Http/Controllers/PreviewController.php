<?php

namespace App\Http\Controllers;

use App\Models\FeaturePost;

class PreviewController extends Controller
{
    public function showFeaturePost()
    {
        $feature = FeaturePost::latest('id')->take(6)->get();
        $posts = [];
        foreach ($feature as $item) {
            $posts[] = $item->post()->first();
        }
        return view('preview.feature_post', compact('posts'));
    }
}
