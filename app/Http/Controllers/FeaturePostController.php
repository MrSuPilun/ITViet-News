<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeaturePostController extends Controller
{
    public function show(Request $request)
    {
        return view('admin.custom_layout.admin_feature_post');
    }
}
