<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function newPost(Request $request)
    {
        if ($request->isMethod('GET')) {
            if (auth('admin')->check()) {
                return view('admin.admin_new_post', ['profile' => auth('admin')->user()]);
            }
        }

        return dd($request->all());
    }
}
