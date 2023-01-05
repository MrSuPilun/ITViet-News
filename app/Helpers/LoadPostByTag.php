<?php

use App\Models\Post;
use App\Models\Tag;

function loadPostByTag($title, $take)
{
    $tags = Tag::where('title', $title)->first();
    if ($tags) {
        return $tags->posts()->latest('id')->take($take)->get();
    }
    return null;
};

function countPostByTag($title)
{
    $tags = Tag::where('title', $title)->first();
    if ($tags) {
        return $tags->posts()->count();
    }
    return 0;
}

function latestPosts()
{
    return Post::latest('id')->take(7)->get();
}

function getTopPosts($take)
{
    return Post::orderBy('view', 'DESC')->take($take)->get();
}
