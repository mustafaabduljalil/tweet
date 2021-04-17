<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tweet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tweet','user_id'
    ];

    /**
     * Get tweet's user.
     *
     * @var object
     */
    public function user()
    {
        return $this->BelongsTo('App\User');
    }

}
