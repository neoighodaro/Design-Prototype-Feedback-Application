<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['url', 'image'];

    protected $with = ['comments'];

    public function comments()
    {
        return $this->hasMany(PhotoComment::class);
    }
}
