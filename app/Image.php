<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function user()
    {
        $this->belongsTo('App\User');
    }
    
    public function item()
    {
        $this->belongsTo('App\Item');
    }
}
