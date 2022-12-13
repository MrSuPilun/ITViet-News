<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPost extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'post_id'];
}
