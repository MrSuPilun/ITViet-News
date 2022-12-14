<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $fillable = ['author_id', 'title', 'content', 'summary'];

    public function author()
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class, 'post_id');
    }

    public function getFirstComments()
    {
        return $this->comments()->where('parent_id', null);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }
}
