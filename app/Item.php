<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Item extends Model
{
    use Searchable;

    protected $fillable = ['user_id', 'category_id', 'name', 'description', 'type', 'price', 'trade'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
