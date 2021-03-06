<?php

namespace App\Observers;

use App\Tweet;

class TweetObserver
{
    /**
     * Handle the tweet "saving" event.
     *
     * @param  \App\Tweet  $tweet
     * @return void
     */
    public function saving(Tweet $tweet){
        $tweet->user_id = request()->user()->id;
    }


}
