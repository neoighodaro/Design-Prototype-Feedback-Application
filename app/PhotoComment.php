<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoComment extends Model
{
    protected $fillable = ['photo_id', 'comment', 'top', 'left'];

    protected $appends = ['position'];

    public function getPositionAttribute()
    {
        return ['top' => $this->attributes['top'], 'left' => $this->attributes['left']];
    }
}
