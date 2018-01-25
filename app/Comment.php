<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model

{

    //

    /**

     * Fillable fields for a course

     *

     * @return array

     */

    protected $fillable = ['comment','reply_id','item_id','user_id'];

    protected $dates = ['created_at', 'updated_at'];

    public function replies()

    {
        $this->belongsTo('App\Item');
        return $this->hasMany('App\Comment','id','reply_id');
    }
}
