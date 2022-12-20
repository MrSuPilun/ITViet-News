<?php

namespace App\Http\Controllers;

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
}
