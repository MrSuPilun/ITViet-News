<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'trends' => DB::table('posts')->latest('id')->take(6)->get()
        ]);
    }
}
