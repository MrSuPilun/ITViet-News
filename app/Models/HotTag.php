<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotTag extends Model
{
    use HasFactory;

    protected $fillable = ['tag_id', 'created_at', 'updated_at'];
}
