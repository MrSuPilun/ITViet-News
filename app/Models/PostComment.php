<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PostComment extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'post_id', 'user_id', 'content', 'parent_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->first();
    }

    public function getChildren()
    {
        return $this->hasMany(PostComment::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(PostComment::class, 'parent_id');
    }

    public function getUserComment()
    {
        return $this->parent()->first()->user()->first();
    }
}
