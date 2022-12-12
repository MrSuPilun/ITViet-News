<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    public function authors()
    {
        return $this->belongsToMany(Admin::class, 'admin_posts', 'post_id', 'admin_id');
    }
}
