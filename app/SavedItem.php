<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SavedItem extends Model
{
    public function items()
    {
        return $this->belongsToMany('App\Item');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
