<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemTag extends Model
{
    public function items()
    {
        return $this->belongsToMany('App\Item');
    }
}
