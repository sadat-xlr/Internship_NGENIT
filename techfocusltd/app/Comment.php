<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function forum()
    {
        return $this->belongsTo('App\Forum');
    }
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
    public function forumCommentReplies()
    {
        return $this->hasMany('App\Forumcommentreply');
    }
}
