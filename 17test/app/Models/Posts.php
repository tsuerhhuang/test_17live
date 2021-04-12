<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    public function comments()
    {
        return $this->hasMany(Comments::class, 'post_id');
    }
}
