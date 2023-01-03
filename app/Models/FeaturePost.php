<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturePost extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'created_at', 'updated_at'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
