<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['author_id', 'title', 'content'];

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
}
