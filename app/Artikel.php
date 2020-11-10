<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikel';
    protected $fillable = ['title', 'slug', 'body', 'thumbnail'];
    protected $with = ['author'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function takeImage()
    {
        return "/storage/" . $this->thumbnail;
    }
}
